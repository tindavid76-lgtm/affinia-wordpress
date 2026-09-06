<?php
/**
 * Template Name: Favoris
 * Description: Page des profils favoris
 *
 * @package Affinia
 * @since 1.0.0
 */

if ( ! is_user_logged_in() ) {
	wp_redirect( wp_login_url( get_permalink() ) );
	exit;
}

$current_user = wp_get_current_user();
$favorites = affinia_get_user_favorites( $current_user->ID );
$mutual = affinia_get_mutual_favorites( $current_user->ID );

get_header();
?>

<main id="primary" class="site-main">
	<div class="member-layout">
		<?php get_sidebar(); ?>

		<div class="member-content">
			<div class="page-header">
				<span class="text-eyebrow"><?php esc_html_e( 'Vos connexions', 'affinia' ); ?></span>
				<h1><?php esc_html_e( 'Favoris', 'affinia' ); ?></h1>
			</div>

			<!-- Tabs -->
			<div class="tabs" style="display: flex; gap: var(--space-sm); margin-bottom: var(--space-xl);">
				<button class="btn btn-primary btn-sm btn-pill tab-btn is-active" data-tab="all">
					<?php printf( esc_html__( 'Tous (%d)', 'affinia' ), count( $favorites ) ); ?>
				</button>
				<button class="btn btn-ghost btn-sm btn-pill tab-btn" data-tab="mutual">
					<?php printf( esc_html__( 'Mutuels (%d)', 'affinia' ), count( $mutual ) ); ?>
				</button>
			</div>

			<!-- Grille favoris -->
			<?php if ( ! empty( $favorites ) ) : ?>
				<div class="favorites-grid" id="tab-all">
					<?php foreach ( $favorites as $profile ) : ?>
						<?php
						set_query_var( 'profile_data', $profile );
						set_query_var( 'show_favorite_btn', true );
						get_template_part( 'template-parts/member/card', 'profile' );
						?>
					<?php endforeach; ?>
				</div>
			<?php else : ?>
				<div class="empty-state">
					<div class="empty-state-icon">♥</div>
					<h3><?php esc_html_e( 'Aucun favori pour le moment', 'affinia' ); ?></h3>
					<p class="text-body"><?php esc_html_e( 'Explorez les profils et ajoutez vos coups de cœur ici.', 'affinia' ); ?></p>
					<a href="<?php echo esc_url( home_url( '/decouverte/' ) ); ?>" class="btn btn-primary btn-pill">
						<?php esc_html_e( 'Découvrir des profils', 'affinia' ); ?>
					</a>
				</div>
			<?php endif; ?>
		</div>
	</div>
</main>

<?php
get_footer();
