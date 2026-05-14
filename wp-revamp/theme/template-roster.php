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
?>

<div class="roster-wrapper claw-bg">
    <h1 class="roster-title"><?php the_title(); ?></h1>

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

<?php get_footer(); ?>
