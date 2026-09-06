<?php
/**
 * The header template
 *
 * @package Affinia
 * @since 1.0.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
	<header id="masthead" class="site-header">
		<div class="header-inner">
			<!-- Logo -->
			<div class="site-branding">
				<?php if ( has_custom_logo() ) : ?>
					<?php the_custom_logo(); ?>
				<?php else : ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo">
						<span class="logo-icon">É</span>
						<span class="logo-text">Élégance Rencontre</span>
					</a>
				<?php endif; ?>
			</div>

			<?php if ( is_user_logged_in() ) : ?>
				<!-- Navigation membre desktop -->
				<nav id="site-navigation" class="member-navigation">
					<?php
					wp_nav_menu( array(
						'theme_location' => 'member',
						'menu_class'     => 'member-nav-list',
						'container'      => false,
						'fallback_cb'    => 'affinia_member_fallback_menu',
					) );
					?>
				</nav>

				<!-- Profil utilisateur -->
				<div class="header-user">
					<?php echo get_avatar( get_current_user_id(), 32 ); ?>
					<span class="header-user-name"><?php echo esc_html( wp_get_current_user()->display_name ); ?></span>
				</div>
			<?php else : ?>
				<!-- Navigation publique -->
				<nav id="site-navigation" class="main-navigation">
					<?php
					wp_nav_menu( array(
						'theme_location' => 'primary',
						'menu_class'     => 'primary-nav-list',
						'container'      => false,
					) );
					?>
				</nav>

				<div class="header-actions">
					<a href="<?php echo esc_url( wp_login_url() ); ?>" class="btn btn-ghost">
						<?php esc_html_e( 'Connexion', 'affinia' ); ?>
					</a>
					<a href="<?php echo esc_url( wp_registration_url() ); ?>" class="btn btn-primary">
						<?php esc_html_e( 'S\'inscrire', 'affinia' ); ?>
					</a>
				</div>
			<?php endif; ?>
		</div>
	</header>
