<?php
/**
 * Template Name: Notifications
 * Description: Centre de notifications du membre
 *
 * @package Affinia
 * @since 1.0.0
 */

if ( ! is_user_logged_in() ) {
	wp_redirect( wp_login_url( get_permalink() ) );
	exit;
}

$current_user = wp_get_current_user();
$notifications = affinia_get_notifications( $current_user->ID );
$unread_count = affinia_count_unread_notifications( $current_user->ID );

get_header();
?>

<main id="primary" class="site-main">
	<div class="member-layout">
		<?php get_sidebar(); ?>

		<div class="member-content">
			<div class="page-header" style="display: flex; justify-content: space-between; align-items: flex-start;">
				<div>
					<span class="text-eyebrow"><?php esc_html_e( 'Activité', 'affinia' ); ?></span>
					<h1><?php esc_html_e( 'Notifications', 'affinia' ); ?></h1>
				</div>
				<?php if ( $unread_count > 0 ) : ?>
					<a href="<?php echo esc_url( add_query_arg( 'mark_all_read', '1' ) ); ?>" class="btn btn-ghost btn-sm">
						<?php esc_html_e( 'Tout marquer comme lu', 'affinia' ); ?>
					</a>
				<?php endif; ?>
			</div>

			<!-- Filtres -->
			<div style="display: flex; gap: var(--space-sm); margin-bottom: var(--space-lg);">
				<button class="btn btn-primary btn-sm btn-pill"><?php esc_html_e( 'Toutes', 'affinia' ); ?></button>
				<button class="btn btn-ghost btn-sm btn-pill"><?php esc_html_e( 'Matchs', 'affinia' ); ?></button>
				<button class="btn btn-ghost btn-sm btn-pill"><?php esc_html_e( 'Messages', 'affinia' ); ?></button>
				<button class="btn btn-ghost btn-sm btn-pill"><?php esc_html_e( 'Visites', 'affinia' ); ?></button>
			</div>

			<!-- Liste notifications -->
			<div class="card" style="padding: 0;">
				<?php if ( ! empty( $notifications ) ) : ?>
					<div class="notification-list">
						<?php foreach ( $notifications as $notif ) : ?>
							<div class="notification-item <?php echo $notif['read'] ? '' : 'unread'; ?>">
								<div class="notification-icon <?php echo esc_attr( $notif['type'] ); ?>">
									<?php echo esc_html( affinia_get_notification_icon( $notif['type'] ) ); ?>
								</div>
								<div class="notification-body">
									<p class="notification-text"><?php echo wp_kses_post( $notif['message'] ); ?></p>
									<span class="notification-time"><?php echo esc_html( $notif['time'] ); ?></span>
								</div>
								<?php if ( ! $notif['read'] ) : ?>
									<span class="notification-dot"></span>
								<?php endif; ?>
							</div>
						<?php endforeach; ?>
					</div>
				<?php else : ?>
					<div class="empty-state">
						<div class="empty-state-icon">🔔</div>
						<h3><?php esc_html_e( 'Pas de notifications', 'affinia' ); ?></h3>
						<p class="text-body"><?php esc_html_e( 'Vos activités récentes apparaîtront ici.', 'affinia' ); ?></p>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</main>

<?php
get_footer();
