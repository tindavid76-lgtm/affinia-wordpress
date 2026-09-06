<?php
function affinia_customize_register( $wp_customize ) {
	$wp_customize->add_section( 'affinia_settings', array( 'title' => __( 'Affinia - Réglages', 'affinia' ), 'priority' => 30 ) );
	$wp_customize->add_setting( 'affinia_footer_tagline', array( 'default' => 'La rencontre premium, en toute élégance.', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( 'affinia_footer_tagline', array( 'label' => __( 'Slogan du pied de page', 'affinia' ), 'section' => 'affinia_settings', 'type' => 'text' ) );
	$wp_customize->add_setting( 'affinia_primary_color', array( 'default' => '#21182C', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'affinia_primary_color', array( 'label' => __( 'Couleur primaire', 'affinia' ), 'section' => 'affinia_settings' ) ) );
	$wp_customize->add_setting( 'affinia_accent_color', array( 'default' => '#6D3BD1', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'affinia_accent_color', array( 'label' => __( 'Couleur accent', 'affinia' ), 'section' => 'affinia_settings' ) ) );
}
add_action( 'customize_register', 'affinia_customize_register' );

function affinia_customizer_css() {
	$p = get_theme_mod( 'affinia_primary_color', '#21182C' );
	$a = get_theme_mod( 'affinia_accent_color', '#6D3BD1' );
	if ( $p !== '#21182C' || $a !== '#6D3BD1' ) {
		echo '<style>:root {';
		if ( $p !== '#21182C' ) echo '--affinia-aubergine:' . esc_attr($p) . ';';
		if ( $a !== '#6D3BD1' ) echo '--affinia-violet:' . esc_attr($a) . ';';
		echo '}</style>';
	}
}
add_action( 'wp_head', 'affinia_customizer_css', 100 );
