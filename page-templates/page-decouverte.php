<?php
/**
 * Template Name: Découverte
 */
if(!is_user_logged_in()){wp_redirect(wp_login_url(get_permalink()));exit;}
$u=wp_get_current_user();$pc=affinia_get_profile_completion($u->ID);$region=get_user_meta($u->ID,'affinia_region',true)?:'Votre région';
get_header();
?>
<main id="primary" class="site-main"><div class="member-layout"><?php get_sidebar(); ?><div class="member-content">
<section class="welcome-section"><span class="welcome-greeting"><?php printf('Bonjour %s',esc_html($u->display_name)); ?></span><h1 class="welcome-title">Votre espace de rencontre</h1><p class="welcome-subtitle">Des suggestions disponibles selon votre région et vos préférences.</p></section>
<div class="quick-access-grid"><a href="<?php echo esc_url(home_url('/profil/')); ?>" class="quick-access-card"><h3>Profil</h3><p><?php echo esc_html($pc.' % complété'); ?></p></a><a href="<?php echo esc_url(home_url('/decouverte/')); ?>" class="quick-access-card"><h3>Suggestions</h3><p>Selon votre région</p></a><a href="<?php echo esc_url(home_url('/messagerie/')); ?>" class="quick-access-card"><h3>Messages</h3><p><?php echo esc_html(affinia_get_unread_count($u->ID).' nouveau message'); ?></p></a></div>
<section class="discovery-section"><div class="discovery-heading"><h2>Découverte</h2><span class="pill pill-violet"><?php echo esc_html(strtoupper($region)); ?></span></div>
<?php $s=affinia_get_suggestions($u->ID); if(!empty($s)): ?><div class="favorites-grid"><?php foreach($s as $p){set_query_var('profile_data',$p);get_template_part('template-parts/member/card','profile');} ?></div>
<?php else: ?><div class="discovery-empty"><svg width="80" height="80" viewBox="0 0 80 80" fill="none"><circle cx="30" cy="40" r="20" fill="#E9F7D7"/><circle cx="50" cy="40" r="20" fill="#F1EAFB"/></svg><h3>Les profils compatibles apparaîtront ici.</h3><p>La disponibilité dépend de votre région. Aucun faux profil ni nombre de membres inventé.</p><a href="<?php echo esc_url(home_url('/profil/')); ?>" class="btn btn-primary btn-pill">Compléter mes préférences</a></div><?php endif; ?>
<p class="discovery-footer">Votre adresse exacte n'est jamais affichée. Vous gardez le contrôle de votre visibilité.</p></section>
</div></div></main>
<?php get_footer(); ?>
