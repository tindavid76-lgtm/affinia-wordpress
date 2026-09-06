<?php
/**
 * Template Name: Inscription
 */
if(is_user_logged_in()){wp_redirect(home_url('/decouverte/'));exit;}
$step=isset($_GET['step'])?absint($_GET['step']):1;
get_header();
?>
<main id="primary" class="site-main"><div class="auth-layout"><div class="auth-card">
<div class="auth-header"><a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo"><span class="logo-icon">É</span></a><h1>Créer votre compte</h1><p class="text-body">Rejoignez une communauté de rencontres premium.</p></div>
<div class="auth-steps"><div class="auth-step <?php echo $step>=1?'is-active':''; ?> <?php echo $step>1?'is-complete':''; ?>"><span class="auth-step-number">1</span><span class="auth-step-label">Identité</span></div><div class="auth-step-line <?php echo $step>1?'is-active':''; ?>"></div><div class="auth-step <?php echo $step>=2?'is-active':''; ?> <?php echo $step>2?'is-complete':''; ?>"><span class="auth-step-number">2</span><span class="auth-step-label">Profil</span></div><div class="auth-step-line <?php echo $step>2?'is-active':''; ?>"></div><div class="auth-step <?php echo $step>=3?'is-active':''; ?>"><span class="auth-step-number">3</span><span class="auth-step-label">Préférences</span></div></div>
<form method="post" class="auth-form"><?php wp_nonce_field('affinia_register','affinia_register_nonce'); ?><input type="hidden" name="step" value="<?php echo esc_attr($step); ?>">
<?php if($step===1): ?>
<div class="form-group"><label class="form-label" for="reg_email">Email</label><input type="email" id="reg_email" name="user_email" class="form-input" required placeholder="vous@exemple.com"></div>
<div class="form-group"><label class="form-label" for="reg_password">Mot de passe</label><input type="password" id="reg_password" name="user_pass" class="form-input" required minlength="8" placeholder="Minimum 8 caractères"></div>
<div class="form-group"><label class="form-label" for="reg_firstname">Prénom</label><input type="text" id="reg_firstname" name="first_name" class="form-input" required></div>
<?php elseif($step===2): ?>
<div class="form-group"><label class="form-label">Âge</label><input type="number" name="affinia_age" class="form-input" required min="18" max="99"></div>
<div class="form-group"><label class="form-label">Ville / Région</label><input type="text" name="affinia_location" class="form-input" required></div>
<div class="form-group"><label class="form-label">Quelques mots sur vous</label><textarea name="affinia_bio" class="form-textarea" rows="3"></textarea></div>
<?php elseif($step===3): ?>
<div class="form-group"><label class="form-label">Centres d'intérêt</label><div class="interests-grid"><?php foreach(affinia_get_available_interests() as $i): ?><label class="pill" style="cursor:pointer"><input type="checkbox" name="affinia_interests[]" value="<?php echo esc_attr($i); ?>" hidden><?php echo esc_html($i); ?></label><?php endforeach; ?></div></div>
<?php endif; ?>
<div style="display:flex;gap:var(--space-md);margin-top:var(--space-lg)"><?php if($step>1): ?><a href="?step=<?php echo $step-1; ?>" class="btn btn-ghost">Retour</a><?php endif; ?><button type="submit" class="btn btn-primary" style="flex:1"><?php echo $step<3?'Continuer':'Créer mon compte'; ?></button></div>
</form>
<p class="auth-footer">Déjà membre ? <a href="<?php echo esc_url(home_url('/connexion/')); ?>">Connectez-vous</a></p>
</div></div></main>
<?php get_footer(); ?>
