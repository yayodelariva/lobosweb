<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title( '|', true, 'right' ); ?><?php bloginfo( 'name' ); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="noise-overlay" aria-hidden="true"></div>

<nav class="home-nav" id="home-nav">
    <?php wp_nav_menu( [
        'theme_location' => 'primary',
        'container'      => false,
        'menu_class'     => 'home-nav-menu',
        'fallback_cb'    => false,
    ] ); ?>
    <button class="mobile-menu-btn" id="mobile-menu-btn" aria-label="Abrir menú" aria-expanded="false">
        <span class="mobile-menu-bar"></span>
        <span class="mobile-menu-bar"></span>
        <span class="mobile-menu-bar"></span>
    </button>
</nav>

<div class="mobile-menu-overlay" id="mobile-menu-overlay" aria-hidden="true">
    <div class="mobile-menu-noise" aria-hidden="true"></div>
    <?php wp_nav_menu( [
        'theme_location' => 'primary',
        'container'      => false,
        'menu_class'     => 'mobile-menu-list',
        'fallback_cb'    => false,
    ] ); ?>
</div>
