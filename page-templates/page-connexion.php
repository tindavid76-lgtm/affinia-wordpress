<?php
/**
 * Template Name: Connexion
 * Description: Page de connexion
 *
 * @package Affinia
 * @since 1.0.0
 */

if ( is_user_logged_in() ) {
	wp_redirect( home_url( '/decouverte/' ) );
	exit;
}

$error = '';
if ( isset( $_GET['login'] ) && $_GET['login'] === 'failed' ) {
	$error = __( 'Identifiants incorrects. Veuillez réessayer.', 'affinia' );
}

get_header();
?>

<main id="primary" class="site-main">
	<div class="auth-layout">
		<div class="auth-card">
			<div class="auth-header">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo">
					<span class="logo-icon">É</span>
				</a>
				<h1><?php esc_html_e( 'Bon retour', 'affinia' ); ?></h1>
				<p class="text-body"><?php esc_html_e( 'Connectez-vous à votre espace membre.', 'affinia' ); ?></p>
			</div>

			<?php if ( $error ) : ?>
				<div class="card card-amber" style="margin-bottom: var(--space-lg); padding: var(--space-md);">
					<p style="font-size: 0.875rem;"><?php echo esc_html( $error ); ?></p>
				</div>
			<?php endif; ?>

			<form method="post" action="<?php echo esc_url( wp_login_url() ); ?>" class="auth-form">
				<input type="hidden" name="redirect_to" value="<?php echo esc_url( home_url( '/decouverte/' ) ); ?>">

				<div class="form-group">
					<label class="form-label" for="user_login"><?php esc_html_e( 'Email', 'affinia' ); ?></label>
					<input type="email" id="user_login" name="log" class="form-input" required autofocus placeholder="<?php esc_attr_e( 'vous@exemple.com', 'affinia' ); ?>">
				</div>

				<div class="form-group">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<label class="form-label" for="user_pass"><?php esc_html_e( 'Mot de passe', 'affinia' ); ?></label>
						<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>" class="text-caption" style="color: var(--affinia-violet);">
							<?php esc_html_e( 'Mot de passe oublié ?', 'affinia' ); ?>
						</a>
					</div>
					<input type="password" id="user_pass" name="pwd" class="form-input" required>
				</div>

				<div class="form-group" style="flex-direction: row; align-items: center;">
					<label style="display: flex; align-items: center; gap: var(--space-sm); cursor: pointer;">
						<input type="checkbox" name="rememberme" value="forever">
						<span class="text-caption"><?php esc_html_e( 'Se souvenir de moi', 'affinia' ); ?></span>
					</label>
				</div>

				<button type="submit" class="btn btn-primary" style="width: 100%;">
					<?php esc_html_e( 'Se connecter', 'affinia' ); ?>
				</button>
			</form>

			<p class="auth-footer">
				<?php printf(
					esc_html__( 'Pas encore membre ? %1$sCréer un compte%2$s', 'affinia' ),
					'<a href="' . esc_url( home_url( '/inscription/' ) ) . '">',
					'</a>'
				); ?>
			</p>
		</div>
	</div>
</main>

<?php
get_footer();
