<?php
/**
 * Generic page template
 *
 * @package Affinia
 * @since 1.0.0
 */

get_header();
?>

<main id="primary" class="site-main">
	<?php if ( is_user_logged_in() ) : ?>
		<div class="member-layout">
			<?php get_sidebar( 'member' ); ?>
			<div class="member-content">
				<?php
				while ( have_posts() ) :
					the_post();
					the_content();
				endwhile;
				?>
			</div>
		</div>
	<?php else : ?>
		<div class="public-content">
			<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content/content', 'page' );
			endwhile;
			?>
		</div>
	<?php endif; ?>
</main>

<?php
get_footer();
