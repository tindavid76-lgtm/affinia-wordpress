<?php
/**
 * Welcome section for the member dashboard
 *
 * @package Affinia
 * @since 1.0.0
 */

$current_user = wp_get_current_user();
?>

<section class="welcome-section">
	<span class="welcome-greeting">
		<?php printf( esc_html__( 'Bonjour %s', 'affinia' ), esc_html( $current_user->display_name ) ); ?>
	</span>
	<h1 class="welcome-title"><?php esc_html_e( 'Votre espace de rencontre', 'affinia' ); ?></h1>
	<p class="welcome-subtitle">
		<?php esc_html_e( 'Des suggestions disponibles selon votre région et vos préférences.', 'affinia' ); ?>
	</p>
</section>
