<?php
function affinia_is_current_page( $slug ) { global $post; if ( ! $post ) return false; return $post->post_name === $slug; }

function affinia_member_fallback_menu() {
	$items = array( 'decouverte' => 'Découverte', 'favoris' => 'Favoris', 'messagerie' => 'Messagerie', 'notifications' => 'Notifications' );
	echo '<ul class="member-nav-list">';
	foreach ( $items as $slug => $label ) {
		$active = affinia_is_current_page( $slug ) ? ' class="current-menu-item"' : '';
		printf( '<li%s><a href="%s">%s</a></li>', $active, esc_url( home_url( '/' . $slug . '/' ) ), esc_html( $label ) );
	}
	echo '</ul>';
}

function affinia_get_notification_icon( $type ) {
	$icons = array( 'match' => '♥', 'message' => '✉', 'visit' => '○', 'system' => '⚙' );
	return isset( $icons[$type] ) ? $icons[$type] : '●';
}

function affinia_get_available_interests() {
	return array( 'Voyages', 'Cuisine', 'Musique', 'Cinéma', 'Sport', 'Lecture', 'Art', 'Nature', 'Technologie', 'Gastronomie', 'Photographie', 'Yoga', 'Animaux', 'Théâtre', 'Vin' );
}
