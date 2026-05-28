<?php
/**
 * Template Name: Únete
 */

get_header();

$hero_bg    = get_field( 'unete_hero_bg' );
$tagline    = get_field( 'unete_tagline' );
$info_texto = get_field( 'unete_info_texto' );
$cta_texto  = get_field( 'unete_cta_texto' );

// Hardcoded benefits, recovered from the legacy site (ACF Free doesn't support
// repeaters). To add/remove/reorder, edit this list.
$beneficios = [
    'Gimnasio de pesas lunes a viernes 19:00 a 21:00 hrs.',
    'Gimnasio cerrado, techado lunes a viernes 21:00 a 23:00 hrs, Anexo Eduardo Gorraez.',
    'Gimnasio cerrado, techado lunes a viernes 19:00 a 20:00 hrs, Gimnasio 2, Villa Olímpica.',
    'Coaches especializados.',
    'Vinculación con Phyxed, Clínica de Fisioterapia y Entrenamiento Funcional: 2 días de preparación física en cada una de las instalaciones de Lobos (Gorraez y Villa Olímpica), y costo preferencial en la clínica de fisioterapia y preparación física especializada.',
    'Baloneras, conos y material de entrenamiento.',
    'Exposición en redes sociales y página de internet. Fotos y videos.',
];
$whatsapp   = get_field( 'unete_whatsapp' );

$wa_number  = preg_replace( '/\D/', '', $whatsapp ?: '525514329482' );
$wa_url     = 'https://wa.me/' . $wa_number . '?text=Hola!%20Quisiera%20m%C3%A1s%20informaci%C3%B3n%20sobre%20Lobos%20Club%20de%20Dodgeball';

$hero_style = $hero_bg
    ? 'style="background-image: url(\'' . esc_url( $hero_bg['url'] ) . '\');"'
    : '';
?>

<div class="unete-wrapper">

    <section class="unete-hero claw-bg" <?php echo $hero_style; ?>>
        <div class="unete-hero-overlay"></div>
        <div class="unete-hero-inner">
            <h1 class="unete-hero-title" data-aos="fade-up">
                <?php echo esc_html( $tagline ?: get_the_title() ); ?>
            </h1>
        </div>
    </section>

    <?php if ( $info_texto ) : ?>
        <section class="unete-info claw-bg-white">
            <div class="unete-info-inner" data-aos="fade-right" data-aos-duration="900">
                <div class="unete-info-text"><?php echo wp_kses_post( $info_texto ); ?></div>
            </div>
        </section>
    <?php endif; ?>

    <?php if ( $beneficios ) : ?>
        <section class="unete-benefits claw-bg">
            <div class="unete-benefits-inner">
                <h2 class="unete-benefits-title section-heading" data-aos="fade-up">Beneficios</h2>
                <ul class="unete-benefits-list" data-aos-stagger="80">
                    <?php foreach ( $beneficios as $item ) : ?>
                        <li><?php echo esc_html( $item ); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </section>
    <?php endif; ?>

    <section class="unete-cta claw-bg" id="unete-cta">
        <div class="unete-cta-inner">
            <?php if ( $cta_texto ) : ?>
                <p class="unete-cta-text section-heading" data-aos="zoom-in">
                    <?php echo esc_html( $cta_texto ); ?>
                </p>
            <?php endif; ?>
            <a class="btn-lobos unete-cta-btn"
               href="<?php echo esc_url( $wa_url ); ?>"
               target="_blank" rel="noopener noreferrer"
               data-aos="zoom-in" data-aos-delay="150">
                Contáctanos por WhatsApp
            </a>
        </div>
    </section>

</div>

<?php get_footer(); ?>
