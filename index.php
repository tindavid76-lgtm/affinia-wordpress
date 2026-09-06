<?php
/**
 * The main template file
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
				<?php get_template_part( 'template-parts/member/welcome-section' ); ?>
			</div>
		</div>
	<?php else : ?>
		<div class="public-content">
			<?php
			if ( have_posts() ) :
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/content/content', get_post_type() );
				endwhile;
				the_posts_navigation();
			else :
				get_template_part( 'template-parts/content/content', 'none' );
			endif;
			?>
		</div>
	<?php endif; ?>
</main>

<?php
get_footer();
