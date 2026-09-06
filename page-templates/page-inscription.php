<?php
/**
 * Template Name: Inscription
 * Description: Page d'inscription multi-étapes
 *
 * @package Affinia
 * @since 1.0.0
 */

if ( is_user_logged_in() ) {
	wp_redirect( home_url( '/decouverte/' ) );
	exit;
}

$step = isset( $_GET['step'] ) ? absint( $_GET['step'] ) : 1;

get_header();
?>

<main id="primary" class="site-main">
	<div class="auth-layout">
		<div class="auth-card">
			<div class="auth-header">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo">
					<span class="logo-icon">É</span>
				</a>
				<h1><?php esc_html_e( 'Créer votre compte', 'affinia' ); ?></h1>
				<p class="text-body"><?php esc_html_e( 'Rejoignez une communauté de rencontres premium.', 'affinia' ); ?></p>
			</div>

			<!-- Steps indicator -->
			<div class="auth-steps">
				<div class="auth-step <?php echo $step >= 1 ? 'is-active' : ''; ?> <?php echo $step > 1 ? 'is-complete' : ''; ?>">
					<span class="auth-step-number">1</span>
					<span class="auth-step-label"><?php esc_html_e( 'Identité', 'affinia' ); ?></span>
				</div>
				<div class="auth-step-line <?php echo $step > 1 ? 'is-active' : ''; ?>"></div>
				<div class="auth-step <?php echo $step >= 2 ? 'is-active' : ''; ?> <?php echo $step > 2 ? 'is-complete' : ''; ?>">
					<span class="auth-step-number">2</span>
					<span class="auth-step-label"><?php esc_html_e( 'Profil', 'affinia' ); ?></span>
				</div>
				<div class="auth-step-line <?php echo $step > 2 ? 'is-active' : ''; ?>"></div>
				<div class="auth-step <?php echo $step >= 3 ? 'is-active' : ''; ?>">
					<span class="auth-step-number">3</span>
					<span class="auth-step-label"><?php esc_html_e( 'Préférences', 'affinia' ); ?></span>
				</div>
			</div>

			<form method="post" action="" class="auth-form">
				<?php wp_nonce_field( 'affinia_register', 'affinia_register_nonce' ); ?>
				<input type="hidden" name="step" value="<?php echo esc_attr( $step ); ?>">

				<?php if ( $step === 1 ) : ?>
					<div class="form-group">
						<label class="form-label" for="reg_email"><?php esc_html_e( 'Adresse email', 'affinia' ); ?></label>
						<input type="email" id="reg_email" name="user_email" class="form-input" required placeholder="<?php esc_attr_e( 'vous@exemple.com', 'affinia' ); ?>">
					</div>
					<div class="form-group">
						<label class="form-label" for="reg_password"><?php esc_html_e( 'Mot de passe', 'affinia' ); ?></label>
						<input type="password" id="reg_password" name="user_pass" class="form-input" required minlength="8" placeholder="<?php esc_attr_e( 'Minimum 8 caractères', 'affinia' ); ?>">
					</div>
					<div class="form-group">
						<label class="form-label" for="reg_firstname"><?php esc_html_e( 'Prénom', 'affinia' ); ?></label>
						<input type="text" id="reg_firstname" name="first_name" class="form-input" required placeholder="<?php esc_attr_e( 'Votre prénom', 'affinia' ); ?>">
					</div>

				<?php elseif ( $step === 2 ) : ?>
					<div class="form-group">
						<label class="form-label" for="reg_age"><?php esc_html_e( 'Âge', 'affinia' ); ?></label>
						<input type="number" id="reg_age" name="affinia_age" class="form-input" required min="18" max="99">
					</div>
					<div class="form-group">
						<label class="form-label" for="reg_location"><?php esc_html_e( 'Ville / Région', 'affinia' ); ?></label>
						<input type="text" id="reg_location" name="affinia_location" class="form-input" required>
					</div>
					<div class="form-group">
						<label class="form-label" for="reg_bio"><?php esc_html_e( 'Quelques mots sur vous', 'affinia' ); ?></label>
						<textarea id="reg_bio" name="affinia_bio" class="form-textarea" rows="3"></textarea>
					</div>

				<?php elseif ( $step === 3 ) : ?>
					<div class="form-group">
						<label class="form-label"><?php esc_html_e( 'Centres d\'intérêt', 'affinia' ); ?></label>
						<div class="interests-grid">
							<?php foreach ( affinia_get_available_interests() as $interest ) : ?>
								<label class="pill" style="cursor: pointer;">
									<input type="checkbox" name="affinia_interests[]" value="<?php echo esc_attr( $interest ); ?>" hidden>
									<?php echo esc_html( $interest ); ?>
								</label>
							<?php endforeach; ?>
						</div>
					</div>

					<div class="form-group">
						<label style="display: flex; align-items: flex-start; gap: var(--space-sm); cursor: pointer;">
							<input type="checkbox" name="accept_terms" required>
							<span class="text-caption">
								<?php printf(
									esc_html__( 'J\'accepte les %1$sCGU%2$s et la %3$sPolitique de confidentialité%4$s.', 'affinia' ),
									'<a href="#">',
									'</a>',
									'<a href="' . esc_url( get_privacy_policy_url() ) . '">',
									'</a>'
								); ?>
							</span>
						</label>
					</div>
				<?php endif; ?>

				<div style="display: flex; gap: var(--space-md); margin-top: var(--space-lg);">
					<?php if ( $step > 1 ) : ?>
						<a href="?step=<?php echo esc_attr( $step - 1 ); ?>" class="btn btn-ghost">
							<?php esc_html_e( 'Retour', 'affinia' ); ?>
						</a>
					<?php endif; ?>
					<button type="submit" class="btn btn-primary" style="flex: 1;">
						<?php echo $step < 3 ? esc_html__( 'Continuer', 'affinia' ) : esc_html__( 'Créer mon compte', 'affinia' ); ?>
					</button>
				</div>
			</form>

			<p class="auth-footer">
				<?php printf(
					esc_html__( 'Déjà membre ? %1$sConnectez-vous%2$s', 'affinia' ),
					'<a href="' . esc_url( home_url( '/connexion/' ) ) . '">',
					'</a>'
				); ?>
			</p>
		</div>
	</div>
</main>

<?php
get_footer();
