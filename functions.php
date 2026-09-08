<?php
/**
 * Hello Elementor Child - CI360 ACF Theme Functions
 *
 * @package HelloElementorChildCI360ACF
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// 1. Enqueue Parent and Child Theme Styles
add_action( 'wp_enqueue_scripts', 'ci360_acf_child_enqueue_styles', 20 );

function ci360_acf_child_enqueue_styles() {
    wp_enqueue_style( 'hello-elementor-parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'hello-elementor-child-ci360-acf', get_stylesheet_directory_uri() . '/style.css', array( 'hello-elementor-parent-style' ), '1.0.0' );
}

// 2. Include CPTs, Taxonomies, and ACF Field Groups
require_once get_stylesheet_directory() . '/inc/cpt-and-acf.php';

// 3. Register [ci360_home_hero] Shortcode for Elementor
add_shortcode( 'ci360_home_hero', 'ci360_acf_render_hero_shortcode' );

function ci360_acf_render_hero_shortcode( $atts ) {
    ob_start();
    get_template_part( 'template-parts/home-hero-acf' );
    return ob_get_clean();
}

// 4. Register [ci360_featured_projects] Shortcode for Elementor
add_shortcode( 'ci360_featured_projects', 'ci360_acf_render_featured_projects_shortcode' );

function ci360_acf_render_featured_projects_shortcode( $atts ) {
    ob_start();
    get_template_part( 'template-parts/featured-projects-acf' );
    return ob_get_clean();
}

// 5. Register [ci360_foundational_pillars] Shortcode for Elementor
add_shortcode( 'ci360_foundational_pillars', 'ci360_acf_render_foundational_pillars_shortcode' );

function ci360_acf_render_foundational_pillars_shortcode( $atts ) {
    ob_start();
    get_template_part( 'template-parts/foundational-pillars-acf' );
    return ob_get_clean();
}
