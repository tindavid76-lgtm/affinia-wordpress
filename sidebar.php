<?php
/**
 * The sidebar template — Member space
 *
 * @package Affinia
 * @since 1.0.0
 */

if ( ! is_user_logged_in() ) {
	return;
}

$current_user = wp_get_current_user();
$profile_completion = affinia_get_profile_completion( $current_user->ID );
?>

<aside id="secondary" class="member-sidebar">
	<!-- Profil résumé -->
	<div class="sidebar-profile-card">
		<span class="text-eyebrow"><?php esc_html_e( 'Votre profil', 'affinia' ); ?></span>
		<div class="profile-completion">
			<span class="profile-completion-value"><?php echo esc_html( $profile_completion ); ?> % complété</span>
			<div class="progress-bar">
				<div class="progress-bar-fill" style="width: <?php echo esc_attr( $profile_completion ); ?>%"></div>
			</div>
		</div>
		<p class="text-caption"><?php esc_html_e( 'Ajoutez vos préférences pour recevoir des suggestions plus justes.', 'affinia' ); ?></p>
	</div>

	<!-- Navigation raccourcis -->
	<nav class="sidebar-nav">
		<h3 class="sidebar-nav-title"><?php esc_html_e( 'Raccourcis', 'affinia' ); ?></h3>
		<ul class="sidebar-nav-list">
			<li><a href="<?php echo esc_url( home_url( '/decouverte/' ) ); ?>" class="sidebar-nav-link <?php echo affinia_is_current_page( 'decouverte' ) ? 'is-active' : ''; ?>">
				<span class="nav-icon">◆</span> <?php esc_html_e( 'Découverte', 'affinia' ); ?>
			</a></li>
			<li><a href="<?php echo esc_url( home_url( '/favoris/' ) ); ?>" class="sidebar-nav-link <?php echo affinia_is_current_page( 'favoris' ) ? 'is-active' : ''; ?>">
				<span class="nav-icon">♥</span> <?php esc_html_e( 'Favoris', 'affinia' ); ?>
			</a></li>
			<li><a href="<?php echo esc_url( home_url( '/messagerie/' ) ); ?>" class="sidebar-nav-link <?php echo affinia_is_current_page( 'messagerie' ) ? 'is-active' : ''; ?>">
				<span class="nav-icon">✉</span> <?php esc_html_e( 'Messagerie', 'affinia' ); ?>
			</a></li>
			<li><a href="<?php echo esc_url( home_url( '/notifications/' ) ); ?>" class="sidebar-nav-link <?php echo affinia_is_current_page( 'notifications' ) ? 'is-active' : ''; ?>">
				<span class="nav-icon">●</span> <?php esc_html_e( 'Notifications', 'affinia' ); ?>
			</a></li>
			<li><a href="<?php echo esc_url( home_url( '/profil/' ) ); ?>" class="sidebar-nav-link <?php echo affinia_is_current_page( 'profil' ) ? 'is-active' : ''; ?>">
				<span class="nav-icon">○</span> <?php esc_html_e( 'Profil et préférences', 'affinia' ); ?>
			</a></li>
			<li><a href="<?php echo esc_url( home_url( '/parametres/' ) ); ?>" class="sidebar-nav-link <?php echo affinia_is_current_page( 'parametres' ) ? 'is-active' : ''; ?>">
				<span class="nav-icon">⚙</span> <?php esc_html_e( 'Paramètres', 'affinia' ); ?>
			</a></li>
		</ul>
	</nav>

	<!-- Sécurité -->
	<div class="sidebar-security-card">
		<h4><?php esc_html_e( 'Sécurité accessible', 'affinia' ); ?></h4>
		<p class="text-caption"><?php esc_html_e( 'Bloquez, signalez ou masquez. Restez visibles à tout moment.', 'affinia' ); ?></p>
	</div>

	<?php dynamic_sidebar( 'sidebar-member' ); ?>
</aside>
