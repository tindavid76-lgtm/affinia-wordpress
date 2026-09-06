<?php
/**
 * Template Name: Messagerie
 * Description: Messagerie sécurisée entre membres
 *
 * @package Affinia
 * @since 1.0.0
 */

if ( ! is_user_logged_in() ) {
	wp_redirect( wp_login_url( get_permalink() ) );
	exit;
}

$current_user = wp_get_current_user();
$conversations = affinia_get_conversations( $current_user->ID );
$active_conversation = isset( $_GET['conversation'] ) ? absint( $_GET['conversation'] ) : 0;

get_header();
?>

<main id="primary" class="site-main">
	<div class="member-layout">
		<?php get_sidebar(); ?>

		<div class="member-content">
			<div class="page-header">
				<span class="text-eyebrow"><?php esc_html_e( 'Communication', 'affinia' ); ?></span>
				<h1><?php esc_html_e( 'Messagerie sécurisée et fluide', 'affinia' ); ?></h1>
			</div>

			<div class="messagerie-layout" style="display: grid; grid-template-columns: 320px 1fr; gap: var(--space-md); height: calc(100vh - 200px);">
				<!-- Liste conversations -->
				<div class="card" style="overflow-y: auto; padding: 0;">
					<div style="padding: var(--space-md); border-bottom: 1px solid rgba(33,24,44,0.06);">
						<input type="search" class="form-input" placeholder="<?php esc_attr_e( 'Rechercher...', 'affinia' ); ?>" style="font-size: 0.8125rem;">
					</div>

					<div class="conversation-list">
						<?php if ( ! empty( $conversations ) ) : ?>
							<?php foreach ( $conversations as $convo ) : ?>
								<a href="?conversation=<?php echo esc_attr( $convo['id'] ); ?>" class="conversation-item <?php echo $convo['unread'] ? 'unread' : ''; ?> <?php echo $active_conversation === $convo['id'] ? 'is-active' : ''; ?>">
									<?php echo get_avatar( $convo['user_id'], 40 ); ?>
									<div class="conversation-body">
										<span class="conversation-name"><?php echo esc_html( $convo['name'] ); ?></span>
										<span class="conversation-preview"><?php echo esc_html( $convo['last_message'] ); ?></span>
									</div>
									<span class="conversation-time"><?php echo esc_html( $convo['time'] ); ?></span>
									<?php if ( $convo['unread'] ) : ?>
										<span class="notification-dot"></span>
									<?php endif; ?>
								</a>
							<?php endforeach; ?>
						<?php else : ?>
							<div class="empty-state" style="padding: var(--space-2xl);">
								<p class="text-body"><?php esc_html_e( 'Aucune conversation', 'affinia' ); ?></p>
							</div>
						<?php endif; ?>
					</div>
				</div>

				<!-- Zone chat -->
				<div class="chat-window">
					<?php if ( $active_conversation ) : ?>
						<?php
						$messages = affinia_get_messages( $active_conversation );
						$partner = affinia_get_conversation_partner( $active_conversation, $current_user->ID );
						?>
						<div class="chat-header">
							<?php echo get_avatar( $partner['id'], 40 ); ?>
							<div>
								<strong><?php echo esc_html( $partner['name'] ); ?></strong>
								<span class="text-caption"><?php echo esc_html( $partner['status'] ); ?></span>
							</div>
						</div>

						<div class="chat-messages">
							<?php foreach ( $messages as $msg ) : ?>
								<div class="chat-bubble <?php echo $msg['sender'] === $current_user->ID ? 'sent' : 'received'; ?>">
									<?php echo esc_html( $msg['content'] ); ?>
								</div>
							<?php endforeach; ?>
						</div>

						<div class="chat-input-area">
							<input type="text" class="chat-input" placeholder="<?php esc_attr_e( 'Écrire un message...', 'affinia' ); ?>">
							<button class="btn btn-primary btn-sm chat-send-btn"><?php esc_html_e( 'Envoyer', 'affinia' ); ?></button>
						</div>
					<?php else : ?>
						<div class="empty-state">
							<div class="empty-state-icon">✉</div>
							<h3><?php esc_html_e( 'Sélectionnez une conversation', 'affinia' ); ?></h3>
							<p class="text-body"><?php esc_html_e( 'Choisissez un contact pour démarrer.', 'affinia' ); ?></p>
						</div>
					<?php endif; ?>
				</div>
			</div>

			<!-- Sécurité -->
			<div class="card card-green" style="margin-top: var(--space-lg);">
				<h3><?php esc_html_e( 'Vous gardez la main.', 'affinia' ); ?></h3>
				<ul class="check-list">
					<li><?php esc_html_e( 'Localisation approximative', 'affinia' ); ?></li>
					<li><?php esc_html_e( 'Blocage et signalement visibles', 'affinia' ); ?></li>
					<li><?php esc_html_e( 'Suppression accessible', 'affinia' ); ?></li>
				</ul>
			</div>
		</div>
	</div>
</main>

<?php
get_footer();
