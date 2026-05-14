<?php
/**
 * Template Name: Contacto
 */

get_header();

$titulo     = get_field( 'contacto_titulo' ) ?: '¡Únete a la manada!';
$subtitulo  = get_field( 'contacto_subtitulo' );
$facebook   = get_field( 'contacto_facebook' );
$whatsapp   = get_field( 'contacto_whatsapp' );
$instagram  = get_field( 'contacto_instagram' );
$email      = get_field( 'contacto_email' );

$wa_url = $whatsapp
    ? 'https://wa.me/' . preg_replace( '/\D/', '', $whatsapp ) . '?text=Hola!%20Quisiera%20m%C3%A1s%20informaci%C3%B3n%20sobre%20Lobos%20Club%20de%20Dodgeball'
    : '#';
?>

<div class="contacto-wrapper claw-bg">

    <div class="contacto-glow" aria-hidden="true"></div>

    <div class="contacto-inner">

        <div class="contacto-header">
            <h1 class="contacto-title section-heading" data-aos="fade-up">
                <?php echo esc_html( $titulo ); ?>
            </h1>
            <?php if ( $subtitulo ) : ?>
                <p class="contacto-subtitulo" data-aos="fade-up" data-aos-delay="100">
                    <?php echo esc_html( $subtitulo ); ?>
                </p>
            <?php endif; ?>
        </div>

        <div class="contacto-channels">

            <?php if ( $facebook ) : ?>
                <a class="contacto-channel" href="<?php echo esc_url( $facebook ); ?>"
                   target="_blank" rel="noopener noreferrer"
                   data-aos="fade-up" data-aos-delay="0">
                    <span class="contacto-channel-icon"><i class="fa-brands fa-facebook"></i></span>
                    <span class="contacto-channel-label">Facebook</span>
                    <span class="contacto-channel-value">LobosDodgeball</span>
                </a>
            <?php endif; ?>

            <?php if ( $whatsapp ) : ?>
                <a class="contacto-channel" href="<?php echo esc_url( $wa_url ); ?>"
                   target="_blank" rel="noopener noreferrer"
                   data-aos="fade-up" data-aos-delay="120">
                    <span class="contacto-channel-icon"><i class="fa-brands fa-whatsapp"></i></span>
                    <span class="contacto-channel-label">WhatsApp</span>
                    <span class="contacto-channel-value">+<?php echo esc_html( preg_replace( '/\D/', '', $whatsapp ) ); ?></span>
                </a>
            <?php endif; ?>

            <?php if ( $instagram ) : ?>
                <a class="contacto-channel" href="<?php echo esc_url( $instagram ); ?>"
                   target="_blank" rel="noopener noreferrer"
                   data-aos="fade-up" data-aos-delay="240">
                    <span class="contacto-channel-icon"><i class="fa-brands fa-instagram"></i></span>
                    <span class="contacto-channel-label">Instagram</span>
                    <span class="contacto-channel-value">@lobos_dodgeball_</span>
                </a>
            <?php endif; ?>

            <?php if ( $email ) : ?>
                <a class="contacto-channel" href="mailto:<?php echo esc_attr( $email ); ?>"
                   data-aos="fade-up" data-aos-delay="360">
                    <span class="contacto-channel-icon"><i class="fa-solid fa-envelope"></i></span>
                    <span class="contacto-channel-label">Email</span>
                    <span class="contacto-channel-value"><?php echo esc_html( $email ); ?></span>
                </a>
            <?php endif; ?>

        </div>


    </div>

</div>

<?php get_footer(); ?>
