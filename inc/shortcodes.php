<?php
/**
 * Affinia — Shortcodes
 *
 * @package Affinia
 * @since 1.0.0
 */

/**
 * [affinia_profile_completion] - Displays profile completion percentage
 */
function affinia_shortcode_profile_completion( $atts ) {
	if ( ! is_user_logged_in() ) return '';

	$atts = shortcode_atts( array(
		'show_bar' => 'true',
	), $atts );

	$completion = affinia_get_profile_completion( get_current_user_id() );

	$output = '<div class="profile-completion-widget">';
	$output .= '<span class="profile-completion-value">' . esc_html( $completion ) . '% complété</span>';

	if ( $atts['show_bar'] === 'true' ) {
		$output .= '<div class="progress-bar"><div class="progress-bar-fill" style="width: ' . esc_attr( $completion ) . '%"></div></div>';
	}

	$output .= '</div>';
	return $output;
}
add_shortcode( 'affinia_profile_completion', 'affinia_shortcode_profile_completion' );

/**
 * [affinia_favorites_count] - Shows the number of favorites
 */
function affinia_shortcode_favorites_count() {
	if ( ! is_user_logged_in() ) return '0';
	$favorites = affinia_get_user_favorites( get_current_user_id() );
	return count( $favorites );
}
add_shortcode( 'affinia_favorites_count', 'affinia_shortcode_favorites_count' );

/**
 * [affinia_unread_messages] - Shows unread message count
 */
function affinia_shortcode_unread_messages() {
	if ( ! is_user_logged_in() ) return '0';
	return affinia_get_unread_count( get_current_user_id() );
}
add_shortcode( 'affinia_unread_messages', 'affinia_shortcode_unread_messages' );

/**
 * [affinia_member_greeting] - Personalized greeting
 */
function affinia_shortcode_member_greeting() {
	if ( ! is_user_logged_in() ) return '';
	$user = wp_get_current_user();
	return sprintf( esc_html__( 'Bonjour %s', 'affinia' ), esc_html( $user->display_name ) );
}
add_shortcode( 'affinia_member_greeting', 'affinia_shortcode_member_greeting' );

/**
 * [affinia_security_card] - Security/privacy info card
 */
function affinia_shortcode_security_card() {
	$output = '<div class="card card-green">';
	$output .= '<h3>' . esc_html__( 'Vous gardez la main.', 'affinia' ) . '</h3>';
	$output .= '<ul class="check-list">';
	$output .= '<li>' . esc_html__( 'Localisation approximative', 'affinia' ) . '</li>';
	$output .= '<li>' . esc_html__( 'Visibilité maîtrisée', 'affinia' ) . '</li>';
	$output .= '<li>' . esc_html__( 'Blocage et signalement visibles', 'affinia' ) . '</li>';
	$output .= '<li>' . esc_html__( 'Suppression accessible', 'affinia' ) . '</li>';
	$output .= '</ul></div>';
	return $output;
}
add_shortcode( 'affinia_security_card', 'affinia_shortcode_security_card' );
