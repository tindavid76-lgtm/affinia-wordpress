<?php
/**
 * Template part for displaying single post content
 *
 * @package Affinia
 * @since 1.0.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<span class="text-eyebrow"><?php echo esc_html( get_the_date() ); ?></span>
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="entry-thumbnail">
			<?php the_post_thumbnail( 'affinia-hero' ); ?>
		</div>
	<?php endif; ?>

	<div class="entry-content">
		<?php the_content(); ?>
	</div>

	<footer class="entry-footer">
		<?php
		$tags = get_the_tag_list( '', ' ' );
		if ( $tags ) {
			echo '<div class="entry-tags">' . $tags . '</div>';
		}
		?>
	</footer>
</article>
