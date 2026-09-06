<?php
/**
 * Assets.
 *
 * Fichier complet à placer dans inc/enqueue.php de Lueur Rencontres.
 * Inclut le chargement des CSS espace membre Affinia (maquettes Figma).
 *
 * @package Lueur_Rencontres
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function lueur_enqueue_assets() {
	/* ── CSS existants ── */
	wp_enqueue_style( 'lueur-style', get_stylesheet_uri(), array(), LUEUR_VERSION );
	wp_enqueue_style( 'lueur-components', LUEUR_URI . '/assets/css/components.css', array( 'lueur-style' ), LUEUR_VERSION );
	wp_enqueue_style( 'lueur-app', LUEUR_URI . '/assets/css/app.css', array( 'lueur-components' ), LUEUR_VERSION );
	wp_enqueue_style( 'lueur-figma-home', LUEUR_URI . '/assets/css/figma-home.css', array( 'lueur-app' ), LUEUR_VERSION );

	/* ── CSS Espace membre Affinia (maquettes Figma) ── */
	if ( is_user_logged_in() ) {
		wp_enqueue_style(
			'lueur-affinia-member',
			LUEUR_URI . '/assets/css/affinia-member-space.css',
			array( 'lueur-components' ),
			LUEUR_VERSION
		);
	}

	/* ── CSS Auth (inscription / connexion / mot de passe oublié) ── */
	if ( is_page( array( 'inscription', 'connexion', 'mot-de-passe-oublie' ) ) ) {
		wp_enqueue_style(
			'lueur-affinia-auth',
			LUEUR_URI . '/assets/css/affinia-auth.css',
			array( 'lueur-components' ),
			LUEUR_VERSION
		);
	}

	/* ── Scripts existants ── */
	wp_enqueue_script( 'lueur-navigation', LUEUR_URI . '/assets/js/navigation.js', array(), LUEUR_VERSION, true );
	wp_enqueue_script( 'lueur-interactions', LUEUR_URI . '/assets/js/interactions.js', array(), LUEUR_VERSION, true );
	wp_enqueue_script( 'lueur-consent', LUEUR_URI . '/assets/js/consent.js', array(), LUEUR_VERSION, true );
	wp_script_add_data( 'lueur-navigation', 'strategy', 'defer' );
	wp_script_add_data( 'lueur-interactions', 'strategy', 'defer' );
	wp_script_add_data( 'lueur-consent', 'strategy', 'defer' );
	wp_localize_script(
		'lueur-interactions',
		'lueurI18n',
		array(
			'showPassword' => __( 'Afficher le mot de passe', 'lueur-rencontres' ),
			'hidePassword' => __( 'Masquer le mot de passe', 'lueur-rencontres' ),
			'confirm'      => __( 'Confirmer cette action ?', 'lueur-rencontres' ),
		)
	);
}
add_action( 'wp_enqueue_scripts', 'lueur_enqueue_assets' );

function lueur_resource_hints( $urls, $relation_type ) {
	if ( 'preconnect' === $relation_type ) {
		$urls[] = array( 'href' => 'https://fonts.googleapis.com', 'crossorigin' => 'anonymous' );
		$urls[] = array( 'href' => 'https://fonts.gstatic.com', 'crossorigin' => 'anonymous' );
	}
	return $urls;
}
add_filter( 'wp_resource_hints', 'lueur_resource_hints', 10, 2 );
