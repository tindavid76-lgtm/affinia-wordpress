<?php
get_header();
?>
<main id="primary" class="site-main">
	<div class="public-content">
		<?php while ( have_posts() ) : the_post(); get_template_part( 'template-parts/content/content', 'single' ); the_post_navigation( array( 'prev_text' => '← %title', 'next_text' => '%title →' ) ); if ( comments_open() || get_comments_number() ) : comments_template(); endif; endwhile; ?>
	</div>
</main>
<?php get_footer(); ?>
