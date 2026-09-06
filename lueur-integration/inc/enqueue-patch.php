<?php
/**
 * Patch pour inc/enqueue.php de Lueur Rencontres.
 *
 * Ajoutez ces lignes DANS votre fonction d'enqueue existante,
 * après les wp_enqueue_style() déjà présents.
 *
 * NE PAS inclure ce fichier via require. Copiez-collez le contenu
 * dans votre inc/enqueue.php existant.
 *
 * @package Lueur_Rencontres
 */

// ---- DÉBUT DU PATCH à coller dans inc/enqueue.php ----

// CSS Espace membre (chargé uniquement pour les utilisateurs connectés)
if ( is_user_logged_in() ) {
	wp_enqueue_style(
		'lueur-affinia-member',
		LUEUR_URI . '/assets/css/affinia-member-space.css',
		array(),
		LUEUR_VERSION
	);
}

// CSS Auth (inscription / connexion / mot de passe oublié)
if ( is_page( array( 'inscription', 'connexion', 'mot-de-passe-oublie' ) ) ) {
	wp_enqueue_style(
		'lueur-affinia-auth',
		LUEUR_URI . '/assets/css/affinia-auth.css',
		array(),
		LUEUR_VERSION
	);
}

// ---- FIN DU PATCH ----
