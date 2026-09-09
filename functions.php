<?php
/**
 * Hello Elementor Child - CI360 ACF Theme Functions
 *
 * @package HelloElementorChildCI360ACF
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// 1. Enqueue Parent, Google Fonts (Poppins), and Child Theme Styles
add_action( 'wp_enqueue_scripts', 'ci360_acf_child_enqueue_styles', 20 );

function ci360_acf_child_enqueue_styles() {
    // Google Fonts: Poppins (300, 400, 500, 600, 700, 800, 900)
    wp_enqueue_style( 'ci360-google-font-poppins', 'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,600&display=swap', array(), null );
    
    // Parent & Child Theme Styles
    wp_enqueue_style( 'hello-elementor-parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'hello-elementor-child-ci360-acf', get_stylesheet_directory_uri() . '/style.css', array( 'ci360-google-font-poppins', 'hello-elementor-parent-style' ), '1.0.1' );
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

// 6. Register [ci360_blog_grid] & [ci360_blog_archive] Shortcodes for Elementor
add_shortcode( 'ci360_blog_grid', 'ci360_acf_render_blog_grid_shortcode' );
add_shortcode( 'ci360_blog_archive', 'ci360_acf_render_blog_grid_shortcode' );

function ci360_acf_render_blog_grid_shortcode( $atts ) {
    ob_start();
    get_template_part( 'template-parts/blog-grid-acf' );
    return ob_get_clean();
}

// 7. Register [ci360_founder_leadership] & [ci360_founder_section_two] Shortcodes
add_shortcode( 'ci360_founder_leadership', 'ci360_acf_render_founder_leadership_shortcode' );
add_shortcode( 'ci360_founder_section_two', 'ci360_acf_render_founder_leadership_shortcode' );

if ( ! function_exists( 'ci360_acf_render_founder_leadership_shortcode' ) ) {
    function ci360_acf_render_founder_leadership_shortcode( $atts ) {
        ob_start();
        get_template_part( 'template-parts/founder-leadership-acf' );
        return ob_get_clean();
    }
}
