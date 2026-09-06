<?php
/**
 * Template Name: Paramètres
 * Description: Paramètres et confidentialité du compte
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

// Settings values
$email_notifications = get_user_meta( $user_id, 'affinia_email_notifs', true ) !== 'off';
$push_notifications = get_user_meta( $user_id, 'affinia_push_notifs', true ) !== 'off';
$profile_visibility = get_user_meta( $user_id, 'affinia_visibility', true ) ?: 'visible';
$location_precision = get_user_meta( $user_id, 'affinia_location_precision', true ) ?: 'approximate';

get_header();
?>

<main id="primary" class="site-main">
	<div class="member-layout">
		<?php get_sidebar(); ?>

		<div class="member-content">
			<div class="page-header">
				<span class="text-eyebrow"><?php esc_html_e( 'Compte', 'affinia' ); ?></span>
				<h1><?php esc_html_e( 'Paramètres & Confidentialité', 'affinia' ); ?></h1>
			</div>

			<form method="post" action="">
				<?php wp_nonce_field( 'affinia_update_settings', 'affinia_settings_nonce' ); ?>

				<!-- Notifications -->
				<div class="settings-section">
					<h2 class="settings-section-title"><?php esc_html_e( 'Notifications', 'affinia' ); ?></h2>

					<div class="settings-row">
						<div>
							<span class="settings-label"><?php esc_html_e( 'Notifications par email', 'affinia' ); ?></span>
							<p class="settings-description"><?php esc_html_e( 'Recevez les alertes de matchs et messages par email.', 'affinia' ); ?></p>
						</div>
						<label class="toggle <?php echo $email_notifications ? 'is-active' : ''; ?>">
							<input type="checkbox" name="affinia_email_notifs" value="on" <?php checked( $email_notifications ); ?> hidden>
						</label>
					</div>

					<div class="settings-row">
						<div>
							<span class="settings-label"><?php esc_html_e( 'Notifications push', 'affinia' ); ?></span>
							<p class="settings-description"><?php esc_html_e( 'Alertes en temps réel dans votre navigateur.', 'affinia' ); ?></p>
						</div>
						<label class="toggle <?php echo $push_notifications ? 'is-active' : ''; ?>">
							<input type="checkbox" name="affinia_push_notifs" value="on" <?php checked( $push_notifications ); ?> hidden>
						</label>
					</div>
				</div>

				<!-- Confidentialité -->
				<div class="settings-section">
					<h2 class="settings-section-title"><?php esc_html_e( 'Confidentialité', 'affinia' ); ?></h2>

					<div class="settings-row">
						<div>
							<span class="settings-label"><?php esc_html_e( 'Visibilité du profil', 'affinia' ); ?></span>
							<p class="settings-description"><?php esc_html_e( 'Contrôlez qui peut voir votre profil.', 'affinia' ); ?></p>
						</div>
						<select name="affinia_visibility" class="form-select" style="width: auto;">
							<option value="visible" <?php selected( $profile_visibility, 'visible' ); ?>><?php esc_html_e( 'Visible', 'affinia' ); ?></option>
							<option value="limited" <?php selected( $profile_visibility, 'limited' ); ?>><?php esc_html_e( 'Limité', 'affinia' ); ?></option>
							<option value="hidden" <?php selected( $profile_visibility, 'hidden' ); ?>><?php esc_html_e( 'Masqué', 'affinia' ); ?></option>
						</select>
					</div>

					<div class="settings-row">
						<div>
							<span class="settings-label"><?php esc_html_e( 'Précision de la localisation', 'affinia' ); ?></span>
							<p class="settings-description"><?php esc_html_e( 'Votre adresse exacte n\'est jamais partagée.', 'affinia' ); ?></p>
						</div>
						<select name="affinia_location_precision" class="form-select" style="width: auto;">
							<option value="approximate" <?php selected( $location_precision, 'approximate' ); ?>><?php esc_html_e( 'Approximative', 'affinia' ); ?></option>
							<option value="city" <?php selected( $location_precision, 'city' ); ?>><?php esc_html_e( 'Ville uniquement', 'affinia' ); ?></option>
							<option value="region" <?php selected( $location_precision, 'region' ); ?>><?php esc_html_e( 'Région uniquement', 'affinia' ); ?></option>
						</select>
					</div>
				</div>

				<!-- Compte -->
				<div class="settings-section">
					<h2 class="settings-section-title"><?php esc_html_e( 'Compte', 'affinia' ); ?></h2>

					<div class="settings-row">
						<div>
							<span class="settings-label"><?php esc_html_e( 'Changer le mot de passe', 'affinia' ); ?></span>
						</div>
						<a href="<?php echo esc_url( admin_url( 'profile.php' ) ); ?>" class="btn btn-ghost btn-sm">
							<?php esc_html_e( 'Modifier', 'affinia' ); ?>
						</a>
					</div>

					<div class="settings-row">
						<div>
							<span class="settings-label" style="color: var(--affinia-error);"><?php esc_html_e( 'Supprimer le compte', 'affinia' ); ?></span>
							<p class="settings-description"><?php esc_html_e( 'Cette action est irréversible. Toutes vos données seront supprimées.', 'affinia' ); ?></p>
						</div>
						<button type="button" class="btn btn-ghost btn-sm" style="color: var(--affinia-error); border-color: var(--affinia-error);" onclick="if(confirm('<?php esc_attr_e( 'Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible.', 'affinia' ); ?>')) { document.getElementById('delete-account-form').submit(); }">
							<?php esc_html_e( 'Supprimer', 'affinia' ); ?>
						</button>
					</div>
				</div>

				<button type="submit" class="btn btn-primary" style="margin-top: var(--space-xl);">
					<?php esc_html_e( 'Enregistrer les paramètres', 'affinia' ); ?>
				</button>
			</form>

			<form id="delete-account-form" method="post" action="" style="display: none;">
				<?php wp_nonce_field( 'affinia_delete_account', 'affinia_delete_nonce' ); ?>
				<input type="hidden" name="affinia_delete_account" value="1">
			</form>
		</div>
	</div>
</main>

<?php
get_footer();
