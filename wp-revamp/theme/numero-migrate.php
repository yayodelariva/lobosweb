<?php
/**
 * One-time migration to the new equipo-based schema.
 *
 * - Creates the 6 equipo taxonomy terms.
 * - For each known jugador (by slug), assigns the correct equipos using the
 *   original legacy roster data.
 * - Copies legacy `numero` to numero_foam / numero_cloth based on the equipos.
 * - Migrates roster pages from (disciplina_filter, categoria_filter) → equipo_filter.
 *
 * REMOVE this file after it runs once.
 */

add_action( 'init', function () {
    if ( get_option( 'lobos_equipo_migrated' ) || ! function_exists( 'update_field' ) ) {
        return;
    }

    // ── 1. Ensure equipo terms exist ───────────────────────────────────────────
    $equipo_terms = [
        'foam-varonil'  => 'Foam Varonil',
        'foam-femenil'  => 'Foam Femenil',
        'foam-mixto'    => 'Foam Mixto',
        'cloth-varonil' => 'Cloth Varonil',
        'cloth-femenil' => 'Cloth Femenil',
        'cloth-mixto'   => 'Cloth Mixto',
    ];
    $term_id = [];
    foreach ( $equipo_terms as $slug => $name ) {
        $t = get_term_by( 'slug', $slug, 'equipo' );
        if ( $t ) {
            $term_id[ $slug ] = $t->term_id;
        } else {
            $c = wp_insert_term( $name, 'equipo', [ 'slug' => $slug ] );
            if ( ! is_wp_error( $c ) ) $term_id[ $slug ] = $c['term_id'];
        }
    }

    // ── 2. Legacy player → teams mapping (from original static site rosters) ──
    $rosters = [
        'alejandro-dorantes'    => [ 'foam-varonil', 'foam-mixto', 'cloth-varonil', 'cloth-mixto' ],
        'barbara-fuentes-flores'=> [ 'foam-femenil', 'foam-mixto' ],
        'carlos-de-la-riva'     => [ 'foam-varonil', 'foam-mixto', 'cloth-varonil', 'cloth-mixto' ],
        'cecilia-rodriguez'     => [ 'cloth-femenil', 'cloth-mixto' ],
        'cesar-arellano'        => [ 'cloth-varonil', 'cloth-mixto' ],
        'daniela-cruz'          => [ 'foam-femenil', 'foam-mixto', 'cloth-mixto' ],
        'daniel-tellez'         => [ 'cloth-varonil', 'cloth-mixto' ],
        'denise-mejia'          => [ 'foam-femenil', 'foam-mixto', 'cloth-mixto' ],
        'edgar-galicia'         => [ 'foam-varonil', 'foam-mixto', 'cloth-varonil', 'cloth-mixto' ],
        'enrique-huato'         => [ 'foam-varonil', 'foam-mixto', 'cloth-varonil', 'cloth-mixto' ],
        'estela-galavis'        => [ 'foam-femenil' ],
        'farrell-estrada'       => [ 'foam-varonil', 'foam-mixto' ],
        'fernando-leon'         => [ 'cloth-varonil', 'cloth-mixto' ],
        'francisco-rivera'      => [ 'foam-varonil', 'foam-mixto' ],
        'gabriel-sanchez'       => [ 'cloth-varonil', 'cloth-mixto' ],
        'gianni-toro'           => [ 'cloth-varonil', 'cloth-mixto' ],
        'jensen-fernandez'      => [ 'foam-varonil', 'foam-mixto' ],
        'lenny-sandoval'        => [ 'foam-femenil', 'cloth-femenil' ],
        'leonardo-segura'       => [ 'foam-varonil', 'foam-mixto' ],
        'luis-de-la-riva'       => [ 'foam-varonil', 'foam-mixto', 'cloth-varonil', 'cloth-mixto' ],
        'paola-castillo'        => [ 'foam-femenil', 'foam-mixto', 'cloth-mixto' ],
        'randy-castillo'        => [ 'foam-varonil', 'foam-mixto' ],
        'rocio-hernandez'       => [ 'foam-femenil', 'cloth-femenil' ],
        'rogelio-morales'       => [ 'foam-varonil', 'foam-mixto' ],
        'sabrina-huerta'        => [ 'cloth-femenil' ],
        'sara-ceron'            => [ 'cloth-femenil' ],
        'shelsy-estrada'        => [ 'foam-femenil', 'foam-mixto' ],
        'susana-gutierrez'      => [ 'cloth-femenil' ],
    ];

    foreach ( $rosters as $slug => $team_slugs ) {
        $post = get_page_by_path( $slug, OBJECT, 'jugadores' );
        if ( ! $post ) continue;

        $pid = $post->ID;

        // Assign equipos
        $ids = [];
        foreach ( $team_slugs as $ts ) {
            if ( isset( $term_id[ $ts ] ) ) $ids[] = $term_id[ $ts ];
        }
        if ( $ids ) wp_set_post_terms( $pid, $ids, 'equipo', false );

        // Clean up obsolete meta from the prior design
        delete_post_meta( $pid, 'juega_foam' );
        delete_post_meta( $pid, '_juega_foam' );
        delete_post_meta( $pid, 'juega_cloth' );
        delete_post_meta( $pid, '_juega_cloth' );

        // Copy legacy `numero` into discipline-specific fields if not already set
        $numero = get_field( 'numero', $pid );
        $has_foam  = (bool) array_filter( $team_slugs, fn( $s ) => str_starts_with( $s, 'foam-'  ) );
        $has_cloth = (bool) array_filter( $team_slugs, fn( $s ) => str_starts_with( $s, 'cloth-' ) );

        if ( $numero ) {
            if ( $has_foam  && ! get_field( 'numero_foam',  $pid ) ) update_field( 'numero_foam',  $numero, $pid );
            if ( $has_cloth && ! get_field( 'numero_cloth', $pid ) ) update_field( 'numero_cloth', $numero, $pid );
        }
    }

    // ── 3. Migrate roster pages: disciplina_filter + categoria_filter → equipo_filter
    $roster_pages = get_posts( [
        'post_type'      => 'page',
        'posts_per_page' => -1,
        'meta_key'       => '_wp_page_template',
        'meta_value'     => 'template-roster.php',
        'fields'         => 'ids',
    ] );

    foreach ( $roster_pages as $rp_id ) {
        if ( get_field( 'equipo_filter', $rp_id ) ) continue; // already set
        $disc = get_field( 'disciplina_filter', $rp_id );
        $cat  = get_field( 'categoria_filter',  $rp_id );
        if ( $disc && $cat ) {
            update_field( 'equipo_filter', $disc . '-' . $cat, $rp_id );
        }
    }

    update_option( 'lobos_equipo_migrated', true );
}, 30 );
