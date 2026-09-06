<?php
/**
 * Affinia — Customizer settings
 *
 * @package Affinia
 * @since 1.0.0
 */

function affinia_customize_register( $wp_customize ) {
	// Section Affinia
	$wp_customize->add_section( 'affinia_settings', array(
		'title'    => __( 'Affinia - Réglages', 'affinia' ),
		'priority' => 30,
	) );

	// Tagline du footer
	$wp_customize->add_setting( 'affinia_footer_tagline', array(
		'default'           => __( 'La rencontre premium, en toute élégance.', 'affinia' ),
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'affinia_footer_tagline', array(
		'label'   => __( 'Slogan du pied de page', 'affinia' ),
		'section' => 'affinia_settings',
		'type'    => 'text',
	) );

	// Couleur primaire override
	$wp_customize->add_setting( 'affinia_primary_color', array(
		'default'           => '#21182C',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'affinia_primary_color', array(
		'label'   => __( 'Couleur primaire (Aubergine)', 'affinia' ),
		'section' => 'affinia_settings',
	) ) );

	// Couleur accent
	$wp_customize->add_setting( 'affinia_accent_color', array(
		'default'           => '#6D3BD1',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'affinia_accent_color', array(
		'label'   => __( 'Couleur accent (Violet)', 'affinia' ),
		'section' => 'affinia_settings',
	) ) );
}
add_action( 'customize_register', 'affinia_customize_register' );

/**
 * Output custom CSS variables from Customizer
 */
function affinia_customizer_css() {
	$primary = get_theme_mod( 'affinia_primary_color', '#21182C' );
	$accent = get_theme_mod( 'affinia_accent_color', '#6D3BD1' );

	if ( $primary !== '#21182C' || $accent !== '#6D3BD1' ) {
		echo '<style>:root {';
		if ( $primary !== '#21182C' ) {
			echo '--affinia-aubergine: ' . esc_attr( $primary ) . ';';
		}
		if ( $accent !== '#6D3BD1' ) {
			echo '--affinia-violet: ' . esc_attr( $accent ) . ';';
		}
		echo '}</style>';
	}
}
add_action( 'wp_head', 'affinia_customizer_css', 100 );
