<?php
/**
 * Affinia — Functions and definitions
 *
 * @package Affinia
 * @since 1.0.0
 */

if ( ! defined( 'AFFINIA_VERSION' ) ) {
	define( 'AFFINIA_VERSION', '1.0.0' );
}

/**
 * Theme Setup
 */
function affinia_setup() {
	// Translations
	load_theme_textdomain( 'affinia', get_template_directory() . '/languages' );

	// Default WordPress features
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
		'style',
		'script',
	) );
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Custom logo
	add_theme_support( 'custom-logo', array(
		'height'      => 40,
		'width'       => 200,
		'flex-height' => true,
		'flex-width'  => true,
	) );

	// Navigation menus
	register_nav_menus( array(
		'primary'      => __( 'Menu principal', 'affinia' ),
		'member'       => __( 'Menu espace membre', 'affinia' ),
		'footer'       => __( 'Menu pied de page', 'affinia' ),
		'mobile'       => __( 'Navigation mobile', 'affinia' ),
	) );

	// Featured image sizes
	add_image_size( 'affinia-profile', 400, 500, true );
	add_image_size( 'affinia-card', 340, 200, true );
	add_image_size( 'affinia-avatar', 80, 80, true );
	add_image_size( 'affinia-hero', 1460, 600, true );
}
add_action( 'after_setup_theme', 'affinia_setup' );

/**
 * Enqueue scripts and styles
 */
function affinia_scripts() {
	// Google Fonts — Manrope
	wp_enqueue_style(
		'affinia-google-fonts',
		'https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&display=swap',
		array(),
		null
	);

	// Main stylesheet
	wp_enqueue_style(
		'affinia-style',
		get_stylesheet_uri(),
		array( 'affinia-google-fonts' ),
		AFFINIA_VERSION
	);

	// Components CSS
	wp_enqueue_style(
		'affinia-components',
		get_template_directory_uri() . '/assets/css/components.css',
		array( 'affinia-style' ),
		AFFINIA_VERSION
	);

	// Member space CSS
	if ( is_user_logged_in() ) {
		wp_enqueue_style(
			'affinia-member',
			get_template_directory_uri() . '/assets/css/member-space.css',
			array( 'affinia-components' ),
			AFFINIA_VERSION
		);
	}

	// Responsive CSS
	wp_enqueue_style(
		'affinia-responsive',
		get_template_directory_uri() . '/assets/css/responsive.css',
		array( 'affinia-style' ),
		AFFINIA_VERSION
	);

	// Main JS
	wp_enqueue_script(
		'affinia-main',
		get_template_directory_uri() . '/assets/js/main.js',
		array(),
		AFFINIA_VERSION,
		true
	);

	// Localize script for AJAX
	wp_localize_script( 'affinia-main', 'affiniaAjax', array(
		'ajaxUrl' => admin_url( 'admin-ajax.php' ),
		'nonce'   => wp_create_nonce( 'affinia_nonce' ),
	) );
}
add_action( 'wp_enqueue_scripts', 'affinia_scripts' );

/**
 * Register widget areas
 */
function affinia_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar Membre', 'affinia' ),
		'id'            => 'sidebar-member',
		'description'   => __( 'Barre latérale de l\'espace membre.', 'affinia' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Pied de page', 'affinia' ),
		'id'            => 'footer-widgets',
		'description'   => __( 'Zone de widgets du pied de page.', 'affinia' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'affinia_widgets_init' );

/**
 * Custom excerpt length
 */
function affinia_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'affinia_excerpt_length' );

/**
 * Include additional files
 */
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/shortcodes.php';
require get_template_directory() . '/inc/member-functions.php';
