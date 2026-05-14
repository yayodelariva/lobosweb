<?php
/**
 * Template Name: Palmarés
 */

get_header();

$results = new WP_Query( [
    'post_type'      => 'palmares',
    'posts_per_page' => -1,
    'meta_key'       => 'anio',
    'orderby'        => 'meta_value_num',
    'order'          => 'DESC',
] );

// Group results by year → disciplina → fuerza → categoria
$grouped = [];
if ( $results->have_posts() ) {
    while ( $results->have_posts() ) {
        $results->the_post();
        $anio       = get_field( 'anio' );
        $disciplina = get_field( 'disciplina' );
        $fuerza     = get_field( 'fuerza' );
        $categoria  = get_field( 'categoria' );
        $lugar      = get_field( 'lugar' );
        $subequipo  = get_field( 'subequipo' );

        $grouped[ $anio ][ $disciplina ][ $fuerza ][] = [
            'categoria' => $categoria,
            'lugar'     => $lugar,
            'subequipo' => $subequipo,
        ];
    }
    wp_reset_postdata();
}

// Sort each disciplina's fuerza buckets so Primera always renders before Segunda.
$fuerza_order = [ 'Primera' => 0, 'Segunda' => 1 ];
// And sort each fuerza's entries by lugar ASC, then by categoria (Mixto, Femenil, Varonil).
$categoria_order = [ 'Mixto' => 0, 'Femenil' => 1, 'Varonil' => 2 ];

foreach ( $grouped as $anio => $disciplinas ) {
    foreach ( $disciplinas as $disciplina => $fuerzas ) {
        uksort( $fuerzas, function ( $a, $b ) use ( $fuerza_order ) {
            return ( $fuerza_order[ $a ] ?? 99 ) <=> ( $fuerza_order[ $b ] ?? 99 );
        } );
        foreach ( $fuerzas as $fuerza => $entries ) {
            usort( $entries, function ( $a, $b ) use ( $categoria_order ) {
                $lugar_cmp = (int) $a['lugar'] <=> (int) $b['lugar'];
                if ( $lugar_cmp !== 0 ) return $lugar_cmp;
                return ( $categoria_order[ $a['categoria'] ] ?? 99 )
                     <=> ( $categoria_order[ $b['categoria'] ] ?? 99 );
            } );
            $fuerzas[ $fuerza ] = $entries;
        }
        $grouped[ $anio ][ $disciplina ] = $fuerzas;
    }
}

$lugar_labels = [
    '1' => '1° lugar', '2' => '2° lugar', '3' => '3° lugar',
    '4' => '4° lugar', '5' => '5° lugar', '6' => '6° lugar',
    '7' => '7° lugar', '8' => '8° lugar',
];
?>

<div class="palmares-wrapper claw-bg">
    <h1 class="palmares-title"><?php the_title(); ?></h1>

    <?php if ( empty( $grouped ) ) : ?>
        <p>No hay resultados registrados.</p>
    <?php else : ?>

        <?php
        $first = true;
        foreach ( $grouped as $anio => $disciplinas ) :
            // Count championships (1° lugar) across all categories that year
            $titulos = 0;
            foreach ( $disciplinas as $fuerzas ) {
                foreach ( $fuerzas as $cats ) {
                    foreach ( $cats as $entry ) {
                        if ( $entry['lugar'] === '1' || $entry['lugar'] === 1 ) $titulos++;
                    }
                }
            }
        ?>
            <details class="palmares-year-block"<?php echo $first ? ' open' : ''; ?>>
                <summary class="palmares-year-summary">
                    <span class="palmares-year"><?php echo esc_html( $anio ); ?></span>
                    <?php if ( $titulos > 0 ) : ?>
                        <span class="palmares-year-titulos">
                            <?php echo $titulos; ?> <?php echo $titulos === 1 ? 'título' : 'títulos'; ?>
                        </span>
                    <?php endif; ?>
                    <span class="palmares-year-chevron" aria-hidden="true"></span>
                </summary>

                <div class="palmares-year-body">
                    <?php foreach ( $disciplinas as $disciplina => $fuerzas ) : ?>
                        <div class="palmares-disciplina-block">
                            <h3 class="palmares-disciplina"><?php echo esc_html( $disciplina ); ?></h3>

                            <?php foreach ( $fuerzas as $fuerza => $categorias ) : ?>
                                <div class="palmares-fuerza-block">
                                    <h4 class="palmares-fuerza"><?php echo esc_html( $fuerza ); ?> Fuerza</h4>

                                    <div class="palmares-results">
                                        <?php foreach ( $categorias as $entry ) : ?>
                                            <div class="palmares-entry palmares-lugar-<?php echo esc_attr( $entry['lugar'] ); ?>">
                                                <span class="palmares-categoria"><?php echo esc_html( $entry['categoria'] ); ?></span>
                                                <span class="palmares-resultado">
                                                    <?php echo esc_html( $lugar_labels[ $entry['lugar'] ] ?? $entry['lugar'] ); ?>
                                                    <?php if ( $entry['subequipo'] ) echo ' — ' . esc_html( $entry['subequipo'] ); ?>
                                                </span>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </details>
        <?php
            $first = false;
        endforeach; ?>

    <?php endif; ?>
</div>

<?php get_footer(); ?>
