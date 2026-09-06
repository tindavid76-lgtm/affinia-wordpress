<?php
$profile = get_query_var('profile_data'); if(!$profile) return;
?>
<div class="profile-card">
	<?php if(!empty($profile['photo'])): ?>
		<img src="<?php echo esc_url($profile['photo']); ?>" alt="<?php echo esc_attr($profile['name']); ?>" class="profile-card-image" loading="lazy">
	<?php else: ?>
		<div class="profile-card-image" style="background:var(--affinia-lavender);display:flex;align-items:center;justify-content:center;font-size:2rem;color:var(--affinia-violet)"><?php echo esc_html(mb_substr($profile['name'],0,1)); ?></div>
	<?php endif; ?>
	<div class="profile-card-body">
		<h3 class="profile-card-name"><?php echo esc_html($profile['name']); ?><?php if(!empty($profile['age'])): ?><span class="text-caption">, <?php echo esc_html($profile['age']); ?></span><?php endif; ?></h3>
		<?php if(!empty($profile['location'])): ?><p class="profile-card-meta"><?php echo esc_html($profile['location']); ?></p><?php endif; ?>
	</div>
	<div class="profile-card-actions">
		<a href="<?php echo esc_url(home_url('/profil/?view='.$profile['id'])); ?>" class="btn btn-ghost btn-sm" style="flex:1">Voir</a>
		<a href="<?php echo esc_url(home_url('/messagerie/?conversation='.$profile['id'])); ?>" class="btn btn-primary btn-sm" style="flex:1">Message</a>
	</div>
</div>
