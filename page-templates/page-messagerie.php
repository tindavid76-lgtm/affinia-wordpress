<?php
/**
 * Template Name: Messagerie
 */
if(!is_user_logged_in()){wp_redirect(wp_login_url(get_permalink()));exit;}
$u=wp_get_current_user();$convos=affinia_get_conversations($u->ID);$active=isset($_GET['conversation'])?absint($_GET['conversation']):0;
get_header();
?>
<main id="primary" class="site-main"><div class="member-layout"><?php get_sidebar(); ?><div class="member-content">
<div class="page-header"><span class="text-eyebrow">Communication</span><h1>Messagerie sécurisée et fluide</h1></div>
<div style="display:grid;grid-template-columns:320px 1fr;gap:var(--space-md);height:calc(100vh - 200px)">
<div class="card" style="overflow-y:auto;padding:0"><div style="padding:var(--space-md);border-bottom:1px solid rgba(33,24,44,0.06)"><input type="search" class="form-input" placeholder="Rechercher..." style="font-size:0.8125rem"></div>
<div class="conversation-list"><?php if(!empty($convos)): foreach($convos as $c): ?><a href="?conversation=<?php echo esc_attr($c['id']); ?>" class="conversation-item <?php echo $c['unread']?'unread':''; ?>"><?php echo get_avatar($c['user_id'],40); ?><div class="conversation-body"><span class="conversation-name"><?php echo esc_html($c['name']); ?></span><span class="conversation-preview"><?php echo esc_html($c['last_message']); ?></span></div><span class="conversation-time"><?php echo esc_html($c['time']); ?></span></a><?php endforeach; else: ?><div class="empty-state" style="padding:var(--space-2xl)"><p class="text-body">Aucune conversation</p></div><?php endif; ?></div></div>
<div class="chat-window"><?php if($active): $msgs=affinia_get_messages($active);$partner=affinia_get_conversation_partner($active,$u->ID); ?>
<div class="chat-header"><?php echo get_avatar($partner['id'],40); ?><div><strong><?php echo esc_html($partner['name']); ?></strong></div></div>
<div class="chat-messages"><?php foreach($msgs as $m): ?><div class="chat-bubble <?php echo $m['sender']===$u->ID?'sent':'received'; ?>"><?php echo esc_html($m['content']); ?></div><?php endforeach; ?></div>
<div class="chat-input-area"><input type="text" class="chat-input" placeholder="Écrire un message..."><button class="btn btn-primary btn-sm chat-send-btn">Envoyer</button></div>
<?php else: ?><div class="empty-state"><div class="empty-state-icon">✉</div><h3>Sélectionnez une conversation</h3></div><?php endif; ?></div>
</div>
<div class="card card-green" style="margin-top:var(--space-lg)"><h3>Vous gardez la main.</h3><ul class="check-list"><li>Localisation approximative</li><li>Blocage et signalement visibles</li><li>Suppression accessible</li></ul></div>
</div></div></main>
<?php get_footer(); ?>
