<?php
/**
 * Template Name: Connexion
 */
if(is_user_logged_in()){wp_redirect(home_url('/decouverte/'));exit;}
$error='';if(isset($_GET['login'])&&$_GET['login']==='failed') $error='Identifiants incorrects. Veuillez réessayer.';
get_header();
?>
<main id="primary" class="site-main"><div class="auth-layout"><div class="auth-card">
<div class="auth-header"><a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo"><span class="logo-icon">É</span></a><h1>Bon retour</h1><p class="text-body">Connectez-vous à votre espace membre.</p></div>
<?php if($error): ?><div class="card card-amber" style="margin-bottom:var(--space-lg);padding:var(--space-md)"><p style="font-size:0.875rem"><?php echo esc_html($error); ?></p></div><?php endif; ?>
<form method="post" action="<?php echo esc_url(wp_login_url()); ?>" class="auth-form"><input type="hidden" name="redirect_to" value="<?php echo esc_url(home_url('/decouverte/')); ?>">
<div class="form-group"><label class="form-label" for="user_login">Email</label><input type="email" id="user_login" name="log" class="form-input" required autofocus placeholder="vous@exemple.com"></div>
<div class="form-group"><div style="display:flex;justify-content:space-between"><label class="form-label" for="user_pass">Mot de passe</label><a href="<?php echo esc_url(wp_lostpassword_url()); ?>" class="text-caption" style="color:var(--affinia-violet)">Oublié ?</a></div><input type="password" id="user_pass" name="pwd" class="form-input" required></div>
<label style="display:flex;align-items:center;gap:var(--space-sm);cursor:pointer"><input type="checkbox" name="rememberme" value="forever"><span class="text-caption">Se souvenir de moi</span></label>
<button type="submit" class="btn btn-primary" style="width:100%">Se connecter</button>
</form>
<p class="auth-footer">Pas encore membre ? <a href="<?php echo esc_url(home_url('/inscription/')); ?>">Créer un compte</a></p>
</div></div></main>
<?php get_footer(); ?>
