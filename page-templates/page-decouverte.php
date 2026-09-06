<?php
/**
 * Template Name: Découverte
 * Description: Page de découverte des profils compatibles
 *
 * @package Affinia
 * @since 1.0.0
 */

if ( ! is_user_logged_in() ) {
	wp_redirect( wp_login_url( get_permalink() ) );
	exit;
}

$current_user = wp_get_current_user();
$profile_completion = affinia_get_profile_completion( $current_user->ID );
$region = get_user_meta( $current_user->ID, 'affinia_region', true ) ?: __( 'Votre région', 'affinia' );

get_header();
?>

<main id="primary" class="site-main">
	<div class="member-layout">
		<?php get_sidebar(); ?>

		<div class="member-content">
			<!-- Section bienvenue -->
			<section class="welcome-section">
				<span class="welcome-greeting">
					<?php printf( esc_html__( 'Bonjour %s', 'affinia' ), esc_html( $current_user->display_name ) ); ?>
				</span>
				<h1 class="welcome-title"><?php esc_html_e( 'Votre espace de rencontre', 'affinia' ); ?></h1>
				<p class="welcome-subtitle">
					<?php esc_html_e( 'Des suggestions disponibles selon votre région et vos préférences.', 'affinia' ); ?>
				</p>
			</section>

			<!-- Quick access -->
			<div class="quick-access-grid">
				<a href="<?php echo esc_url( home_url( '/profil/' ) ); ?>" class="quick-access-card">
					<h3><?php esc_html_e( 'Profil', 'affinia' ); ?></h3>
					<p><?php echo esc_html( $profile_completion . ' % complété' ); ?></p>
				</a>
				<a href="<?php echo esc_url( home_url( '/decouverte/' ) ); ?>" class="quick-access-card">
					<h3><?php esc_html_e( 'Suggestions', 'affinia' ); ?></h3>
					<p><?php esc_html_e( 'Selon votre région', 'affinia' ); ?></p>
				</a>
				<a href="<?php echo esc_url( home_url( '/messagerie/' ) ); ?>" class="quick-access-card">
					<h3><?php esc_html_e( 'Messages', 'affinia' ); ?></h3>
					<p><?php echo esc_html( affinia_get_unread_count( $current_user->ID ) . ' ' . __( 'nouveau message', 'affinia' ) ); ?></p>
				</a>
			</div>

			<!-- Section Découverte -->
			<section class="discovery-section">
				<div class="discovery-heading">
					<h2><?php esc_html_e( 'Découverte', 'affinia' ); ?></h2>
					<span class="pill pill-violet"><?php echo esc_html( strtoupper( $region ) ); ?></span>
				</div>

				<?php
				$suggestions = affinia_get_suggestions( $current_user->ID );

				if ( ! empty( $suggestions ) ) :
				?>
					<div class="favorites-grid">
						<?php foreach ( $suggestions as $profile ) : ?>
							<?php
							set_query_var( 'profile_data', $profile );
							get_template_part( 'template-parts/member/card', 'profile' );
							?>
						<?php endforeach; ?>
					</div>
				<?php else : ?>
					<div class="discovery-empty">
						<div class="discovery-empty-visual">
							<svg width="80" height="80" viewBox="0 0 80 80" fill="none">
								<circle cx="30" cy="40" r="20" fill="#E9F7D7" />
								<circle cx="50" cy="40" r="20" fill="#F1EAFB" />
							</svg>
						</div>
						<h3><?php esc_html_e( 'Les profils compatibles apparaîtront ici.', 'affinia' ); ?></h3>
						<p><?php esc_html_e( 'La disponibilité dépend de votre région. Aucun faux profil ni nombre de membres inventé.', 'affinia' ); ?></p>
						<a href="<?php echo esc_url( home_url( '/profil/' ) ); ?>" class="btn btn-primary btn-pill">
							<?php esc_html_e( 'Compléter mes préférences', 'affinia' ); ?>
						</a>
					</div>
				<?php endif; ?>

				<p class="discovery-footer">
					<?php esc_html_e( 'Votre adresse exacte n\'est jamais affichée. Vous gardez le contrôle de votre visibilité.', 'affinia' ); ?>
				</p>
			</section>
		</div>
	</div>
</main>

<?php
get_footer();
