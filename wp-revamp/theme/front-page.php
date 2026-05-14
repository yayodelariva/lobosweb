<?php
$hero_bg         = get_field( 'home_hero_bg' );
$hero_titulo     = get_field( 'home_hero_titulo' ) ?: 'Lobos Club de Dodgeball';
$hero_blurb      = get_field( 'home_hero_blurb' );
$hero_cta_texto  = get_field( 'home_hero_cta_texto' ) ?: 'Únete';
$hero_cta_url    = get_field( 'home_hero_cta_url' ) ?: '#';
$stats           = get_field( 'home_stats' );
$historia_texto  = get_field( 'home_historia_texto' );
$contacto_titulo = get_field( 'home_contacto_titulo' ) ?: '¡Únete a la manada!';
$facebook        = get_field( 'home_facebook' );
$whatsapp_num    = get_field( 'home_whatsapp' );
$instagram       = get_field( 'home_instagram' );

$hero_bg_url = $hero_bg ? esc_url( $hero_bg['url'] ) : '';
$wa_url      = $whatsapp_num
    ? 'https://wa.me/' . preg_replace( '/\D/', '', $whatsapp_num ) . '?text=Hola!%20Quisiera%20m%C3%A1s%20informaci%C3%B3n%20sobre%20Lobos%20Club%20de%20Dodgeball'
    : '#';

$words  = explode( ' ', trim( $hero_titulo ) );
$chunks = [
    $words[0] ?? '',
    implode( ' ', array_slice( $words, 1, 2 ) ),
    implode( ' ', array_slice( $words, 3 ) ),
];
$chunks = array_values( array_filter( $chunks ) );

get_header();
?>

<main>

    <!-- ── Hero ── -->
    <section class="home-hero" id="hero"<?php if ( $hero_bg_url ) echo ' style="background-image: url(\'' . $hero_bg_url . '\');"'; ?>>
        <div class="home-hero-overlay" aria-hidden="true"></div>
        <div class="home-hero-content">
            <span class="home-hero-eyebrow">Club de Dodgeball &middot; México</span>
            <h1 class="home-hero-title">
                <?php foreach ( $chunks as $i => $chunk ) : ?>
                    <span class="hero-line-wrap">
                        <span class="hero-line<?php echo $i === 0 ? ' hero-line--accent' : ''; ?>">
                            <?php echo esc_html( $chunk ); ?>
                        </span>
                    </span>
                <?php endforeach; ?>
            </h1>
            <?php if ( $hero_blurb ) : ?>
                <p class="home-hero-blurb"><?php echo esc_html( $hero_blurb ); ?></p>
            <?php endif; ?>
            <a class="btn-lobos home-hero-btn" href="<?php echo esc_url( $hero_cta_url ); ?>">
                <?php echo esc_html( $hero_cta_texto ); ?>
            </a>
        </div>
        <div class="home-hero-scroll-hint" aria-hidden="true">
            <span>Scroll</span>
        </div>
    </section>

    <!-- ── Stats ── -->
    <?php if ( $stats ) : ?>
        <section class="home-stats" id="stats">
            <div class="home-stats-inner">
                <?php foreach ( $stats as $stat ) : ?>
                    <div class="home-stat-item">
                        <span class="stat-number"
                              data-count-target="<?php echo esc_attr( $stat['numero'] ); ?>"
                              data-count-suffix="<?php echo esc_attr( $stat['sufijo'] ); ?>">
                            <?php echo esc_html( $stat['numero'] . $stat['sufijo'] ); ?>
                        </span>
                        <span class="stat-label-text"><?php echo esc_html( $stat['etiqueta'] ); ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endif; ?>

    <!-- ── Historia ── -->
    <?php if ( $historia_texto ) : ?>
        <section class="home-historia" id="historia">
            <div class="home-historia-inner">
                <div class="home-historia-left">
                    <span class="section-eyebrow">Nuestra Historia</span>
                    <h2 class="home-historia-heading section-heading dark">El club más grande de México</h2>
                    <div class="historia-text"><?php echo wp_kses_post( $historia_texto ); ?></div>
                </div>
                <div class="home-historia-right" aria-hidden="true">
                    <span class="home-historia-year">2017</span>
                    <span class="home-historia-year-label">Fundación</span>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <!-- ── News / Instagram ── -->
    <section class="home-news claw-bg">
        <div class="home-news-inner">
            <span class="section-eyebrow" data-aos="fade-up">Síguenos</span>
            <h2 class="home-news-title section-heading" data-aos="fade-up" data-aos-delay="100">Últimas Noticias</h2>
            <div class="home-news-feed" data-aos="fade-up" data-aos-delay="200">
                <?php
                if ( shortcode_exists( 'instagram-feed' ) ) {
                    echo do_shortcode( '[instagram-feed num=3 cols=3 showheader=false showbutton=false showfollow=false]' );
                } else {
                    echo '<p class="home-news-fallback">Conecta tu cuenta de Instagram en Smash Balloon para mostrar las últimas publicaciones.</p>';
                }
                ?>
            </div>
        </div>
    </section>

    <!-- ── Contacto ── -->
    <section class="home-contacto" id="contacto">
        <div class="home-contacto-glow" aria-hidden="true"></div>
        <div class="home-contacto-inner">
            <h2 class="home-contacto-title section-heading">
                <?php echo esc_html( $contacto_titulo ); ?>
            </h2>
            <div class="home-social-links">
                <?php if ( $facebook ) : ?>
                    <a class="social-icon-link" href="<?php echo esc_url( $facebook ); ?>"
                       target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                        <i class="fa-brands fa-facebook"></i>
                    </a>
                <?php endif; ?>
                <?php if ( $whatsapp_num ) : ?>
                    <a class="social-icon-link" href="<?php echo esc_url( $wa_url ); ?>"
                       target="_blank" rel="noopener noreferrer" aria-label="WhatsApp">
                        <i class="fa-brands fa-whatsapp"></i>
                    </a>
                <?php endif; ?>
                <?php if ( $instagram ) : ?>
                    <a class="social-icon-link" href="<?php echo esc_url( $instagram ); ?>"
                       target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- ── Sponsors Ticker ── -->
    <?php
    // Hardcoded sponsors (ACF Free doesn't support repeaters).
    // To add/remove/reorder, edit this list and place new logos in /theme/images/logosfooter/.
    $logo_base = get_stylesheet_directory_uri() . '/images/logosfooter/';
    $ticker_sponsors = [
        [ 'file' => 'logoTlalpan.png',    'nombre' => 'Alcaldía Tlalpan',   'url' => 'https://alcaldiatlalpan.mx/' ],
        [ 'file' => 'FMDB-Rojo-V.png',    'nombre' => 'FMDB',               'url' => '' ],
        [ 'file' => 'codeme_logo.jpg',     'nombre' => 'Codeme',             'url' => 'https://www.codeme.com.mx/' ],
        [ 'file' => 'logoHit.png',         'nombre' => 'Hit Dodgeball Gear', 'url' => 'https://www.instagram.com/hitdodgeballgear/' ],
        [ 'file' => 'logoLhasa.png',       'nombre' => 'Agua Lhasa',         'url' => 'https://www.facebook.com/AguaLhasa' ],
        [ 'file' => 'logoIztapalapa.jpeg', 'nombre' => 'Iztapalapa',         'url' => 'https://www.iztapalapa.cdmx.gob.mx' ],
        [ 'file' => 'adomex-cuadrado.png', 'nombre' => 'Adomex',             'url' => 'https://www.adomexdodgeball.com/' ],
        [ 'file' => 'WDBF_logo.png',       'nombre' => 'WDBF',               'url' => 'https://worlddodgeballfederation.com/' ],
        [ 'file' => 'logoBJ.png',          'nombre' => 'Benito Juárez',      'url' => '' ],
        [ 'file' => 'logoCuauhtemoc.png',  'nombre' => 'Cuauhtémoc',         'url' => '' ],
    ];
    ?>
    <section class="home-sponsors-ticker">
        <div class="ticker-track">
            <?php foreach ( [ false, true ] as $hidden ) : ?>
                <div class="ticker-inner"<?php echo $hidden ? ' aria-hidden="true"' : ''; ?>>
                    <?php foreach ( $ticker_sponsors as $s ) : ?>
                        <div class="ticker-logo">
                            <img src="<?php echo esc_url( $logo_base . $s['file'] ); ?>"
                                 alt="<?php echo $hidden ? '' : esc_attr( $s['nombre'] ); ?>"
                                 loading="lazy">
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

</main>

<?php get_footer(); ?>
