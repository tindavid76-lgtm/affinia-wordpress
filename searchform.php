<?php
/**
 * Search form template
 *
 * @package Affinia
 * @since 1.0.0
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="search-label" for="search-field">
		<span class="screen-reader-text"><?php esc_html_e( 'Rechercher :', 'affinia' ); ?></span>
	</label>
	<input type="search" id="search-field" class="search-input" placeholder="<?php esc_attr_e( 'Rechercher…', 'affinia' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	<button type="submit" class="search-submit btn btn-primary">
		<?php esc_html_e( 'Rechercher', 'affinia' ); ?>
	</button>
</form>
