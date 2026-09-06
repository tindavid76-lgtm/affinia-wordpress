<?php
/**
 * Affinia — Template tags & helper functions
 *
 * @package Affinia
 * @since 1.0.0
 */

/**
 * Check if current page matches a slug
 */
function affinia_is_current_page( $slug ) {
	global $post;
	if ( ! $post ) return false;
	return $post->post_name === $slug;
}

/**
 * Fallback member navigation
 */
function affinia_member_fallback_menu() {
	$items = array(
		'decouverte'    => __( 'Découverte', 'affinia' ),
		'favoris'       => __( 'Favoris', 'affinia' ),
		'messagerie'    => __( 'Messagerie', 'affinia' ),
		'notifications' => __( 'Notifications', 'affinia' ),
	);

	echo '<ul class="member-nav-list">';
	foreach ( $items as $slug => $label ) {
		$active = affinia_is_current_page( $slug ) ? ' class="current-menu-item"' : '';
		printf(
			'<li%s><a href="%s">%s</a></li>',
			$active,
			esc_url( home_url( '/' . $slug . '/' ) ),
			esc_html( $label )
		);
	}
	echo '</ul>';
}

/**
 * Get notification icon by type
 */
function affinia_get_notification_icon( $type ) {
	$icons = array(
		'match'   => '♥',
		'message' => '✉',
		'visit'   => '○',
		'system'  => '⚙',
	);
	return isset( $icons[ $type ] ) ? $icons[ $type ] : '●';
}

/**
 * Available interests for profile
 */
function affinia_get_available_interests() {
	return array(
		__( 'Voyages', 'affinia' ),
		__( 'Cuisine', 'affinia' ),
		__( 'Musique', 'affinia' ),
		__( 'Cinéma', 'affinia' ),
		__( 'Sport', 'affinia' ),
		__( 'Lecture', 'affinia' ),
		__( 'Art', 'affinia' ),
		__( 'Nature', 'affinia' ),
		__( 'Technologie', 'affinia' ),
		__( 'Gastronomie', 'affinia' ),
		__( 'Photographie', 'affinia' ),
		__( 'Yoga & Bien-être', 'affinia' ),
		__( 'Animaux', 'affinia' ),
		__( 'Théâtre', 'affinia' ),
		__( 'Vin & Dégustation', 'affinia' ),
	);
}
