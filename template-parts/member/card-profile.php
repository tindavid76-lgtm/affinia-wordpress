<?php
/**
 * Profile card template part
 *
 * @package Affinia
 * @since 1.0.0
 */

$profile = get_query_var( 'profile_data' );
$show_favorite = get_query_var( 'show_favorite_btn', false );

if ( ! $profile ) return;
?>

<div class="profile-card">
	<?php if ( ! empty( $profile['photo'] ) ) : ?>
		<img src="<?php echo esc_url( $profile['photo'] ); ?>" alt="<?php echo esc_attr( $profile['name'] ); ?>" class="profile-card-image" loading="lazy">
	<?php else : ?>
		<div class="profile-card-image" style="background: var(--affinia-lavender); display: flex; align-items: center; justify-content: center; font-size: 2rem; color: var(--affinia-violet);">
			<?php echo esc_html( mb_substr( $profile['name'], 0, 1 ) ); ?>
		</div>
	<?php endif; ?>

	<div class="profile-card-body">
		<h3 class="profile-card-name">
			<?php echo esc_html( $profile['name'] ); ?>
			<?php if ( ! empty( $profile['age'] ) ) : ?>
				<span class="text-caption">, <?php echo esc_html( $profile['age'] ); ?></span>
			<?php endif; ?>
		</h3>
		<?php if ( ! empty( $profile['location'] ) ) : ?>
			<p class="profile-card-meta"><?php echo esc_html( $profile['location'] ); ?></p>
		<?php endif; ?>
		<?php if ( ! empty( $profile['compatibility'] ) ) : ?>
			<span class="pill pill-lime" style="margin-top: var(--space-sm);">
				<?php echo esc_html( $profile['compatibility'] . '% compatible' ); ?>
			</span>
		<?php endif; ?>
	</div>

	<div class="profile-card-actions">
		<a href="<?php echo esc_url( home_url( '/profil/?view=' . $profile['id'] ) ); ?>" class="btn btn-ghost btn-sm" style="flex: 1;">
			<?php esc_html_e( 'Voir', 'affinia' ); ?>
		</a>
		<?php if ( $show_favorite ) : ?>
			<button class="btn btn-ghost btn-sm affinia-favorite-btn" data-user-id="<?php echo esc_attr( $profile['id'] ); ?>" style="color: var(--affinia-rose);">
				♥
			</button>
		<?php else : ?>
			<a href="<?php echo esc_url( home_url( '/messagerie/?conversation=' . $profile['id'] ) ); ?>" class="btn btn-primary btn-sm" style="flex: 1;">
				<?php esc_html_e( 'Message', 'affinia' ); ?>
			</a>
		<?php endif; ?>
	</div>
</div>
