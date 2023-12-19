<?php
if(!defined('WP_DEBUG')) {
	die('Direct access forbidden.');
}
// add_action( 'wp_enqueue_scripts', function () {
// 	wp_enqueue_style( 'parent-style', get_theme_file_uri() . '/style.css' );

// });

add_action('wp_enqueue_scripts', function () {
	wp_enqueue_style('parent-style', get_template_directory_uri().'/style.css');
	wp_enqueue_script('swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js', array(), null, true);
	// 	wp_enqueue_style( 'style-child', get_stylesheet_uri() );
	// wp_enqueue_style( 'sd_style_css', get_theme_file_uri().'/assets/css/sd_styles.css', [], time(), 'all');
}, 99);

require_once('inc/modify_fun.php');
