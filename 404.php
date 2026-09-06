<?php
/**
 * 404 page template
 *
 * @package Affinia
 * @since 1.0.0
 */

get_header();
?>

<main id="primary" class="site-main">
	<div class="error-404">
		<div class="error-404-content">
			<span class="text-eyebrow"><?php esc_html_e( 'Erreur 404', 'affinia' ); ?></span>
			<h1><?php esc_html_e( 'Page introuvable', 'affinia' ); ?></h1>
			<p class="text-body"><?php esc_html_e( 'La page que vous cherchez n\'existe pas ou a été déplacée.', 'affinia' ); ?></p>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary">
				<?php esc_html_e( 'Retour à l\'accueil', 'affinia' ); ?>
			</a>
		</div>
	</div>
</main>

<?php
get_footer();
