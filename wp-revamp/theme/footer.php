<footer class="home-footer">
    <span class="home-footer-text">&copy; <?php echo date( 'Y' ); ?> Lobos Club de Dodgeball</span>
    <span class="home-footer-text">México</span>
    <?php if ( $lobos_privacy_url = get_privacy_policy_url() ) : ?>
        <a class="home-footer-text home-footer-link" href="<?php echo esc_url( $lobos_privacy_url ); ?>">Aviso de Privacidad</a>
    <?php endif; ?>
</footer>

<?php wp_footer(); ?>
</body>
</html>
