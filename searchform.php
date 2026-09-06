<?php ?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="search" class="search-input" placeholder="<?php esc_attr_e( 'Rechercher…', 'affinia' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	<button type="submit" class="search-submit btn btn-primary"><?php esc_html_e( 'Rechercher', 'affinia' ); ?></button>
</form>
