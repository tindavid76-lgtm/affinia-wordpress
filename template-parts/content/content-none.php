<?php
/**
 * Template part for displaying a "no posts found" message
 *
 * @package Affinia
 * @since 1.0.0
 */
?>

<section class="no-results not-found">
	<div class="empty-state">
		<h2><?php esc_html_e( 'Rien trouvé', 'affinia' ); ?></h2>

		<?php if ( is_search() ) : ?>
			<p class="text-body"><?php esc_html_e( 'Aucun résultat ne correspond à votre recherche. Essayez d\'autres termes.', 'affinia' ); ?></p>
			<?php get_search_form(); ?>
		<?php else : ?>
			<p class="text-body"><?php esc_html_e( 'Aucun contenu disponible pour le moment.', 'affinia' ); ?></p>
		<?php endif; ?>
	</div>
</section>
