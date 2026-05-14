<?php
/**
 * Template Name: Navigation
 */

get_header();

$children = get_pages( [
    'parent'      => get_the_ID(),
    'sort_column' => 'menu_order',
    'sort_order'  => 'ASC',
] );
?>

<div class="nav-page-wrapper claw-bg">
    <h1 class="nav-page-title"><?php the_title(); ?></h1>

    <?php if ( $children ) : ?>
        <div class="nav-cards-grid">
            <?php foreach ( $children as $child ) : ?>
                <a href="<?php echo esc_url( get_permalink( $child->ID ) ); ?>" class="nav-card">
                    <?php if ( has_post_thumbnail( $child->ID ) ) : ?>
                        <div class="nav-card-image">
                            <?php echo get_the_post_thumbnail( $child->ID, 'medium' ); ?>
                        </div>
                    <?php endif; ?>
                    <div class="nav-card-title"><?php echo esc_html( $child->post_title ); ?></div>
                </a>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
