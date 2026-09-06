<?php
/**
 * Template Name: Notifications
 */
if(!is_user_logged_in()){wp_redirect(wp_login_url(get_permalink()));exit;}
$u=wp_get_current_user();$notifs=affinia_get_notifications($u->ID);$unread=affinia_count_unread_notifications($u->ID);
get_header();
?>
<main id="primary" class="site-main"><div class="member-layout"><?php get_sidebar(); ?><div class="member-content">
<div class="page-header" style="display:flex;justify-content:space-between;align-items:flex-start"><div><span class="text-eyebrow">Activité</span><h1>Notifications</h1></div><?php if($unread>0): ?><a href="<?php echo esc_url(add_query_arg('mark_all_read','1')); ?>" class="btn btn-ghost btn-sm">Tout marquer comme lu</a><?php endif; ?></div>
<div style="display:flex;gap:var(--space-sm);margin-bottom:var(--space-lg)"><button class="btn btn-primary btn-sm btn-pill">Toutes</button><button class="btn btn-ghost btn-sm btn-pill">Matchs</button><button class="btn btn-ghost btn-sm btn-pill">Messages</button><button class="btn btn-ghost btn-sm btn-pill">Visites</button></div>
<div class="card" style="padding:0"><?php if(!empty($notifs)): ?><div class="notification-list"><?php foreach($notifs as $n): ?><div class="notification-item <?php echo $n['read']?'':'unread'; ?>"><div class="notification-icon <?php echo esc_attr($n['type']); ?>"><?php echo esc_html(affinia_get_notification_icon($n['type'])); ?></div><div class="notification-body"><p class="notification-text"><?php echo wp_kses_post($n['message']); ?></p><span class="notification-time"><?php echo esc_html($n['time']); ?></span></div></div><?php endforeach; ?></div>
<?php else: ?><div class="empty-state"><h3>Pas de notifications</h3><p class="text-body">Vos activités récentes apparaîtront ici.</p></div><?php endif; ?></div>
</div></div></main>
<?php get_footer(); ?>
