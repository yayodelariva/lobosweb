<?php
/**
 * WP-CLI command: `wp lobos-report monthly [--month=YYYY-MM | --from=… --to=…] [--output=<path>]`
 *
 * Ported from the sibling fmdbweb project, with its membership, geographic,
 * editorial, shop and events sections dropped — Lobos has no accounts, no
 * WooCommerce, no events CPT, and no posts beyond the WP default. Roster and
 * palmarés take their place.
 *
 * Setup (run once on the server — all three are server-side only and
 * deliberately kept out of this repo, which is public):
 *
 *     wp option update lobos_ga4_property_id <GA4_PROPERTY_ID>
 *     wp option update lobos_ga4_credentials_path <ABS_PATH_TO_SERVICE_ACCOUNT_JSON>
 *     wp option update lobos_report_git_dir <ABS_PATH_TO_A_CLONE_OF_THIS_REPO>
 */

if ( ! defined( 'WP_CLI' ) || ! WP_CLI ) {
    return;
}

class LOBOS_Monthly_Report_Command {

    private ?LOBOS_GA4_API $ga4 = null;

    private const MESES = [
        '01' => 'Enero', '02' => 'Febrero', '03' => 'Marzo', '04' => 'Abril',
        '05' => 'Mayo',  '06' => 'Junio',   '07' => 'Julio', '08' => 'Agosto',
        '09' => 'Septiembre', '10' => 'Octubre', '11' => 'Noviembre', '12' => 'Diciembre',
    ];

    /**
     * Prints the monthly summary.
     *
     * ## OPTIONS
     *
     * [--month=<yyyy-mm>]
     * : Month to report on. Defaults to previous calendar month.
     *
     * [--from=<yyyy-mm-dd>]
     * : Start date for a custom range. Requires --to. Overrides --month.
     *
     * [--to=<yyyy-mm-dd>]
     * : End date (inclusive) for a custom range. Requires --from.
     *
     * [--output=<path>]
     * : Write a styled HTML report to this path.
     *
     * @when after_wp_load
     */
    public function monthly( $args, $assoc_args ) {
        $from_arg = $assoc_args['from'] ?? '';
        $to_arg   = $assoc_args['to'] ?? '';

        if ( $from_arg !== '' || $to_arg !== '' ) {
            if ( ! preg_match( '/^\d{4}-\d{2}-\d{2}$/', $from_arg ) || ! preg_match( '/^\d{4}-\d{2}-\d{2}$/', $to_arg ) ) {
                WP_CLI::error( 'Invalid range. Use --from=YYYY-MM-DD --to=YYYY-MM-DD (both required).' );
            }
            if ( strtotime( $from_arg ) > strtotime( $to_arg ) ) {
                WP_CLI::error( '--from must be on or before --to.' );
            }
            $start_date = $from_arg;
            $end_date   = $to_arg;

            // Previous window: same length, ending the day before --from.
            $days       = (int) round( ( strtotime( $to_arg ) - strtotime( $from_arg ) ) / 86400 ) + 1;
            $prev_end   = gmdate( 'Y-m-d', strtotime( $from_arg . ' -1 day' ) );
            $prev_start = gmdate( 'Y-m-d', strtotime( $prev_end . ' -' . ( $days - 1 ) . ' day' ) );

            $label = $this->fmt_date( $start_date ) . ' – ' . $this->fmt_date( $end_date );
        } else {
            $month_arg = $assoc_args['month'] ?? gmdate( 'Y-m', strtotime( 'first day of last month' ) );
            if ( ! preg_match( '/^\d{4}-\d{2}$/', $month_arg ) ) {
                WP_CLI::error( 'Invalid --month. Use YYYY-MM (e.g. 2026-08).' );
            }
            $start_date = $month_arg . '-01';
            $end_date   = gmdate( 'Y-m-d', strtotime( 'last day of ' . $month_arg . '-01' ) );

            $prev_month = gmdate( 'Y-m', strtotime( $start_date . ' -1 month' ) );
            $prev_start = $prev_month . '-01';
            $prev_end   = gmdate( 'Y-m-d', strtotime( 'last day of ' . $prev_month . '-01' ) );

            $parts = explode( '-', $month_arg );
            $label = ( self::MESES[ $parts[1] ] ?? $parts[1] ) . ' ' . $parts[0];
        }

        $start = $start_date . ' 00:00:00';
        $end   = $end_date . ' 23:59:59';

        $this->init_ga4();

        $d = [
            'label'           => $label,
            'traffic'         => $this->collect_traffic( $start_date, $end_date, $prev_start, $prev_end ),
            'roster'          => $this->collect_roster( $start, $end ),
            'palmares'        => $this->collect_palmares( $start, $end ),
            'implementations' => $this->collect_implementations( $start_date, $end_date ),
        ];

        $this->render_text( $d );

        $output = $assoc_args['output'] ?? '';
        if ( $output !== '' ) {
            file_put_contents( $output, $this->render_html( $d ) );
            WP_CLI::success( "Reporte guardado en: {$output}" );
        }
    }

    private function fmt_date( string $ds ): string {
        $p = explode( '-', $ds );
        return (int) $p[2] . ' ' . ( self::MESES[ $p[1] ] ?? $p[1] ) . ' ' . $p[0];
    }

    /* ================================================================== */
    /*  GA4 init                                                           */
    /* ================================================================== */

    private function init_ga4(): void {
        if ( ! class_exists( 'LOBOS_GA4_API' ) ) {
            WP_CLI::warning( 'LOBOS_GA4_API class not found — skipping GA4 sections.' );
            return;
        }
        $this->ga4 = LOBOS_GA4_API::from_options();
        if ( ! $this->ga4 ) {
            WP_CLI::warning( 'GA4 not configured. wp option update lobos_ga4_credentials_path … && wp option update lobos_ga4_property_id …' );
            return;
        }
        if ( ! $this->ga4->authenticate() ) {
            WP_CLI::warning( 'GA4 auth failed — ' . ( $this->ga4->last_error() ?? 'unknown error' ) );
            $this->ga4 = null;
        }
    }

    /* ================================================================== */
    /*  Data collectors                                                    */
    /* ================================================================== */

    private function collect_traffic( string $s, string $e, string $ps, string $pe ): array {
        $out = [ 'has_ga4' => (bool) $this->ga4 ];
        if ( ! $this->ga4 ) return $out;

        $ranges = [
            [ 'startDate' => $s,  'endDate' => $e ],
            [ 'startDate' => $ps, 'endDate' => $pe ],
        ];

        $ov = $this->ga4->run_report( [ 'dateRanges' => $ranges, 'metrics' => [
            [ 'name' => 'sessions' ], [ 'name' => 'totalUsers' ],
        ] ] );
        if ( $ov === null ) {
            $out['error'] = $this->ga4->last_error() ?? 'Unknown GA4 Data API error.';
            WP_CLI::warning( 'GA4 traffic unavailable — ' . $out['error'] );
            return $out;
        }
        $cur  = $this->range_metrics( $ov, 0 );
        $prev = $this->range_metrics( $ov, 1 );

        $out['sessions'] = [ 'cur' => $cur[0] ?? 0, 'prev' => $prev[0] ?? 0 ];
        $out['users']    = [ 'cur' => $cur[1] ?? 0, 'prev' => $prev[1] ?? 0 ];
        $out['sessions']['change'] = $this->pct_change( $out['sessions']['cur'], $out['sessions']['prev'] );
        $out['users']['change']    = $this->pct_change( $out['users']['cur'], $out['users']['prev'] );

        $devs = $this->ga4->pluck( $this->ga4->run_report( [
            'dateRanges' => [ $ranges[0] ],
            'dimensions' => [ [ 'name' => 'deviceCategory' ] ],
            'metrics'    => [ [ 'name' => 'sessions' ] ],
        ] ) );
        $td = array_sum( $devs ) ?: 1;
        $out['mobile_pct']  = round( ( ( $devs['mobile'] ?? 0 ) + ( $devs['tablet'] ?? 0 ) ) / $td * 100 );
        $out['desktop_pct'] = round( ( $devs['desktop'] ?? 0 ) / $td * 100 );

        $nvr = $this->ga4->pluck( $this->ga4->run_report( [
            'dateRanges' => [ $ranges[0] ],
            'dimensions' => [ [ 'name' => 'newVsReturning' ] ],
            'metrics'    => [ [ 'name' => 'totalUsers' ] ],
        ] ) );
        $tn = array_sum( $nvr ) ?: 1;
        $out['new_pct']       = round( ( $nvr['new'] ?? 0 ) / $tn * 100 );
        $out['returning_pct'] = round( ( $nvr['returning'] ?? 0 ) / $tn * 100 );

        $tp = $this->ga4->run_report( [
            'dateRanges' => [ $ranges[0] ],
            'dimensions' => [ [ 'name' => 'pagePath' ] ],
            'metrics'    => [ [ 'name' => 'screenPageViews' ] ],
            'limit'      => 5,
            'orderBys'   => [ [ 'metric' => [ 'metricName' => 'screenPageViews' ], 'desc' => true ] ],
        ] );
        $out['top_pages'] = [];
        foreach ( ( $tp['rows'] ?? [] ) as $r ) {
            $out['top_pages'][] = [
                'path'  => $r['dimensionValues'][0]['value'] ?? '',
                'views' => (int) ( $r['metricValues'][0]['value'] ?? 0 ),
            ];
        }

        $src = $this->ga4->pluck( $this->ga4->run_report( [
            'dateRanges' => [ $ranges[0] ],
            'dimensions' => [ [ 'name' => 'sessionDefaultChannelGrouping' ] ],
            'metrics'    => [ [ 'name' => 'sessions' ] ],
        ] ) );
        arsort( $src );
        $ts = array_sum( $src ) ?: 1;
        $out['sources'] = [];
        foreach ( $src as $ch => $cnt ) {
            $out['sources'][] = [ 'channel' => $ch, 'pct' => round( $cnt / $ts * 100, 1 ), 'count' => (int) $cnt ];
        }
        return $out;
    }

    /**
     * Roster state: headcount per equipo term, plus players added in the period.
     * Players are counted per equipo, so someone who plays both disciplines
     * appears under each of their teams — the per-team numbers intentionally
     * sum to more than the unique player total.
     */
    private function collect_roster( string $start, string $end ): array {
        $terms = get_terms( [ 'taxonomy' => 'equipo', 'hide_empty' => false ] );
        $teams = [];
        if ( ! is_wp_error( $terms ) ) {
            foreach ( $terms as $t ) {
                $teams[] = [ 'name' => $t->name, 'slug' => $t->slug, 'count' => (int) $t->count ];
            }
            usort( $teams, fn( $a, $b ) => $b['count'] <=> $a['count'] );
        }

        $new_ids = get_posts( [
            'post_type'      => 'jugadores',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'fields'         => 'ids',
            'date_query'     => [ [ 'after' => $start, 'before' => $end, 'inclusive' => true ] ],
        ] );
        $new = [];
        foreach ( $new_ids as $id ) {
            $new[] = [ 'title' => get_the_title( $id ), 'url' => get_permalink( $id ) ];
        }

        return [
            'total' => (int) wp_count_posts( 'jugadores' )->publish,
            'teams' => $teams,
            'new'   => $new,
        ];
    }

    /**
     * Palmarés: results added in the period, plus the standing total.
     *
     * Only the title is collected — a palmarés title already reads
     * "2021 — Foam Primera — Varonil 4° (Lobos 2)", so the anio/lugar/
     * disciplina/categoria fields would only restate it.
     */
    private function collect_palmares( string $start, string $end ): array {
        $new_ids = get_posts( [
            'post_type'      => 'palmares',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'fields'         => 'ids',
            'date_query'     => [ [ 'after' => $start, 'before' => $end, 'inclusive' => true ] ],
        ] );
        $new = [];
        foreach ( $new_ids as $id ) {
            $new[] = get_the_title( $id );
        }
        return [
            'total' => (int) wp_count_posts( 'palmares' )->publish,
            'new'   => $new,
        ];
    }

    /**
     * Commits in the period. Reads from the clone named by the
     * `lobos_report_git_dir` option; falls back to walking up from the theme
     * for local dev, where the theme may sit inside the repo.
     */
    private function collect_implementations( string $sd, string $ed ): array {
        $dir = trim( (string) get_option( 'lobos_report_git_dir', '' ) );

        if ( $dir === '' ) {
            $dir = realpath( get_stylesheet_directory() ) ?: get_stylesheet_directory();
            while ( $dir !== '/' && $dir !== '' && ! is_dir( $dir . '/.git' ) ) {
                $dir = dirname( $dir );
            }
        }

        if ( ! is_dir( rtrim( $dir, '/' ) . '/.git' ) ) {
            return [ 'found' => false, 'dir' => $dir ];
        }

        $next = gmdate( 'Y-m-d', strtotime( $ed . ' +1 day' ) );
        $raw  = shell_exec( sprintf(
            'git -C %s log --since=%s --until=%s --oneline --no-merges 2>/dev/null',
            escapeshellarg( $dir ), escapeshellarg( $sd ), escapeshellarg( $next )
        ) );

        $feats = []; $fixes = []; $others = [];
        foreach ( explode( "\n", trim( $raw ?: '' ) ) as $line ) {
            if ( ! $line ) continue;
            $msg = preg_replace( '/^[a-f0-9]+\s+/', '', $line );
            if ( preg_match( '/^feat/i', $msg ) )   $feats[]  = $msg;
            elseif ( preg_match( '/^fix/i', $msg ) ) $fixes[]  = $msg;
            else                                     $others[] = $msg;
        }
        return [ 'found' => true, 'dir' => $dir, 'feats' => $feats, 'fixes' => $fixes, 'others' => $others ];
    }

    /* ================================================================== */
    /*  Text renderer (terminal)                                           */
    /* ================================================================== */

    private function render_text( array $d ): void {
        WP_CLI::log( "\n=== Lobos · Reporte mensual · {$d['label']} ===\n" );

        // 1. Traffic
        WP_CLI::log( "## 1. Alcance y tráfico\n" );
        $t = $d['traffic'];
        if ( ! $t['has_ga4'] ) {
            WP_CLI::log( "(GA4 no configurado.)\n" );
        } elseif ( isset( $t['error'] ) ) {
            WP_CLI::log( '(Datos de tráfico no disponibles — error de la GA4 Data API.)' );
            WP_CLI::log( '  ' . $t['error'] . "\n" );
        } else {
            WP_CLI::log( sprintf( '- Visitas totales:      %s  (%s)', number_format( $t['sessions']['cur'] ), $t['sessions']['change'] ) );
            WP_CLI::log( sprintf( '- Visitantes únicos:    %s  (%s)', number_format( $t['users']['cur'] ), $t['users']['change'] ) );
            WP_CLI::log( sprintf( '- Mobile / Desktop:     %d%% / %d%%', $t['mobile_pct'], $t['desktop_pct'] ) );
            WP_CLI::log( sprintf( '- Nuevos / Recurrentes: %d%% / %d%%', $t['new_pct'], $t['returning_pct'] ) );
            if ( $t['top_pages'] ) {
                WP_CLI::log( "\n### Top 5 páginas" );
                foreach ( $t['top_pages'] as $i => $pg ) {
                    WP_CLI::log( sprintf( '%d. %s — %s vistas', $i + 1, $pg['path'], number_format( $pg['views'] ) ) );
                }
            }
            if ( $t['sources'] ) {
                WP_CLI::log( "\n### Fuentes de tráfico" );
                foreach ( $t['sources'] as $src ) {
                    WP_CLI::log( sprintf( '- %s: %.1f%% (%s)', $src['channel'], $src['pct'], number_format( $src['count'] ) ) );
                }
            }
            WP_CLI::log( '' );
        }

        // 2. Roster
        $r = $d['roster'];
        WP_CLI::log( "## 2. Plantilla\n" );
        WP_CLI::log( '- Jugadores publicados: ' . $r['total'] );
        if ( $r['teams'] ) {
            WP_CLI::log( "\n### Por equipo" );
            foreach ( $r['teams'] as $tm ) {
                WP_CLI::log( sprintf( '- %-16s %d', $tm['name'], $tm['count'] ) );
            }
            WP_CLI::log( '  (un jugador puede aparecer en más de un equipo)' );
        }
        WP_CLI::log( "\n- Altas en el período: " . count( $r['new'] ) );
        foreach ( $r['new'] as $p ) WP_CLI::log( '   · ' . $p['title'] );
        WP_CLI::log( '' );

        // 3. Palmarés
        $pm = $d['palmares'];
        WP_CLI::log( "## 3. Palmarés\n" );
        WP_CLI::log( '- Resultados totales: ' . $pm['total'] );
        WP_CLI::log( '- Nuevos en el período: ' . count( $pm['new'] ) );
        foreach ( $pm['new'] as $title ) WP_CLI::log( '   · ' . $title );
        WP_CLI::log( '' );

        // 4. Implementations
        $im = $d['implementations'];
        WP_CLI::log( "## 4. Implementaciones del período\n" );
        if ( ! $im['found'] ) {
            WP_CLI::log( '- (Sin repositorio git en ' . $im['dir'] . ' — configura lobos_report_git_dir.)' );
            WP_CLI::log( '' );
        } elseif ( ! $im['feats'] && ! $im['fixes'] && ! $im['others'] ) {
            WP_CLI::log( "- Sin commits en el período.\n" );
        } else {
            if ( $im['feats'] )  { WP_CLI::log( '### Nuevas funcionalidades' ); foreach ( $im['feats']  as $f ) WP_CLI::log( '- ' . $f ); }
            if ( $im['fixes'] )  { WP_CLI::log( '### Correcciones' );           foreach ( $im['fixes']  as $f ) WP_CLI::log( '- ' . $f ); }
            if ( $im['others'] ) { WP_CLI::log( '### Otros' );                  foreach ( $im['others'] as $f ) WP_CLI::log( '- ' . $f ); }
            WP_CLI::log( '' );
        }
    }

    /* ================================================================== */
    /*  HTML renderer                                                      */
    /* ================================================================== */

    private function render_html( array $d ): string {
        $h = fn( $s ) => htmlspecialchars( (string) $s, ENT_QUOTES, 'UTF-8' );
        $n = fn( $v, $dec = 0 ) => number_format( (float) $v, $dec );

        $html = '<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8">'
            . '<title>Lobos &middot; Reporte mensual &middot; ' . $h( $d['label'] ) . '</title>'
            . '<style>'
            . 'body{font-family:Calibri,sans-serif;color:#1a1a1a;line-height:1.5;max-width:820px;margin:40px auto;padding:0 24px}'
            . 'h1{font-size:22pt;color:#0A0A0A;margin-bottom:0}'
            . 'h1+p{color:#777;margin-top:4px;font-size:10pt}'
            . 'h2{font-size:14pt;color:#0A0A0A;border-bottom:2px solid #C41E3A;padding-bottom:3px;margin-top:32px}'
            . 'h3{font-size:11pt;color:#C41E3A;margin-top:18px}'
            . 'table{border-collapse:collapse;width:100%;margin:8px 0}'
            . 'th,td{border:1px solid #ccc;padding:6px 10px;text-align:left;font-size:10pt}'
            . 'th{background:#f6f3f4;color:#0A0A0A;font-weight:700}'
            . '.num{text-align:right}'
            . 'ul,ol{margin:6px 0 12px 18px}'
            . 'hr{border:none;border-top:1px solid #ddd;margin:24px 0}'
            . '.meta{color:#777;font-size:9pt;font-style:italic}'
            . '</style></head><body>';

        $html .= '<h1>Lobos &mdash; Reporte mensual &middot; ' . $h( $d['label'] ) . '</h1>';
        $html .= '<p>Lobos Club de Dodgeball &middot; lobosdodgeball.com</p><hr>';

        // 1. Traffic
        $html .= '<h2>1. Alcance y tr&aacute;fico</h2>';
        $t = $d['traffic'];
        if ( $t['has_ga4'] && ! isset( $t['error'] ) ) {
            $html .= '<table><tr><th>M&eacute;trica</th><th>Per&iacute;odo actual</th><th>vs. per&iacute;odo anterior</th></tr>';
            $html .= '<tr><td>Visitas totales</td><td class="num">' . $n( $t['sessions']['cur'] ) . '</td><td class="num">' . $h( $t['sessions']['change'] ) . '</td></tr>';
            $html .= '<tr><td>Visitantes &uacute;nicos</td><td class="num">' . $n( $t['users']['cur'] ) . '</td><td class="num">' . $h( $t['users']['change'] ) . '</td></tr>';
            $html .= '<tr><td>Mobile / Desktop</td><td>' . $t['mobile_pct'] . '% / ' . $t['desktop_pct'] . '%</td><td>&mdash;</td></tr>';
            $html .= '<tr><td>Nuevos / Recurrentes</td><td>' . $t['new_pct'] . '% / ' . $t['returning_pct'] . '%</td><td>&mdash;</td></tr>';
            $html .= '</table>';
            if ( $t['top_pages'] ) {
                $html .= '<h3>Top 5 p&aacute;ginas m&aacute;s vistas</h3><ol>';
                foreach ( $t['top_pages'] as $pg ) $html .= '<li>' . $h( $pg['path'] ) . ' &mdash; ' . $n( $pg['views'] ) . ' vistas</li>';
                $html .= '</ol>';
            }
            if ( $t['sources'] ) {
                $html .= '<h3>Fuentes de tr&aacute;fico</h3><ul>';
                foreach ( $t['sources'] as $src ) $html .= '<li>' . $h( $src['channel'] ) . ': ' . $src['pct'] . '% (' . $n( $src['count'] ) . ')</li>';
                $html .= '</ul>';
            }
        } elseif ( isset( $t['error'] ) ) {
            $html .= '<p><em>Datos de tr&aacute;fico no disponibles &mdash; error de la GA4 Data API:</em><br>'
                . '<span class="meta">' . $h( $t['error'] ) . '</span></p>';
        } else {
            $html .= '<p><em>(GA4 no configurado.)</em></p>';
        }

        // 2. Roster
        $html .= '<hr><h2>2. Plantilla</h2>';
        $r = $d['roster'];
        $html .= '<table><tr><th>M&eacute;trica</th><th>Valor</th></tr>';
        $html .= '<tr><td>Jugadores publicados</td><td class="num">' . $r['total'] . '</td></tr>';
        $html .= '<tr><td>Altas en el per&iacute;odo</td><td class="num">' . count( $r['new'] ) . '</td></tr>';
        $html .= '</table>';
        if ( $r['teams'] ) {
            $html .= '<h3>Por equipo</h3><table><tr><th>Equipo</th><th>Jugadores</th></tr>';
            foreach ( $r['teams'] as $tm ) {
                $html .= '<tr><td>' . $h( $tm['name'] ) . '</td><td class="num">' . $tm['count'] . '</td></tr>';
            }
            $html .= '</table><p class="meta">Un jugador puede pertenecer a m&aacute;s de un equipo, por lo que la suma por equipo excede el total de jugadores.</p>';
        }
        if ( $r['new'] ) {
            $html .= '<h3>Altas del per&iacute;odo</h3><ul>';
            foreach ( $r['new'] as $p ) $html .= '<li><a href="' . $h( $p['url'] ) . '">' . $h( $p['title'] ) . '</a></li>';
            $html .= '</ul>';
        }

        // 3. Palmarés
        $html .= '<hr><h2>3. Palmar&eacute;s</h2>';
        $pm = $d['palmares'];
        $html .= '<table><tr><th>M&eacute;trica</th><th>Valor</th></tr>';
        $html .= '<tr><td>Resultados totales</td><td class="num">' . $pm['total'] . '</td></tr>';
        $html .= '<tr><td>Nuevos en el per&iacute;odo</td><td class="num">' . count( $pm['new'] ) . '</td></tr>';
        $html .= '</table>';
        if ( $pm['new'] ) {
            $html .= '<h3>Resultados nuevos</h3><ul>';
            foreach ( $pm['new'] as $title ) $html .= '<li>' . $h( $title ) . '</li>';
            $html .= '</ul>';
        }

        // 4. Implementations
        $html .= '<hr><h2>4. Implementaciones del per&iacute;odo</h2>';
        $im = $d['implementations'];
        if ( ! $im['found'] ) {
            $html .= '<p><em>(Sin repositorio git &mdash; configura la opci&oacute;n <code>lobos_report_git_dir</code>.)</em></p>';
        } elseif ( $im['feats'] || $im['fixes'] || $im['others'] ) {
            foreach ( [ 'feats' => 'Nuevas funcionalidades', 'fixes' => 'Correcciones', 'others' => 'Otros' ] as $k => $heading ) {
                if ( ! $im[ $k ] ) continue;
                $html .= '<h3>' . $heading . '</h3><ul>';
                foreach ( $im[ $k ] as $f ) $html .= '<li>' . $h( $f ) . '</li>';
                $html .= '</ul>';
            }
        } else {
            $html .= '<p>Sin commits en el per&iacute;odo.</p>';
        }

        $html .= '</body></html>';
        return $html;
    }

    /* ================================================================== */
    /*  Helpers                                                            */
    /* ================================================================== */

    /**
     * Metric values for date range #$i from a multi-dateRange report. GA4 tags
     * each row with an implicit `date_range_N` dimension and omits the `totals`
     * block unless metricAggregations is requested, so read straight from rows.
     */
    private function range_metrics( ?array $result, int $i ): array {
        $key = 'date_range_' . $i;
        foreach ( ( $result['rows'] ?? [] ) as $row ) {
            $dims = $row['dimensionValues'] ?? [];
            $last = end( $dims );
            if ( ( $last['value'] ?? '' ) === $key ) {
                $v = [];
                foreach ( ( $row['metricValues'] ?? [] ) as $mv ) $v[] = (float) ( $mv['value'] ?? 0 );
                return $v;
            }
        }
        return [];
    }

    private function pct_change( float $cur, float $prev ): string {
        if ( $prev == 0 ) return $cur > 0 ? '0' : '—';
        $p = ( $cur - $prev ) / $prev * 100;
        return sprintf( '%s%.1f%%', $p >= 0 ? '+' : '', $p );
    }
}

WP_CLI::add_command( 'lobos-report', 'LOBOS_Monthly_Report_Command' );
