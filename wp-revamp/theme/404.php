<?php
/**
 * 404 — Página no encontrada
 */

get_header();
?>

<section class="lobos-404">
    <div class="lobos-404-inner">
        <p class="lobos-404-code" data-aos="zoom-in">404</p>
        <h1 class="lobos-404-title section-heading" data-aos="fade-up" data-aos-delay="120">
            Página no encontrada
        </h1>
        <p class="lobos-404-text" data-aos="fade-up" data-aos-delay="220">
            La página que buscas no existe o fue movida.
        </p>
        <div class="lobos-404-actions" data-aos="fade-up" data-aos-delay="320">
            <a class="btn-lobos" href="<?php echo esc_url( home_url( '/' ) ); ?>">Volver al inicio</a>
            <a class="lobos-404-link" href="<?php echo esc_url( home_url( '/equipos/' ) ); ?>">Ver Equipos</a>
        </div>
    </div>
</section>

<?php get_footer(); ?>
