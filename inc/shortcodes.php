<?php
function affinia_shortcode_profile_completion( $atts ) {
	if ( ! is_user_logged_in() ) return '';
	$completion = affinia_get_profile_completion( get_current_user_id() );
	return '<div class="profile-completion-widget"><span class="profile-completion-value">' . esc_html( $completion ) . '% complété</span><div class="progress-bar"><div class="progress-bar-fill" style="width:' . esc_attr( $completion ) . '%"></div></div></div>';
}
add_shortcode( 'affinia_profile_completion', 'affinia_shortcode_profile_completion' );

function affinia_shortcode_unread_messages() {
	if ( ! is_user_logged_in() ) return '0';
	return affinia_get_unread_count( get_current_user_id() );
}
add_shortcode( 'affinia_unread_messages', 'affinia_shortcode_unread_messages' );

function affinia_shortcode_member_greeting() {
	if ( ! is_user_logged_in() ) return '';
	return sprintf( 'Bonjour %s', esc_html( wp_get_current_user()->display_name ) );
}
add_shortcode( 'affinia_member_greeting', 'affinia_shortcode_member_greeting' );

function affinia_shortcode_security_card() {
	return '<div class="card card-green"><h3>Vous gardez la main.</h3><ul class="check-list"><li>Localisation approximative</li><li>Visibilité maîtrisée</li><li>Blocage et signalement visibles</li><li>Suppression accessible</li></ul></div>';
}
add_shortcode( 'affinia_security_card', 'affinia_shortcode_security_card' );
