<?php $u = wp_get_current_user(); ?>
<section class="welcome-section">
	<span class="welcome-greeting"><?php printf('Bonjour %s', esc_html($u->display_name)); ?></span>
	<h1 class="welcome-title">Votre espace de rencontre</h1>
	<p class="welcome-subtitle">Des suggestions disponibles selon votre région et vos préférences.</p>
</section>
