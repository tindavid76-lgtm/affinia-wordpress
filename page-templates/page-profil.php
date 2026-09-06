<?php
/**
 * Template Name: Profil Membre
 * Description: Page de profil et préférences du membre
 *
 * @package Affinia
 * @since 1.0.0
 */

if ( ! is_user_logged_in() ) {
	wp_redirect( wp_login_url( get_permalink() ) );
	exit;
}

$current_user = wp_get_current_user();
$user_id = $current_user->ID;
$profile_completion = affinia_get_profile_completion( $user_id );

// Récupérer les métadonnées du profil
$bio = get_user_meta( $user_id, 'affinia_bio', true );
$age = get_user_meta( $user_id, 'affinia_age', true );
$location = get_user_meta( $user_id, 'affinia_location', true );
$interests = get_user_meta( $user_id, 'affinia_interests', true ) ?: array();
$preferences = get_user_meta( $user_id, 'affinia_preferences', true ) ?: array();

get_header();
?>

<main id="primary" class="site-main">
	<div class="member-layout">
		<?php get_sidebar(); ?>

		<div class="member-content">
			<div class="page-header">
				<span class="text-eyebrow"><?php esc_html_e( 'Mon espace', 'affinia' ); ?></span>
				<h1><?php esc_html_e( 'Profil & Préférences', 'affinia' ); ?></h1>
			</div>

			<!-- Progression profil -->
			<div class="card" style="margin-bottom: var(--space-xl);">
				<div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: var(--space-md);">
					<h3><?php esc_html_e( 'Complétion du profil', 'affinia' ); ?></h3>
					<span style="font-size: 1.5rem; font-weight: 800; color: var(--affinia-violet);">
						<?php echo esc_html( $profile_completion ); ?>%
					</span>
				</div>
				<div class="progress-bar">
					<div class="progress-bar-fill" style="width: <?php echo esc_attr( $profile_completion ); ?>%"></div>
				</div>
			</div>

			<!-- Formulaire profil -->
			<form method="post" action="" enctype="multipart/form-data" class="profile-form">
				<?php wp_nonce_field( 'affinia_update_profile', 'affinia_profile_nonce' ); ?>

				<!-- Photo de profil -->
				<div class="settings-section">
					<h2 class="settings-section-title"><?php esc_html_e( 'Photo de profil', 'affinia' ); ?></h2>
					<div style="display: flex; align-items: center; gap: var(--space-lg);">
						<?php echo get_avatar( $user_id, 96, '', '', array( 'class' => 'avatar avatar-xl' ) ); ?>
						<div>
							<input type="file" name="profile_photo" accept="image/*" class="form-input">
							<p class="form-hint"><?php esc_html_e( 'JPG ou PNG. Max 5 Mo.', 'affinia' ); ?></p>
						</div>
					</div>
				</div>

				<!-- Informations personnelles -->
				<div class="settings-section">
					<h2 class="settings-section-title"><?php esc_html_e( 'Informations personnelles', 'affinia' ); ?></h2>

					<div class="form-group">
						<label class="form-label" for="display_name"><?php esc_html_e( 'Prénom', 'affinia' ); ?></label>
						<input type="text" id="display_name" name="display_name" class="form-input" value="<?php echo esc_attr( $current_user->display_name ); ?>">
					</div>

					<div class="form-group">
						<label class="form-label" for="affinia_age"><?php esc_html_e( 'Âge', 'affinia' ); ?></label>
						<input type="number" id="affinia_age" name="affinia_age" class="form-input" value="<?php echo esc_attr( $age ); ?>" min="18" max="99">
					</div>

					<div class="form-group">
						<label class="form-label" for="affinia_location"><?php esc_html_e( 'Ville / Région', 'affinia' ); ?></label>
						<input type="text" id="affinia_location" name="affinia_location" class="form-input" value="<?php echo esc_attr( $location ); ?>">
					</div>

					<div class="form-group">
						<label class="form-label" for="affinia_bio"><?php esc_html_e( 'Biographie', 'affinia' ); ?></label>
						<textarea id="affinia_bio" name="affinia_bio" class="form-textarea" rows="4" placeholder="<?php esc_attr_e( 'Décrivez-vous en quelques mots...', 'affinia' ); ?>"><?php echo esc_textarea( $bio ); ?></textarea>
						<p class="form-hint"><?php esc_html_e( 'Visible par les autres membres.', 'affinia' ); ?></p>
					</div>
				</div>

				<!-- Centres d'intérêt -->
				<div class="settings-section">
					<h2 class="settings-section-title"><?php esc_html_e( 'Centres d\'intérêt', 'affinia' ); ?></h2>
					<div class="interests-grid" id="interests-selector">
						<?php
						$available_interests = affinia_get_available_interests();
						foreach ( $available_interests as $interest ) :
							$is_selected = in_array( $interest, $interests );
						?>
							<label class="pill <?php echo $is_selected ? 'pill-violet' : ''; ?>" style="cursor: pointer;">
								<input type="checkbox" name="affinia_interests[]" value="<?php echo esc_attr( $interest ); ?>" <?php checked( $is_selected ); ?> hidden>
								<?php echo esc_html( $interest ); ?>
							</label>
						<?php endforeach; ?>
					</div>
				</div>

				<div style="display: flex; gap: var(--space-md); margin-top: var(--space-xl);">
					<button type="submit" class="btn btn-primary"><?php esc_html_e( 'Enregistrer', 'affinia' ); ?></button>
					<a href="<?php echo esc_url( home_url( '/decouverte/' ) ); ?>" class="btn btn-ghost"><?php esc_html_e( 'Annuler', 'affinia' ); ?></a>
				</div>
			</form>
		</div>
	</div>
</main>

<?php
get_footer();
