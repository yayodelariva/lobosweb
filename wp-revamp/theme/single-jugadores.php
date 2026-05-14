<?php get_header(); ?>

<div class="player-detail-wrapper claw-bg">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

        <div class="player-detail-layout">

            <?php
            $foto = get_field( 'foto_playercard' );
            if ( $foto ) : ?>
                <img class="player-detail-photo" src="<?php echo esc_url( $foto['url'] ); ?>" alt="<?php the_title_attribute(); ?>">
            <?php elseif ( has_post_thumbnail() ) : ?>
                <div class="player-detail-photo"><?php the_post_thumbnail( 'large' ); ?></div>
            <?php endif; ?>

            <div class="player-detail-content">
                <div class="player-detail-meta">
                    <?php
                    $equipo_slugs_p = wp_get_object_terms( get_the_ID(), 'equipo', [ 'fields' => 'slugs' ] );
                    $equipo_slugs_p = is_wp_error( $equipo_slugs_p ) ? [] : $equipo_slugs_p;
                    $plays_foam     = (bool) array_filter( $equipo_slugs_p, fn( $s ) => str_starts_with( $s, 'foam-' ) );
                    $plays_cloth    = (bool) array_filter( $equipo_slugs_p, fn( $s ) => str_starts_with( $s, 'cloth-' ) );
                    $num_foam       = $plays_foam  ? get_field( 'numero_foam' )  : null;
                    $num_cloth      = $plays_cloth ? get_field( 'numero_cloth' ) : null;
                    $prefix    = '';
                    if ( $num_foam && $num_cloth && $num_foam !== $num_cloth ) {
                        // Two different numbers — show inline as a small label below the name
                    } elseif ( $num_foam || $num_cloth ) {
                        $prefix = '#' . esc_html( $num_foam ?: $num_cloth ) . ' ';
                    }
                    ?>
                    <h1 class="player-detail-name">
                        <?php echo $prefix; ?><?php the_title(); ?>
                    </h1>
                    <?php if ( $num_foam && $num_cloth && $num_foam !== $num_cloth ) : ?>
                        <p class="player-detail-numbers">
                            <span>Foam <strong>#<?php echo esc_html( $num_foam ); ?></strong></span>
                            <span class="dot">•</span>
                            <span>Cloth <strong>#<?php echo esc_html( $num_cloth ); ?></strong></span>
                        </p>
                    <?php endif; ?>
                    <?php if ( get_field( 'apodo' ) ) : ?>
                        <p class="player-detail-apodo"><?php echo esc_html( get_field( 'apodo' ) ); ?></p>
                    <?php endif; ?>
                    <?php if ( get_field( 'instagram' ) ) : ?>
                        <p class="player-detail-instagram">
                            <a href="https://instagram.com/<?php echo esc_attr( ltrim( get_field( 'instagram' ), '@' ) ); ?>" target="_blank">
                                <?php echo esc_html( get_field( 'instagram' ) ); ?>
                            </a>
                        </p>
                    <?php endif; ?>
                </div>

                <div class="player-stats-grid">
                    <?php
                    $stats = [
                        'Posición'                    => get_field( 'posicion' ),
                        'Mano'                        => get_field( 'mano' ),
                        'Balón preferido'             => get_field( 'balon' ),
                        'Rama preferida'              => get_field( 'rama' ),
                        'Altura'                      => get_field( 'altura' ),
                        'Años jugando'                => get_field( 'anos' ),
                        'Veces seleccionado nacional' => get_field( 'seleccion' ),
                        'Equipos en liga'             => get_field( 'equipos' ),
                    ];
                    foreach ( $stats as $label => $value ) :
                        if ( $value !== '' && $value !== null ) : ?>
                            <div class="stat-item">
                                <span class="stat-label"><?php echo esc_html( $label ); ?></span>
                                <span class="stat-value"><?php echo esc_html( $value ); ?></span>
                            </div>
                        <?php endif;
                    endforeach; ?>
                </div>
            </div>

        </div>

        <?php
        // Build the "back to team" link. A player may belong to multiple equipos,
        // so we collect all matching roster pages, then prefer the one the visitor
        // came from if it's among them.
        $equipo_slugs = wp_get_object_terms( get_the_ID(), 'equipo', [ 'fields' => 'slugs' ] );
        $equipo_slugs = is_wp_error( $equipo_slugs ) ? [] : $equipo_slugs;

        $matching_urls = [];
        if ( $equipo_slugs ) {
            $candidates = get_posts( [
                'post_type'      => 'page',
                'posts_per_page' => -1,
                'meta_key'       => '_wp_page_template',
                'meta_value'     => 'template-roster.php',
            ] );
            foreach ( $candidates as $candidate ) {
                $page_equipo = get_field( 'equipo_filter', $candidate->ID );
                if ( $page_equipo && in_array( $page_equipo, $equipo_slugs, true ) ) {
                    $matching_urls[] = get_permalink( $candidate );
                }
            }
        }

        $team_url = '';
        if ( $matching_urls ) {
            $referer = wp_get_referer();
            if ( $referer ) {
                $ref_norm = untrailingslashit( strtok( $referer, '?' ) );
                foreach ( $matching_urls as $url ) {
                    if ( untrailingslashit( $url ) === $ref_norm ) {
                        $team_url = $url;
                        break;
                    }
                }
            }
            if ( ! $team_url ) {
                $team_url = $matching_urls[0]; // fallback: first matching team
            }
        }
        ?>
        <?php if ( $team_url ) : ?>
            <div class="player-detail-back">
                <a href="<?php echo esc_url( $team_url ); ?>">← Volver al equipo</a>
            </div>
        <?php endif; ?>

    <?php endwhile; endif; ?>
</div>

<?php get_footer(); ?>
