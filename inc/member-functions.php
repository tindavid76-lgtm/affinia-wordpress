<?php
/**
 * Affinia — Member functions (stubs for data layer)
 *
 * These functions serve as the data interface between templates and
 * the backend (BuddyPress, ACF, or custom tables). Replace the stub
 * implementations with your actual data queries.
 *
 * @package Affinia
 * @since 1.0.0
 */

/**
 * Get profile completion percentage
 *
 * @param int $user_id
 * @return int 0-100
 */
function affinia_get_profile_completion( $user_id ) {
	$fields = array(
		'display_name'    => get_userdata( $user_id )->display_name,
		'affinia_bio'     => get_user_meta( $user_id, 'affinia_bio', true ),
		'affinia_age'     => get_user_meta( $user_id, 'affinia_age', true ),
		'affinia_location'=> get_user_meta( $user_id, 'affinia_location', true ),
		'avatar'          => get_user_meta( $user_id, 'affinia_avatar', true ),
		'interests'       => get_user_meta( $user_id, 'affinia_interests', true ),
	);

	$filled = 0;
	foreach ( $fields as $value ) {
		if ( ! empty( $value ) ) $filled++;
	}

	return round( ( $filled / count( $fields ) ) * 100 );
}

/**
 * Get profile suggestions for a user
 *
 * @param int $user_id
 * @return array Array of profile data arrays
 */
function affinia_get_suggestions( $user_id ) {
	// STUB: Replace with actual matching algorithm
	// Query users by region, interests, and compatibility score
	return array();
}

/**
 * Get user's favorites
 *
 * @param int $user_id
 * @return array
 */
function affinia_get_user_favorites( $user_id ) {
	$favorite_ids = get_user_meta( $user_id, 'affinia_favorites', true );
	if ( ! is_array( $favorite_ids ) || empty( $favorite_ids ) ) {
		return array();
	}

	$favorites = array();
	foreach ( $favorite_ids as $fav_id ) {
		$user = get_userdata( $fav_id );
		if ( $user ) {
			$favorites[] = array(
				'id'       => $fav_id,
				'name'     => $user->display_name,
				'age'      => get_user_meta( $fav_id, 'affinia_age', true ),
				'location' => get_user_meta( $fav_id, 'affinia_location', true ),
				'photo'    => get_user_meta( $fav_id, 'affinia_avatar', true ),
			);
		}
	}

	return $favorites;
}

/**
 * Get mutual favorites
 *
 * @param int $user_id
 * @return array
 */
function affinia_get_mutual_favorites( $user_id ) {
	$my_favorites = get_user_meta( $user_id, 'affinia_favorites', true );
	if ( ! is_array( $my_favorites ) ) return array();

	$mutual = array();
	foreach ( $my_favorites as $fav_id ) {
		$their_favorites = get_user_meta( $fav_id, 'affinia_favorites', true );
		if ( is_array( $their_favorites ) && in_array( $user_id, $their_favorites ) ) {
			$user = get_userdata( $fav_id );
			if ( $user ) {
				$mutual[] = array(
					'id'   => $fav_id,
					'name' => $user->display_name,
				);
			}
		}
	}

	return $mutual;
}

/**
 * Get unread message count
 *
 * @param int $user_id
 * @return int
 */
function affinia_get_unread_count( $user_id ) {
	// STUB: Replace with actual message count query
	return 0;
}

/**
 * Get conversations for a user
 *
 * @param int $user_id
 * @return array
 */
function affinia_get_conversations( $user_id ) {
	// STUB: Replace with actual conversation query
	// Should return array of arrays with: id, user_id, name, last_message, time, unread
	return array();
}

/**
 * Get messages for a conversation
 *
 * @param int $conversation_id
 * @return array
 */
function affinia_get_messages( $conversation_id ) {
	// STUB: Replace with actual message query
	// Should return array of arrays with: sender, content, time
	return array();
}

/**
 * Get conversation partner info
 *
 * @param int $conversation_id
 * @param int $current_user_id
 * @return array
 */
function affinia_get_conversation_partner( $conversation_id, $current_user_id ) {
	// STUB: Replace with actual query
	return array(
		'id'     => 0,
		'name'   => '',
		'status' => __( 'Hors ligne', 'affinia' ),
	);
}

/**
 * Get notifications for a user
 *
 * @param int $user_id
 * @return array
 */
function affinia_get_notifications( $user_id ) {
	// STUB: Replace with actual notification query
	// Should return array of arrays with: type, message, time, read
	return array();
}

/**
 * Count unread notifications
 *
 * @param int $user_id
 * @return int
 */
function affinia_count_unread_notifications( $user_id ) {
	// STUB: Replace with actual count
	return 0;
}

/**
 * Handle favorite toggle via AJAX
 */
function affinia_toggle_favorite() {
	check_ajax_referer( 'affinia_nonce', 'nonce' );

	$user_id = get_current_user_id();
	$target_id = absint( $_POST['target_id'] );

	if ( ! $user_id || ! $target_id ) {
		wp_send_json_error();
	}

	$favorites = get_user_meta( $user_id, 'affinia_favorites', true );
	if ( ! is_array( $favorites ) ) $favorites = array();

	if ( in_array( $target_id, $favorites ) ) {
		$favorites = array_diff( $favorites, array( $target_id ) );
		$action = 'removed';
	} else {
		$favorites[] = $target_id;
		$action = 'added';
	}

	update_user_meta( $user_id, 'affinia_favorites', array_values( $favorites ) );

	wp_send_json_success( array( 'action' => $action ) );
}
add_action( 'wp_ajax_affinia_toggle_favorite', 'affinia_toggle_favorite' );

/**
 * Handle message sending via AJAX
 */
function affinia_send_message() {
	check_ajax_referer( 'affinia_nonce', 'nonce' );

	$user_id = get_current_user_id();
	$message = sanitize_textarea_field( $_POST['message'] );

	if ( ! $user_id || empty( $message ) ) {
		wp_send_json_error();
	}

	// STUB: Save message to database
	// Insert into custom messages table or BuddyPress messages

	wp_send_json_success( array(
		'message' => $message,
		'time'    => current_time( 'H:i' ),
	) );
}
add_action( 'wp_ajax_affinia_send_message', 'affinia_send_message' );

/**
 * Handle profile update
 */
function affinia_handle_profile_update() {
	if ( ! isset( $_POST['affinia_profile_nonce'] ) ) return;
	if ( ! wp_verify_nonce( $_POST['affinia_profile_nonce'], 'affinia_update_profile' ) ) return;

	$user_id = get_current_user_id();
	if ( ! $user_id ) return;

	// Update display name
	if ( isset( $_POST['display_name'] ) ) {
		wp_update_user( array(
			'ID'           => $user_id,
			'display_name' => sanitize_text_field( $_POST['display_name'] ),
		) );
	}

	// Update meta fields
	$meta_fields = array( 'affinia_age', 'affinia_location', 'affinia_bio' );
	foreach ( $meta_fields as $field ) {
		if ( isset( $_POST[ $field ] ) ) {
			update_user_meta( $user_id, $field, sanitize_text_field( $_POST[ $field ] ) );
		}
	}

	// Update interests
	if ( isset( $_POST['affinia_interests'] ) ) {
		update_user_meta( $user_id, 'affinia_interests', array_map( 'sanitize_text_field', $_POST['affinia_interests'] ) );
	}

	// Handle photo upload
	if ( ! empty( $_FILES['profile_photo']['name'] ) ) {
		require_once ABSPATH . 'wp-admin/includes/image.php';
		require_once ABSPATH . 'wp-admin/includes/file.php';
		require_once ABSPATH . 'wp-admin/includes/media.php';

		$attachment_id = media_handle_upload( 'profile_photo', 0 );
		if ( ! is_wp_error( $attachment_id ) ) {
			update_user_meta( $user_id, 'affinia_avatar', wp_get_attachment_url( $attachment_id ) );
		}
	}

	wp_redirect( add_query_arg( 'updated', '1', wp_get_referer() ) );
	exit;
}
add_action( 'init', 'affinia_handle_profile_update' );

/**
 * Handle settings update
 */
function affinia_handle_settings_update() {
	if ( ! isset( $_POST['affinia_settings_nonce'] ) ) return;
	if ( ! wp_verify_nonce( $_POST['affinia_settings_nonce'], 'affinia_update_settings' ) ) return;

	$user_id = get_current_user_id();
	if ( ! $user_id ) return;

	update_user_meta( $user_id, 'affinia_email_notifs', isset( $_POST['affinia_email_notifs'] ) ? 'on' : 'off' );
	update_user_meta( $user_id, 'affinia_push_notifs', isset( $_POST['affinia_push_notifs'] ) ? 'on' : 'off' );
	update_user_meta( $user_id, 'affinia_visibility', sanitize_text_field( $_POST['affinia_visibility'] ?? 'visible' ) );
	update_user_meta( $user_id, 'affinia_location_precision', sanitize_text_field( $_POST['affinia_location_precision'] ?? 'approximate' ) );

	wp_redirect( add_query_arg( 'updated', '1', wp_get_referer() ) );
	exit;
}
add_action( 'init', 'affinia_handle_settings_update' );
