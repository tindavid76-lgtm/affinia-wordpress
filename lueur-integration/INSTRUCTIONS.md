# Intégration Espace Membre — Lueur Rencontres + Affinia

Ce kit ajoute le design de l'espace membre (maquettes Figma) à votre thème Lueur Rencontres existant.

## Fichiers à copier

Depuis ce dossier `lueur-integration/`, copiez :

| Source | Destination dans `wp-content/themes/lueur-rencontres/` |
|--------|-------------------------------------------------------|
| `assets/css/affinia-member-space.css` | `assets/css/affinia-member-space.css` |
| `assets/css/affinia-auth.css` | `assets/css/affinia-auth.css` |

## Modification de inc/enqueue.php

Ajoutez ces lignes dans votre fonction d'enqueue (dans `inc/enqueue.php`), après les enqueues existants :

```php
// --- Espace membre Affinia (maquettes Figma) ---
if ( is_user_logged_in() ) {
    wp_enqueue_style(
        'lueur-affinia-member',
        LUEUR_URI . '/assets/css/affinia-member-space.css',
        array( 'lueur-components' ), // adapter le handle au vôtre
        LUEUR_VERSION
    );
}

// Pages auth (inscription / connexion)
$auth_slugs = array( 'inscription', 'connexion', 'mot-de-passe-oublie' );
if ( is_page( $auth_slugs ) ) {
    wp_enqueue_style(
        'lueur-affinia-auth',
        LUEUR_URI . '/assets/css/affinia-auth.css',
        array( 'lueur-components' ),
        LUEUR_VERSION
    );
}
```

## Pages WordPress à créer

Créez ces pages dans WordPress (Pages → Ajouter) avec les slugs et shortcodes indiqués :

| Page | Slug | Shortcode Affinia |
|------|------|-------------------|
| Découverte | `decouverte` | `[affinia_members]` |
| Inscription | `inscription` | `[affinia_register]` |
| Connexion | `connexion` | `[affinia_login]` |
| Profil | `profil` | `[affinia_account]` |
| Favoris | `favoris` | `[affinia_members type="favorites"]` |
| Messagerie | `messagerie` | `[affinia_chat]` |
| Notifications | `notifications` | `[affinia_notifications]` |
| Paramètres | `parametres` | `[affinia_account tab="settings"]` |
| Recherche | `recherche-membres` | `[affinia_advanced_search]` |
| Suggestions | `suggestions` | `[affinia_members type="suggestions"]` |
| Abonnement | `abonnement` | `[affinia_plans]` |

## Correspondance couleurs Figma → Lueur

Le CSS utilise les custom properties de votre `theme.json` :

| Figma (Affinia) | Lueur Rencontres |
|-----------------|------------------|
| Aubergine `#21182C` | `--wp--preset--color--navy-deep` `#0B1D30` |
| Violet `#6D3BD1` | `--wp--preset--color--violet` `#7559C7` |
| Lime `#AFDC5B` | `--wp--preset--color--gold` `#C8A55A` (accent) |
| Cream `#F6F3ED` | `--wp--preset--color--ivory` `#FBF9F5` |
| Rose `#EC6D91` | `--wp--preset--color--coral` `#E66F68` |
| Text primary | `--wp--preset--color--ink` `#26313C` |
| Text on dark | `--wp--preset--color--white` `#FFFFFF` |

## Vérification

1. Activez le thème Lueur Rencontres (s'il ne l'est pas déjà)
2. Vérifiez que le plugin Affinia 0.13.x est actif
3. Créez les pages ci-dessus
4. Testez chaque page connecté et déconnecté
5. Vérifiez le responsive (mobile 430px, tablette 768px, desktop)
