<?php
/**
 * Template Name: Paramètres
 */
if(!is_user_logged_in()){wp_redirect(wp_login_url(get_permalink()));exit;}
$uid=get_current_user_id();
$en=get_user_meta($uid,'affinia_email_notifs',true)!=='off';$pn=get_user_meta($uid,'affinia_push_notifs',true)!=='off';
$vis=get_user_meta($uid,'affinia_visibility',true)?:'visible';$loc=get_user_meta($uid,'affinia_location_precision',true)?:'approximate';
get_header();
?>
<main id="primary" class="site-main"><div class="member-layout"><?php get_sidebar(); ?><div class="member-content">
<div class="page-header"><span class="text-eyebrow">Compte</span><h1>Paramètres & Confidentialité</h1></div>
<form method="post"><?php wp_nonce_field('affinia_update_settings','affinia_settings_nonce'); ?>
<div class="settings-section"><h2 class="settings-section-title">Notifications</h2>
<div class="settings-row"><div><span class="settings-label">Notifications par email</span><p class="settings-description">Recevez les alertes de matchs et messages.</p></div><label class="toggle <?php echo $en?'is-active':''; ?>"><input type="checkbox" name="affinia_email_notifs" value="on" <?php checked($en); ?> hidden></label></div>
<div class="settings-row"><div><span class="settings-label">Notifications push</span><p class="settings-description">Alertes en temps réel.</p></div><label class="toggle <?php echo $pn?'is-active':''; ?>"><input type="checkbox" name="affinia_push_notifs" value="on" <?php checked($pn); ?> hidden></label></div>
</div>
<div class="settings-section"><h2 class="settings-section-title">Confidentialité</h2>
<div class="settings-row"><div><span class="settings-label">Visibilité du profil</span></div><select name="affinia_visibility" class="form-select" style="width:auto"><option value="visible" <?php selected($vis,'visible'); ?>>Visible</option><option value="limited" <?php selected($vis,'limited'); ?>>Limité</option><option value="hidden" <?php selected($vis,'hidden'); ?>>Masqué</option></select></div>
<div class="settings-row"><div><span class="settings-label">Précision localisation</span></div><select name="affinia_location_precision" class="form-select" style="width:auto"><option value="approximate" <?php selected($loc,'approximate'); ?>>Approximative</option><option value="city" <?php selected($loc,'city'); ?>>Ville</option><option value="region" <?php selected($loc,'region'); ?>>Région</option></select></div>
</div>
<div class="settings-section"><h2 class="settings-section-title">Compte</h2>
<div class="settings-row"><span class="settings-label">Changer le mot de passe</span><a href="<?php echo esc_url(admin_url('profile.php')); ?>" class="btn btn-ghost btn-sm">Modifier</a></div>
<div class="settings-row"><span class="settings-label" style="color:var(--affinia-error)">Supprimer le compte</span><button type="button" class="btn btn-ghost btn-sm" style="color:var(--affinia-error);border-color:var(--affinia-error)">Supprimer</button></div>
</div>
<button type="submit" class="btn btn-primary" style="margin-top:var(--space-xl)">Enregistrer les paramètres</button>
</form></div></div></main>
<?php get_footer(); ?>
