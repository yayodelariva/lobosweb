<?php
/**
 * Template Name: Valores
 */

get_header();

$intro   = get_field( 'valores_intro' );
$valores = get_field( 'valores_lista' );
?>

<div class="valores-wrapper claw-bg">

    <div class="valores-header">
        <h1 class="valores-title section-heading" data-aos="fade-up">
            <?php the_title(); ?>
        </h1>
        <?php if ( $intro ) : ?>
            <div class="valores-intro" data-aos="fade-up" data-aos-delay="150">
                <?php echo wp_kses_post( $intro ); ?>
            </div>
        <?php endif; ?>
    </div>

    <?php if ( $valores ) : ?>
        <div class="valores-grid">
            <?php foreach ( $valores as $i => $valor ) : ?>
                <div class="valor-card" data-aos="fade-up" data-aos-delay="<?php echo $i * 100; ?>">
                    <h2 class="valor-card-title"><?php echo esc_html( $valor['titulo'] ); ?></h2>
                    <p class="valor-card-text"><?php echo esc_html( $valor['descripcion'] ); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

</div>

<?php get_footer(); ?>
