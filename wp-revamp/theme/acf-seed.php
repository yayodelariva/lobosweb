<?php
/**
 * One-time ACF content seeder — imported from the legacy static site.
 * REMOVE this file (and the require_once in functions.php) after it runs once.
 *
 * Runs on the first page load after being included. A flag in wp_options
 * ('lobos_acf_seeded') prevents it from ever running again.
 */

add_action( 'init', function () {

    if ( get_option( 'lobos_acf_seeded' ) || ! function_exists( 'update_field' ) ) {
        return;
    }

    // ── Helpers ────────────────────────────────────────────────────────────────

    // Find a page by its assigned template filename.
    $by_template = function ( $tpl ) {
        $pages = get_posts( [
            'post_type'      => 'page',
            'posts_per_page' => 1,
            'meta_key'       => '_wp_page_template',
            'meta_value'     => $tpl,
        ] );
        return $pages ? $pages[0]->ID : 0;
    };

    // ── Home (front page) ──────────────────────────────────────────────────────

    $home_id = (int) get_option( 'page_on_front' );

    if ( $home_id ) {
        update_field( 'home_hero_titulo',    'Lobos Club de Dodgeball', $home_id );
        update_field( 'home_hero_blurb',     'Somos ganadores y siempre buscamos los lugares más altos en la competencia.', $home_id );
        update_field( 'home_hero_cta_texto', 'Únete', $home_id );
        update_field( 'home_hero_cta_url',   home_url( '/unete/' ), $home_id );

        update_field( 'home_intro_texto',
            'Ser un Lobo es ser parte de la manada, jugamos en equipo, pertenecemos a algo más grande. El Club más grande de México.',
            $home_id
        );

        update_field( 'home_historia_texto',
            '<p>Ser un Lobo es ser parte de la manada, jugamos en equipo, pertenecemos a algo más grande. El Club más grande de México. Lobos Club de Dodgeball es el equipo más exitoso a nivel nacional, teniendo varios campeonatos nacionales en nuestro palmarés. También es el club que más ha aportado jugadores al equipo de la selección mexicana. Desde la primera selección nacional en 2015, con la invitación al equipo del fundador del Club, Luis de la Riva, en 2019 llevando a más de 10 jugadores en todas las ramas y aportando más del 50% del equipo nacional desde el 2022 a la fecha.</p>',
            $home_id
        );

        update_field( 'home_stats', [
            [ 'numero' => 9,  'sufijo' => '',  'etiqueta' => 'Años de historia'       ],
            [ 'numero' => 10, 'sufijo' => '+', 'etiqueta' => 'Campeonatos nacionales'  ],
            [ 'numero' => 50, 'sufijo' => '%', 'etiqueta' => 'Del equipo nacional'     ],
            [ 'numero' => 6,  'sufijo' => '',  'etiqueta' => 'Categorías activas'      ],
        ], $home_id );

        update_field( 'home_contacto_titulo', '¡Únete a la manada!', $home_id );
        update_field( 'home_facebook',        'https://www.facebook.com/LobosDodgeball', $home_id );
        update_field( 'home_whatsapp',        '525514329482', $home_id );
        update_field( 'home_instagram',       'https://www.instagram.com/lobos_dodgeball_/', $home_id );
    }

    // ── Contacto ───────────────────────────────────────────────────────────────

    $contacto_id = $by_template( 'template-contacto.php' );

    if ( $contacto_id ) {
        update_field( 'contacto_titulo',    '¡Únete a la manada!', $contacto_id );
        update_field( 'contacto_subtitulo', 'Estamos para responderte.', $contacto_id );
        update_field( 'contacto_whatsapp',  '525514329482', $contacto_id );
        update_field( 'contacto_instagram', 'https://www.instagram.com/lobos_dodgeball_/', $contacto_id );
        update_field( 'contacto_facebook',  'https://www.facebook.com/LobosDodgeball', $contacto_id );
    }

    // ── Únete ──────────────────────────────────────────────────────────────────

    $unete_id = $by_template( 'template-unete.php' );

    if ( $unete_id ) {
        update_field( 'unete_tagline',
            'Somos ganadores y siempre buscamos los lugares más altos en la competencia.',
            $unete_id
        );

        update_field( 'unete_info_texto',
            '<p>Ser un Lobo es ser parte de la manada, jugamos en equipo, pertenecemos a algo más grande. El Club más grande de México. Lobos Club de Dodgeball es el equipo más exitoso a nivel nacional, teniendo varios campeonatos nacionales en nuestro palmarés. También es el club que más ha aportado jugadores al equipo de la selección mexicana. Desde la primera selección nacional en 2015, con la invitación al equipo del fundador del Club, Luis de la Riva, en 2019 llevando a más de 10 jugadores en todas las ramas y aportando más del 50% del equipo nacional desde el 2022 a la fecha.</p>',
            $unete_id
        );

        update_field( 'unete_beneficios', [
            [ 'texto' => 'Gimnasio de pesas lunes a viernes 19:00 a 21:00 hrs.' ],
            [ 'texto' => 'Gimnasio cerrado y techado lunes a viernes 21:00 a 23:00 hrs. — Anexo Eduardo Gorraez.' ],
            [ 'texto' => 'Gimnasio cerrado y techado lunes a viernes 19:00 a 20:00 hrs. — Gimnasio 2, Villa Olímpica.' ],
            [ 'texto' => 'Coaches especializados.' ],
            [ 'texto' => 'Vinculación con Phyxed (Clínica de Fisioterapia y Entrenamiento Funcional): 2 días de preparación física en cada instalación, costo preferencial en consultas ($350 MXN por consulta, sujeto a cambios).' ],
            [ 'texto' => 'Baloneras, conos y material de entrenamiento.' ],
            [ 'texto' => 'Exposición en redes sociales y página de internet — fotos y videos.' ],
        ], $unete_id );

        update_field( 'unete_cta_texto', '¡Sé parte de la manada!', $unete_id );
        update_field( 'unete_whatsapp',  '525514329482', $unete_id );
    }

    // ── Valores ────────────────────────────────────────────────────────────────

    $valores_id = $by_template( 'template-valores.php' );

    if ( $valores_id ) {
        update_field( 'valores_intro',
            '<p><strong>Excelencia, compromiso, espíritu ganador, filosofía de equipo.</strong><br>La leyenda del club más grande de Dodgeball México se cimienta sobre unos valores que son los que han ido forjando una entidad líder en el ámbito deportivo.</p>',
            $valores_id
        );

        update_field( 'valores_lista', [
            [
                'titulo'      => 'Excelencia',
                'descripcion' => 'La excelencia es un signo de identidad de Lobos Club de Dodgeball y forma parte esencial de nuestro club desde su fundación en 2017. Siempre nos exige llevar y ofrecer el más alto estándar de calidad al máximo nivel en todos los retos que afrontamos. Trabajamos el valor de la excelencia a través de la calidad, el liderazgo, la exigencia y el talento.',
            ],
            [
                'titulo'      => 'Compromiso',
                'descripcion' => 'Asumimos el compromiso que tenemos con la comunidad de Dodgeball en CDMX, México y el mundo. Se trata de la capacidad que tenemos para actuar con todos nuestros valores y ser fieles a nuestra historia, cumplir con todo lo que nuestro club representa.',
            ],
            [
                'titulo'      => 'Espíritu Ganador',
                'descripcion' => 'Nuestra mentalidad más esencial define nuestra actitud ante todo y conlleva responder con una predisposición positiva a los objetivos que nos marcamos cada temporada. Fomentamos nuestro espíritu ganador a través de constancia, esfuerzo, disciplina, sacrificio, entrega y superación.',
            ],
            [
                'titulo'      => 'Filosofía de Equipo',
                'descripcion' => 'Nos comprometemos al 100% con todos los objetivos deportivos trabajando juntos como manada, con la mentalidad de ganar el siguiente partido. Nos comprometemos con nuestros objetivos con compañerismo, generosidad, unión y empatía para alcanzar un fin común.',
            ],
            [
                'titulo'      => 'Respeto',
                'descripcion' => 'Tratamos a las personas, equipos y asociaciones con respeto, sin ofensas o perjuicios. En el terreno de juego obramos de buena fe y respetamos a todos los equipos con los que competimos. Fuera del terreno mantenemos relaciones fraternales y solidarias con todos los demás clubes.',
            ],
            [
                'titulo'      => 'Humildad',
                'descripcion' => 'Creemos firmemente que la humildad es una condición imprescindible para intentar seguir siendo mejores cada día. La humildad nos permite alejarnos de la autocomplacencia. Cada logro es un punto de partida para intentar conseguir el siguiente desafío.',
            ],
        ], $valores_id );
    }

    // Mark as done so this never runs again
    update_option( 'lobos_acf_seeded', true );

}, 20 );
