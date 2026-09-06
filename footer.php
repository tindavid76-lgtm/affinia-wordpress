<?php ?>
	<footer id="colophon" class="site-footer">
		<div class="footer-inner">
			<div class="footer-brand"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer-logo"><span class="logo-icon">É</span><span class="logo-text">Élégance Rencontre</span></a><p class="footer-tagline"><?php esc_html_e( 'La rencontre premium, en toute élégance.', 'affinia' ); ?></p></div>
			<div class="footer-links"><?php wp_nav_menu( array( 'theme_location' => 'footer', 'menu_class' => 'footer-nav-list', 'container' => false, 'depth' => 1 ) ); ?></div>
			<div class="footer-legal"><p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. <?php esc_html_e( 'Tous droits réservés.', 'affinia' ); ?></p></div>
		</div>
	</footer>
	<?php if ( is_user_logged_in() ) : get_template_part( 'template-parts/member/bottom-nav' ); endif; ?>
</div>
<?php wp_footer(); ?>
</body>
</html>
