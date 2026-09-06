<?php
/**
 * Bottom navigation mobile
 *
 * @package Affinia
 * @since 1.0.0
 */
?>

<nav class="bottom-nav" aria-label="<?php esc_attr_e( 'Navigation mobile', 'affinia' ); ?>">
	<ul class="bottom-nav-list">
		<li>
			<a href="<?php echo esc_url( home_url( '/decouverte/' ) ); ?>" class="bottom-nav-item <?php echo affinia_is_current_page( 'decouverte' ) ? 'is-active' : ''; ?>">
				<span class="bottom-nav-icon">◆</span>
				<span><?php esc_html_e( 'Découvrir', 'affinia' ); ?></span>
			</a>
		</li>
		<li>
			<a href="<?php echo esc_url( home_url( '/favoris/' ) ); ?>" class="bottom-nav-item <?php echo affinia_is_current_page( 'favoris' ) ? 'is-active' : ''; ?>">
				<span class="bottom-nav-icon">♥</span>
				<span><?php esc_html_e( 'Favoris', 'affinia' ); ?></span>
			</a>
		</li>
		<li>
			<a href="<?php echo esc_url( home_url( '/messagerie/' ) ); ?>" class="bottom-nav-item <?php echo affinia_is_current_page( 'messagerie' ) ? 'is-active' : ''; ?>">
				<span class="bottom-nav-icon">✉</span>
				<span><?php esc_html_e( 'Messages', 'affinia' ); ?></span>
				<?php
				$unread = affinia_get_unread_count( get_current_user_id() );
				if ( $unread > 0 ) :
				?>
					<span class="bottom-nav-badge"><?php echo esc_html( $unread ); ?></span>
				<?php endif; ?>
			</a>
		</li>
		<li>
			<a href="<?php echo esc_url( home_url( '/profil/' ) ); ?>" class="bottom-nav-item <?php echo affinia_is_current_page( 'profil' ) ? 'is-active' : ''; ?>">
				<span class="bottom-nav-icon">○</span>
				<span><?php esc_html_e( 'Profil', 'affinia' ); ?></span>
			</a>
		</li>
	</ul>
</nav>
