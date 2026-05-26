<?php
/**
 * Template Name: Roster
 */

get_header();

$equipo_slug = get_field( 'equipo_filter' );           // e.g. "cloth-varonil"
$disciplina  = explode( '-', (string) $equipo_slug )[0] ?? '';  // foam or cloth
$numero_key  = $disciplina === 'cloth' ? 'numero_cloth' : 'numero_foam';

$tax_query = $equipo_slug
    ? [ [ 'taxonomy' => 'equipo', 'field' => 'slug', 'terms' => $equipo_slug ] ]
    : [];

$players = new WP_Query( [
    'post_type'      => 'jugadores',
    'posts_per_page' => -1,
    'tax_query'      => $tax_query,
    'meta_key'       => $numero_key,
    'orderby'        => 'meta_value_num',
    'order'          => 'ASC',
] );

$roster_pages_query = new WP_Query( [
    'post_type'      => 'page',
    'posts_per_page' => -1,
    'meta_key'       => '_wp_page_template',
    'meta_value'     => 'template-roster.php',
    'no_found_rows'  => true,
] );

$rosters = [ 'foam' => [], 'cloth' => [] ];
foreach ( $roster_pages_query->posts as $rp ) {
    $rp_slug = get_field( 'equipo_filter', $rp->ID );
    if ( ! $rp_slug ) continue;
    $parts = explode( '-', $rp_slug );
    $disc  = $parts[0] ?? '';
    $cat   = $parts[1] ?? '';
    if ( ! isset( $rosters[ $disc ] ) ) continue;
    $rosters[ $disc ][] = [
        'slug'    => $rp_slug,
        'cat'     => $cat,
        'label'   => ucfirst( $cat ),
        'url'     => get_permalink( $rp->ID ),
        'current' => $rp_slug === $equipo_slug,
    ];
}

$cat_order = [ 'varonil' => 0, 'femenil' => 1, 'mixto' => 2 ];
foreach ( $rosters as &$group ) {
    usort( $group, function ( $a, $b ) use ( $cat_order ) {
        return ( $cat_order[ $a['cat'] ] ?? 99 ) <=> ( $cat_order[ $b['cat'] ] ?? 99 );
    } );
}
unset( $group );
?>

<div class="roster-wrapper claw-bg">
    <h1 class="roster-title"><?php the_title(); ?></h1>

    <div class="roster-layout">
        <aside class="roster-sidebar" aria-label="Otros rosters">
            <?php foreach ( [ 'foam' => 'Foam', 'cloth' => 'Cloth' ] as $disc_key => $disc_label ) : ?>
                <?php if ( empty( $rosters[ $disc_key ] ) ) continue; ?>
                <div class="roster-sidebar-group">
                    <h3 class="roster-sidebar-heading"><?php echo esc_html( $disc_label ); ?></h3>
                    <ul>
                        <?php foreach ( $rosters[ $disc_key ] as $r ) : ?>
                            <li class="<?php echo $r['current'] ? 'is-current' : ''; ?>">
                                <?php if ( $r['current'] ) : ?>
                                    <span aria-current="page"><?php echo esc_html( $r['label'] ); ?></span>
                                <?php else : ?>
                                    <a href="<?php echo esc_url( $r['url'] ); ?>"><?php echo esc_html( $r['label'] ); ?></a>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endforeach; ?>
        </aside>

        <div class="roster-main">
            <?php if ( $players->have_posts() ) : ?>
                <div class="roster-grid">
                    <?php while ( $players->have_posts() ) : $players->the_post(); ?>
                        <a href="<?php the_permalink(); ?>" class="player-card">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="player-portrait">
                                    <?php the_post_thumbnail( 'medium' ); ?>
                                </div>
                            <?php endif; ?>
                            <div class="player-name"><?php the_title(); ?></div>
                            <?php $num = get_field( $numero_key ); if ( $num ) : ?>
                                <div class="player-number">#<?php echo esc_html( $num ); ?></div>
                            <?php endif; ?>
                        </a>
                    <?php endwhile; wp_reset_postdata(); ?>
                </div>
            <?php else : ?>
                <p class="roster-empty">No hay jugadores registrados en esta categoría.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
