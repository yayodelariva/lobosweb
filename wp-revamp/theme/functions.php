<?php
require_once __DIR__ . '/acf-seed.php';       // REMOVE after first page load
require_once __DIR__ . '/numero-migrate.php'; // REMOVE after first page load

/**
 * Cache-busting version for a theme-owned asset: its last-modified time, so
 * edits invalidate the browser cache without a manual theme-version bump.
 * Falls back to the theme version if the file is missing.
 *
 * @param string $relative_path Path relative to the theme root, e.g. 'scripts/animations.js'.
 */
function lobos_asset_ver( $relative_path ) {
    $file = get_stylesheet_directory() . '/' . ltrim( $relative_path, '/' );
    return file_exists( $file ) ? filemtime( $file ) : wp_get_theme()->get( 'Version' );
}

// Custom image sizes for the theme's image slots — hard-cropped to the display
// aspect at a resolution that stays sharp on retina, so srcset can serve a file
// that matches the slot without `object-fit: cover` stretching a smaller crop.
add_action( 'after_setup_theme', function () {
    add_image_size( 'lobos_player_portrait', 600, 800, true ); // 3:4 player cards
    add_image_size( 'lobos_team_card',       800, 450, true ); // 16:9 nav cards
} );

add_action( 'wp_enqueue_scripts', function () {
    wp_enqueue_style(
        'lobos-style',
        get_stylesheet_uri(),
        [ 'astra-theme-css' ],
        lobos_asset_ver( 'style.css' )
    );

    // Font Awesome Kit — same kit already used in the legacy static site
    wp_enqueue_script(
        'font-awesome-kit',
        'https://kit.fontawesome.com/ed2ee73606.js',
        [],
        null,
        false  // load in <head> as the kit requires
    );
    // Tell WP to add crossorigin="anonymous" on this script tag
    add_filter( 'script_loader_tag', function ( $tag, $handle ) {
        if ( $handle === 'font-awesome-kit' ) {
            return str_replace( '<script ', '<script crossorigin="anonymous" ', $tag );
        }
        return $tag;
    }, 10, 2 );

    wp_enqueue_style(
        'aos-css',
        'https://unpkg.com/aos@2.3.4/dist/aos.css',
        [],
        '2.3.4'
    );

    wp_enqueue_script(
        'aos-js',
        'https://unpkg.com/aos@2.3.4/dist/aos.js',
        [],
        '2.3.4',
        true
    );

    wp_enqueue_script(
        'gsap',
        'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js',
        [],
        '3.12.5',
        true
    );

    wp_enqueue_script(
        'gsap-st',
        'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js',
        [ 'gsap' ],
        '3.12.5',
        true
    );

    wp_enqueue_script(
        'lobos-animations',
        get_stylesheet_directory_uri() . '/scripts/animations.js',
        [ 'aos-js', 'gsap-st' ],
        lobos_asset_ver( 'scripts/animations.js' ),
        true
    );
} );

// Admin-side JS: toggle jersey-number fields based on disciplina taxonomy checkboxes
add_action( 'admin_enqueue_scripts', function ( $hook ) {
    if ( ! in_array( $hook, [ 'post.php', 'post-new.php' ], true ) ) return;
    if ( get_post_type() !== 'jugadores' ) return;

    wp_enqueue_script(
        'lobos-admin-jugador',
        get_stylesheet_directory_uri() . '/scripts/admin-jugador.js',
        [],
        lobos_asset_ver( 'scripts/admin-jugador.js' ),
        true
    );
} );

// ── Google Analytics (GA4) ─────────────────────────────────────────────────────

define( 'LOBOS_GA4_ID', 'G-FJ91KVE9F3' );

// Only the production host reports. The theme is bind-mounted into the local
// Docker stack, so without this the dev site at localhost:8081 would fire hits
// into the same GA4 property and pollute the stats.
define( 'LOBOS_GA4_HOST', 'lobosdodgeball.com' );

add_action( 'wp_head', function () {
    $host = strtolower( wp_parse_url( home_url(), PHP_URL_HOST ) ?? '' );
    if ( $host !== LOBOS_GA4_HOST && $host !== 'www.' . LOBOS_GA4_HOST ) {
        return;
    }
    if ( ! LOBOS_GA4_ID || is_admin() || is_user_logged_in() ) {
        return;
    }
    $id = esc_js( LOBOS_GA4_ID );
    ?>
<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo rawurlencode( LOBOS_GA4_ID ); ?>"></script>
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());
gtag('config', '<?php echo $id; ?>');
</script>
    <?php
}, 5 );

// Force Astra's customizer settings to match the dark theme
add_filter( 'theme_mod_background_color', fn() => '0A0A0A' );
add_filter( 'theme_mod_text_color',       fn() => 'EDEDED' );
add_filter( 'theme_mod_header_bg_color',  fn() => '0A0A0A' );

// ── Nav Menus ──────────────────────────────────────────────────────────────────

add_action( 'init', function () {
    register_nav_menus( [ 'primary' => 'Menú principal' ] );
} );

// Add home-canvas body class on the front page so GSAP/CSS scoping works
add_filter( 'body_class', function ( $classes ) {
    if ( is_front_page() ) {
        $classes[] = 'home-canvas';
    }
    return $classes;
} );

// ── Custom Post Types ──────────────────────────────────────────────────────────

add_action( 'init', function () {

    register_post_type( 'jugadores', [
        'labels'       => [
            'name'          => 'Jugadores',
            'singular_name' => 'Jugador',
            'add_new_item'  => 'Agregar Jugador',
            'edit_item'     => 'Editar Jugador',
            'search_items'  => 'Buscar Jugadores',
            'not_found'     => 'No se encontraron jugadores',
        ],
        'public'        => true,
        'has_archive'   => false,
        'menu_icon'     => 'dashicons-groups',
        'supports'      => [ 'title', 'thumbnail' ],
        'rewrite'       => [ 'slug' => 'jugadores' ],
        'show_in_rest'  => true,
    ] );

    register_post_type( 'palmares', [
        'labels'       => [
            'name'          => 'Palmarés',
            'singular_name' => 'Resultado',
            'add_new_item'  => 'Agregar Resultado',
            'edit_item'     => 'Editar Resultado',
            'not_found'     => 'No se encontraron resultados',
        ],
        'public'        => true,
        'has_archive'   => false,
        'menu_icon'     => 'dashicons-awards',
        'supports'      => [ 'title' ],
        'rewrite'       => [ 'slug' => 'resultado' ],
        'show_in_rest'  => true,
    ] );

} );

// ── Taxonomies ─────────────────────────────────────────────────────────────────

add_action( 'init', function () {

    // Single taxonomy: one term per specific team combination (Foam/Cloth × Varonil/Femenil/Mixto).
    // Avoids the cartesian-product bug we had with separate disciplina + categoria.
    register_taxonomy( 'equipo', 'jugadores', [
        'labels'       => [ 'name' => 'Equipo', 'singular_name' => 'Equipo' ],
        'hierarchical' => true,
        'public'       => true,
        'rewrite'      => [ 'slug' => 'equipo' ],
        'show_in_rest' => true,
    ] );

} );

// ── ACF Field Groups ───────────────────────────────────────────────────────────

add_action( 'acf/init', function () {

    acf_add_local_field_group( [
        'key'      => 'group_jugador',
        'title'    => 'Datos del Jugador',
        'location' => [ [ [ 'param' => 'post_type', 'operator' => '==', 'value' => 'jugadores' ] ] ],
        'fields'   => [
            [
                'key'         => 'field_numero_foam',
                'label'       => 'Número de jugador (Foam)',
                'name'        => 'numero_foam',
                'type'        => 'number',
                'instructions' => 'Solo visible si "Foam" está marcado en Disciplina.',
            ],
            [
                'key'         => 'field_numero_cloth',
                'label'       => 'Número de jugador (Cloth)',
                'name'        => 'numero_cloth',
                'type'        => 'number',
                'instructions' => 'Solo visible si "Cloth" está marcado en Disciplina.',
            ],
            [
                'key'     => 'field_posicion',
                'label'   => 'Posición',
                'name'    => 'posicion',
                'type'    => 'select',
                'choices' => [ 'Centro' => 'Centro', 'Extremo' => 'Extremo', 'Lateral' => 'Lateral', 'Coach' => 'Coach' ],
            ],
            [
                'key'   => 'field_apodo',
                'label' => 'Apodo',
                'name'  => 'apodo',
                'type'  => 'text',
            ],
            [
                'key'     => 'field_mano',
                'label'   => 'Mano',
                'name'    => 'mano',
                'type'    => 'select',
                'choices' => [ 'Diestro' => 'Diestro', 'Zurdo' => 'Zurdo', 'Ambidiestro' => 'Ambidiestro' ],
            ],
            [
                'key'     => 'field_balon',
                'label'   => 'Balón preferido',
                'name'    => 'balon',
                'type'    => 'select',
                'choices' => [ 'Foam' => 'Foam', 'Cloth' => 'Cloth', 'Ambos' => 'Ambos' ],
            ],
            [
                'key'     => 'field_rama',
                'label'   => 'Rama preferida',
                'name'    => 'rama',
                'type'    => 'select',
                'choices' => [ 'Femenil' => 'Femenil', 'Mixto' => 'Mixto', 'Varonil' => 'Varonil' ],
            ],
            [
                'key'   => 'field_altura',
                'label' => 'Altura',
                'name'  => 'altura',
                'type'  => 'text',
            ],
            [
                'key'   => 'field_anos',
                'label' => 'Años jugando',
                'name'  => 'anos',
                'type'  => 'text',
            ],
            [
                'key'   => 'field_seleccion',
                'label' => 'Veces seleccionado nacional',
                'name'  => 'seleccion',
                'type'  => 'number',
            ],
            [
                'key'   => 'field_equipos',
                'label' => 'Equipos en liga',
                'name'  => 'equipos',
                'type'  => 'textarea',
                'rows'  => 3,
            ],
            [
                'key'   => 'field_instagram',
                'label' => 'Instagram',
                'name'  => 'instagram',
                'type'  => 'text',
            ],
            [
                'key'            => 'field_foto_playercard',
                'label'          => 'Foto playercard',
                'name'           => 'foto_playercard',
                'type'           => 'image',
                'return_format'  => 'array',
                'preview_size'   => 'medium',
            ],
        ],
    ] );

    acf_add_local_field_group( [
        'key'      => 'group_roster_page',
        'title'    => 'Filtro del Roster',
        'location' => [ [ [ 'param' => 'page_template', 'operator' => '==', 'value' => 'template-roster.php' ] ] ],
        'fields'   => [
            [
                'key'     => 'field_equipo_filter',
                'label'   => 'Equipo',
                'name'    => 'equipo_filter',
                'type'    => 'select',
                'choices' => [
                    'foam-varonil'  => 'Foam Varonil',
                    'foam-femenil'  => 'Foam Femenil',
                    'foam-mixto'    => 'Foam Mixto',
                    'cloth-varonil' => 'Cloth Varonil',
                    'cloth-femenil' => 'Cloth Femenil',
                    'cloth-mixto'   => 'Cloth Mixto',
                ],
            ],
        ],
    ] );

    acf_add_local_field_group( [
        'key'      => 'group_home',
        'title'    => 'Contenido — Home',
        'location' => [ [ [ 'param' => 'page_type', 'operator' => '==', 'value' => 'front_page' ] ] ],
        'fields'   => [
            // Intro blurb
            [
                'key'          => 'field_home_intro_texto',
                'label'        => 'Texto introductorio (debajo del hero)',
                'name'         => 'home_intro_texto',
                'type'         => 'textarea',
                'rows'         => 4,
                'placeholder'  => 'Ser un Lobo es ser parte de la manada...',
            ],
            // Hero
            [
                'key'           => 'field_home_hero_bg',
                'label'         => 'Hero — imagen de fondo',
                'name'          => 'home_hero_bg',
                'type'          => 'image',
                'return_format' => 'array',
                'preview_size'  => 'medium',
            ],
            [
                'key'           => 'field_home_hero_titulo',
                'label'         => 'Hero — título',
                'name'          => 'home_hero_titulo',
                'type'          => 'text',
                'default_value' => 'Lobos Club de Dodgeball',
            ],
            [
                'key'   => 'field_home_hero_blurb',
                'label' => 'Hero — descripción',
                'name'  => 'home_hero_blurb',
                'type'  => 'textarea',
                'rows'  => 3,
            ],
            [
                'key'           => 'field_home_hero_cta_texto',
                'label'         => 'Hero — texto del botón',
                'name'          => 'home_hero_cta_texto',
                'type'          => 'text',
                'default_value' => 'Únete',
            ],
            [
                'key'   => 'field_home_hero_cta_url',
                'label' => 'Hero — enlace del botón',
                'name'  => 'home_hero_cta_url',
                'type'  => 'page_link',
            ],
            // Stats
            [
                'key'          => 'field_home_stats',
                'label'        => 'Estadísticas',
                'name'         => 'home_stats',
                'type'         => 'repeater',
                'min'          => 1,
                'max'          => 4,
                'layout'       => 'table',
                'button_label' => 'Agregar estadística',
                'sub_fields'   => [
                    [
                        'key'         => 'field_home_stat_numero',
                        'label'       => 'Número',
                        'name'        => 'numero',
                        'type'        => 'number',
                        'placeholder' => '7',
                    ],
                    [
                        'key'         => 'field_home_stat_sufijo',
                        'label'       => 'Sufijo',
                        'name'        => 'sufijo',
                        'type'        => 'text',
                        'placeholder' => 'ej: + o años',
                    ],
                    [
                        'key'   => 'field_home_stat_etiqueta',
                        'label' => 'Etiqueta',
                        'name'  => 'etiqueta',
                        'type'  => 'text',
                    ],
                ],
            ],
            // Historia
            [
                'key'          => 'field_home_historia_texto',
                'label'        => 'Historia — texto',
                'name'         => 'home_historia_texto',
                'type'         => 'wysiwyg',
                'tabs'         => 'visual',
                'media_upload' => 0,
            ],
            // Contacto
            [
                'key'           => 'field_home_contacto_titulo',
                'label'         => 'Contacto — título',
                'name'          => 'home_contacto_titulo',
                'type'          => 'text',
                'default_value' => '¡Únete a la manada!',
            ],
            [
                'key'         => 'field_home_facebook',
                'label'       => 'Facebook URL',
                'name'        => 'home_facebook',
                'type'        => 'url',
            ],
            [
                'key'         => 'field_home_whatsapp',
                'label'       => 'WhatsApp (número con código de país, sin +)',
                'name'        => 'home_whatsapp',
                'type'        => 'text',
                'placeholder' => 'Ej: 525514329482',
            ],
            [
                'key'         => 'field_home_instagram',
                'label'       => 'Instagram URL',
                'name'        => 'home_instagram',
                'type'        => 'url',
            ],
        ],
    ] );

    acf_add_local_field_group( [
        'key'      => 'group_contacto',
        'title'    => 'Contenido — Contacto',
        'location' => [ [ [ 'param' => 'page_template', 'operator' => '==', 'value' => 'template-contacto.php' ] ] ],
        'fields'   => [
            [
                'key'           => 'field_contacto_titulo',
                'label'         => 'Título',
                'name'          => 'contacto_titulo',
                'type'          => 'text',
                'default_value' => '¡Únete a la manada!',
            ],
            [
                'key'         => 'field_contacto_subtitulo',
                'label'       => 'Subtítulo',
                'name'        => 'contacto_subtitulo',
                'type'        => 'text',
                'placeholder' => 'Ej: Estamos para responderte.',
            ],
            [
                'key'         => 'field_contacto_whatsapp',
                'label'       => 'WhatsApp (número con código de país, sin +)',
                'name'        => 'contacto_whatsapp',
                'type'        => 'text',
                'placeholder' => 'Ej: 525514329482',
            ],
            [
                'key'  => 'field_contacto_instagram',
                'label' => 'Instagram URL',
                'name' => 'contacto_instagram',
                'type' => 'url',
            ],
            [
                'key'  => 'field_contacto_facebook',
                'label' => 'Facebook URL',
                'name' => 'contacto_facebook',
                'type' => 'url',
            ],
            [
                'key'  => 'field_contacto_email',
                'label' => 'Email (opcional)',
                'name' => 'contacto_email',
                'type' => 'email',
            ],
        ],
    ] );

    acf_add_local_field_group( [
        'key'      => 'group_unete',
        'title'    => 'Contenido — Únete',
        'location' => [ [ [ 'param' => 'page_template', 'operator' => '==', 'value' => 'template-unete.php' ] ] ],
        'fields'   => [
            [
                'key'            => 'field_unete_hero_bg',
                'label'          => 'Imagen de fondo (hero)',
                'name'           => 'unete_hero_bg',
                'type'           => 'image',
                'return_format'  => 'array',
                'preview_size'   => 'medium',
            ],
            [
                'key'           => 'field_unete_tagline',
                'label'         => 'Tagline del hero',
                'name'          => 'unete_tagline',
                'type'          => 'text',
                'default_value' => 'Somos ganadores y siempre buscamos los lugares más altos en la competencia.',
            ],
            [
                'key'          => 'field_unete_info_texto',
                'label'        => 'Texto de presentación',
                'name'         => 'unete_info_texto',
                'type'         => 'wysiwyg',
                'tabs'         => 'visual',
                'media_upload' => 0,
            ],
            [
                'key'          => 'field_unete_beneficios',
                'label'        => 'Beneficios',
                'name'         => 'unete_beneficios',
                'type'         => 'repeater',
                'min'          => 1,
                'layout'       => 'block',
                'button_label' => 'Agregar beneficio',
                'sub_fields'   => [
                    [
                        'key'   => 'field_unete_beneficio_texto',
                        'label' => 'Beneficio',
                        'name'  => 'texto',
                        'type'  => 'textarea',
                        'rows'  => 2,
                    ],
                ],
            ],
            [
                'key'           => 'field_unete_cta_texto',
                'label'         => 'Texto del CTA',
                'name'          => 'unete_cta_texto',
                'type'          => 'text',
                'default_value' => '¡Sé parte de la manada!',
            ],
            [
                'key'           => 'field_unete_whatsapp',
                'label'         => 'Número de WhatsApp (con código de país, sin +)',
                'name'          => 'unete_whatsapp',
                'type'          => 'text',
                'default_value' => '525514329482',
                'placeholder'   => 'Ej: 525514329482',
            ],
        ],
    ] );

    acf_add_local_field_group( [
        'key'      => 'group_valores',
        'title'    => 'Contenido — Valores',
        'location' => [ [ [ 'param' => 'page_template', 'operator' => '==', 'value' => 'template-valores.php' ] ] ],
        'fields'   => [
            [
                'key'          => 'field_valores_intro',
                'label'        => 'Texto introductorio',
                'name'         => 'valores_intro',
                'type'         => 'wysiwyg',
                'tabs'         => 'visual',
                'media_upload' => 0,
            ],
            [
                'key'          => 'field_valores_lista',
                'label'        => 'Valores',
                'name'         => 'valores_lista',
                'type'         => 'repeater',
                'min'          => 1,
                'layout'       => 'block',
                'button_label' => 'Agregar valor',
                'sub_fields'   => [
                    [
                        'key'   => 'field_valor_titulo',
                        'label' => 'Título',
                        'name'  => 'titulo',
                        'type'  => 'text',
                    ],
                    [
                        'key'   => 'field_valor_descripcion',
                        'label' => 'Descripción',
                        'name'  => 'descripcion',
                        'type'  => 'textarea',
                        'rows'  => 4,
                    ],
                ],
            ],
        ],
    ] );



    acf_add_local_field_group( [
        'key'      => 'group_palmares',
        'title'    => 'Datos del Resultado',
        'location' => [ [ [ 'param' => 'post_type', 'operator' => '==', 'value' => 'palmares' ] ] ],
        'fields'   => [
            [
                'key'   => 'field_anio',
                'label' => 'Año',
                'name'  => 'anio',
                'type'  => 'number',
            ],
            [
                'key'     => 'field_disciplina_palmares',
                'label'   => 'Disciplina',
                'name'    => 'disciplina',
                'type'    => 'select',
                'choices' => [ 'Foam' => 'Foam', 'Cloth' => 'Cloth' ],
            ],
            [
                'key'     => 'field_categoria_palmares',
                'label'   => 'Categoría',
                'name'    => 'categoria',
                'type'    => 'select',
                'choices' => [ 'Varonil' => 'Varonil', 'Femenil' => 'Femenil', 'Mixto' => 'Mixto' ],
            ],
            [
                'key'     => 'field_fuerza_palmares',
                'label'   => 'Fuerza',
                'name'    => 'fuerza',
                'type'    => 'select',
                'choices' => [ 'Primera' => 'Primera', 'Segunda' => 'Segunda' ],
            ],
            [
                'key'     => 'field_lugar',
                'label'   => 'Lugar',
                'name'    => 'lugar',
                'type'    => 'select',
                'choices' => [
                    '1' => '1° lugar', '2' => '2° lugar', '3' => '3° lugar',
                    '4' => '4° lugar', '5' => '5° lugar', '6' => '6° lugar',
                    '7' => '7° lugar', '8' => '8° lugar',
                ],
            ],
            [
                'key'         => 'field_subequipo',
                'label'       => 'Subequipo',
                'name'        => 'subequipo',
                'type'        => 'text',
                'placeholder' => 'Ej: Lobos 1, Lobos 2',
                'required'    => 0,
            ],
        ],
    ] );

} );

// ── Jugador publish validation ─────────────────────────────────────────────────
// Require at least one Equipo before publishing.

// Returns an array of human-readable problem strings, or [] if the post is valid.
function lobos_check_jugador_requirements( $post_id ) {
    $errors = [];

    $equipo_slugs = wp_get_object_terms( $post_id, 'equipo', [ 'fields' => 'slugs' ] );
    $equipo_slugs = is_wp_error( $equipo_slugs ) ? [] : $equipo_slugs;

    if ( empty( $equipo_slugs ) ) {
        $errors[] = 'al menos un Equipo';
        return $errors;
    }

    $plays_foam  = (bool) array_filter( $equipo_slugs, fn( $s ) => str_starts_with( $s, 'foam-'  ) );
    $plays_cloth = (bool) array_filter( $equipo_slugs, fn( $s ) => str_starts_with( $s, 'cloth-' ) );

    if ( $plays_foam  && ! get_field( 'numero_foam',  $post_id ) ) $errors[] = 'el Número (Foam)';
    if ( $plays_cloth && ! get_field( 'numero_cloth', $post_id ) ) $errors[] = 'el Número (Cloth)';

    return $errors;
}

function lobos_validate_jugador_on_save( $post_id, $post ) {
    if ( wp_is_post_autosave( $post_id ) || wp_is_post_revision( $post_id ) ) return;
    if ( $post->post_status !== 'publish' ) return;

    $errors = lobos_check_jugador_requirements( $post_id );
    if ( ! $errors ) return;

    remove_action( 'save_post_jugadores', 'lobos_validate_jugador_on_save', 10 );
    wp_update_post( [ 'ID' => $post_id, 'post_status' => 'draft' ] );
    add_action( 'save_post_jugadores', 'lobos_validate_jugador_on_save', 10, 2 );

    set_transient( 'lobos_jugador_validation_' . $post_id, $errors, 60 );
}
add_action( 'save_post_jugadores', 'lobos_validate_jugador_on_save', 10, 2 );

// Block-editor (REST) path — runs AFTER taxonomy + meta are saved on the post.
add_action( 'rest_after_insert_jugadores', function ( $post, $request, $creating ) {
    if ( $post->post_status !== 'publish' ) return;

    $errors = lobos_check_jugador_requirements( $post->ID );
    if ( ! $errors ) return;

    // Demote to draft and store the error so the next admin load shows it
    wp_update_post( [ 'ID' => $post->ID, 'post_status' => 'draft' ] );
    set_transient( 'lobos_jugador_validation_' . $post->ID, $errors, 60 );
}, 10, 3 );

add_action( 'admin_notices', function () {
    global $post;
    if ( ! $post || $post->post_type !== 'jugadores' ) return;
    $errors = get_transient( 'lobos_jugador_validation_' . $post->ID );
    if ( ! $errors ) return;

    delete_transient( 'lobos_jugador_validation_' . $post->ID );

    echo '<div class="notice notice-error"><p><strong>No se pudo publicar:</strong> '
       . 'falta '
       . esc_html( implode( ' y falta ', (array) $errors ) )
       . '. El post se guardó como borrador.</p></div>';
} );
