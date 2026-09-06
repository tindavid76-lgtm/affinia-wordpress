<?php
/**
 * Template Name: Profil Membre
 */
if(!is_user_logged_in()){wp_redirect(wp_login_url(get_permalink()));exit;}
$u=wp_get_current_user();$uid=$u->ID;$pc=affinia_get_profile_completion($uid);
$bio=get_user_meta($uid,'affinia_bio',true);$age=get_user_meta($uid,'affinia_age',true);$loc=get_user_meta($uid,'affinia_location',true);$interests=get_user_meta($uid,'affinia_interests',true)?:array();
get_header();
?>
<main id="primary" class="site-main"><div class="member-layout"><?php get_sidebar(); ?><div class="member-content">
<div class="page-header"><span class="text-eyebrow">Mon espace</span><h1>Profil & Préférences</h1></div>
<div class="card" style="margin-bottom:var(--space-xl)"><div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:var(--space-md)"><h3>Complétion du profil</h3><span style="font-size:1.5rem;font-weight:800;color:var(--affinia-violet)"><?php echo esc_html($pc); ?>%</span></div><div class="progress-bar"><div class="progress-bar-fill" style="width:<?php echo esc_attr($pc); ?>%"></div></div></div>
<form method="post" enctype="multipart/form-data"><?php wp_nonce_field('affinia_update_profile','affinia_profile_nonce'); ?>
<div class="settings-section"><h2 class="settings-section-title">Informations personnelles</h2>
<div class="form-group"><label class="form-label" for="display_name">Prénom</label><input type="text" id="display_name" name="display_name" class="form-input" value="<?php echo esc_attr($u->display_name); ?>"></div>
<div class="form-group"><label class="form-label" for="affinia_age">Âge</label><input type="number" id="affinia_age" name="affinia_age" class="form-input" value="<?php echo esc_attr($age); ?>" min="18" max="99"></div>
<div class="form-group"><label class="form-label" for="affinia_location">Ville / Région</label><input type="text" id="affinia_location" name="affinia_location" class="form-input" value="<?php echo esc_attr($loc); ?>"></div>
<div class="form-group"><label class="form-label" for="affinia_bio">Biographie</label><textarea id="affinia_bio" name="affinia_bio" class="form-textarea" rows="4"><?php echo esc_textarea($bio); ?></textarea></div>
</div>
<div class="settings-section"><h2 class="settings-section-title">Centres d'intérêt</h2><div class="interests-grid"><?php foreach(affinia_get_available_interests() as $i): $sel=in_array($i,$interests); ?><label class="pill <?php echo $sel?'pill-violet':''; ?>" style="cursor:pointer"><input type="checkbox" name="affinia_interests[]" value="<?php echo esc_attr($i); ?>" <?php checked($sel); ?> hidden><?php echo esc_html($i); ?></label><?php endforeach; ?></div></div>
<div style="display:flex;gap:var(--space-md);margin-top:var(--space-xl)"><button type="submit" class="btn btn-primary">Enregistrer</button><a href="<?php echo esc_url(home_url('/decouverte/')); ?>" class="btn btn-ghost">Annuler</a></div>
</form></div></div></main>
<?php get_footer(); ?>
