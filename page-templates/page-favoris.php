<?php
/**
 * Template Name: Favoris
 */
if(!is_user_logged_in()){wp_redirect(wp_login_url(get_permalink()));exit;}
$u=wp_get_current_user();$favs=affinia_get_user_favorites($u->ID);$mutual=affinia_get_mutual_favorites($u->ID);
get_header();
?>
<main id="primary" class="site-main"><div class="member-layout"><?php get_sidebar(); ?><div class="member-content">
<div class="page-header"><span class="text-eyebrow">Vos connexions</span><h1>Favoris</h1></div>
<div style="display:flex;gap:var(--space-sm);margin-bottom:var(--space-xl)"><button class="btn btn-primary btn-sm btn-pill">Tous (<?php echo count($favs); ?>)</button><button class="btn btn-ghost btn-sm btn-pill">Mutuels (<?php echo count($mutual); ?>)</button></div>
<?php if(!empty($favs)): ?><div class="favorites-grid"><?php foreach($favs as $p){set_query_var('profile_data',$p);get_template_part('template-parts/member/card','profile');} ?></div>
<?php else: ?><div class="empty-state"><div class="empty-state-icon">♥</div><h3>Aucun favori pour le moment</h3><p class="text-body">Explorez les profils et ajoutez vos coups de cœur ici.</p><a href="<?php echo esc_url(home_url('/decouverte/')); ?>" class="btn btn-primary btn-pill">Découvrir des profils</a></div><?php endif; ?>
</div></div></main>
<?php get_footer(); ?>
