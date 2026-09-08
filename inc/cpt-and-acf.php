<?php
/**
 * Custom Post Types (CPT), Taxonomies & ACF Fields Setup
 * Compatible with BOTH ACF Free and ACF Pro.
 *
 * @package HelloElementorChildCI360ACF
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// =========================================================================
// 1. REGISTER CUSTOM POST TYPES & TAXONOMIES
// =========================================================================
add_action( 'init', 'ci360_register_custom_post_types_and_taxonomies' );

function ci360_register_custom_post_types_and_taxonomies() {
    // 1.1 Case Studies / Projects CPT
    $case_study_labels = array(
        'name'               => _x( 'Case Studies', 'post type general name', 'hello-elementor-child-ci360-acf' ),
        'singular_name'      => _x( 'Case Study', 'post type singular name', 'hello-elementor-child-ci360-acf' ),
        'menu_name'          => _x( 'Case Studies', 'admin menu', 'hello-elementor-child-ci360-acf' ),
        'name_admin_bar'     => _x( 'Case Study', 'add new on admin bar', 'hello-elementor-child-ci360-acf' ),
        'add_new'            => _x( 'Add New Case Study', 'case study', 'hello-elementor-child-ci360-acf' ),
        'add_new_item'       => __( 'Add New Case Study', 'hello-elementor-child-ci360-acf' ),
        'new_item'           => __( 'New Case Study', 'hello-elementor-child-ci360-acf' ),
        'edit_item'          => __( 'Edit Case Study', 'hello-elementor-child-ci360-acf' ),
        'view_item'          => __( 'View Case Study', 'hello-elementor-child-ci360-acf' ),
        'all_items'          => __( 'All Case Studies', 'hello-elementor-child-ci360-acf' ),
        'search_items'       => __( 'Search Case Studies', 'hello-elementor-child-ci360-acf' ),
        'not_found'          => __( 'No case studies found.', 'hello-elementor-child-ci360-acf' ),
        'not_found_in_trash' => __( 'No case studies found in Trash.', 'hello-elementor-child-ci360-acf' ),
    );

    register_post_type( 'case_study', array(
        'labels'             => $case_study_labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'case-studies', 'with_front' => false ),
        'capability_type'    => 'post',
        'has_archive'        => 'case-studies',
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-portfolio',
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'revisions' ),
        'show_in_rest'       => true,
    ) );

    // 1.2 Case Study Categories / Sectors Taxonomy
    $cat_labels = array(
        'name'              => _x( 'Sectors / Categories', 'taxonomy general name', 'hello-elementor-child-ci360-acf' ),
        'singular_name'     => _x( 'Sector / Category', 'taxonomy singular name', 'hello-elementor-child-ci360-acf' ),
        'search_items'      => __( 'Search Sectors', 'hello-elementor-child-ci360-acf' ),
        'all_items'         => __( 'All Sectors', 'hello-elementor-child-ci360-acf' ),
        'edit_item'         => __( 'Edit Sector', 'hello-elementor-child-ci360-acf' ),
        'update_item'       => __( 'Update Sector', 'hello-elementor-child-ci360-acf' ),
        'add_new_item'      => __( 'Add New Sector', 'hello-elementor-child-ci360-acf' ),
        'new_item_name'     => __( 'New Sector Name', 'hello-elementor-child-ci360-acf' ),
        'menu_name'         => __( 'Sectors & Domains', 'hello-elementor-child-ci360-acf' ),
    );

    register_taxonomy( 'case_study_category', array( 'case_study' ), array(
        'hierarchical'      => true,
        'labels'            => $cat_labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'case-study-sector' ),
        'show_in_rest'      => true,
    ) );
}

// =========================================================================
// 2. REGISTER ACF OPTIONS PAGE ("Hero Settings")
// =========================================================================
add_action( 'acf/init', 'ci360_register_acf_options_page' );

function ci360_register_acf_options_page() {
    if ( function_exists( 'acf_add_options_page' ) ) {
        acf_add_options_page( array(
            'page_title' => 'CI360 Hero Section Settings',
            'menu_title' => 'Hero Settings',
            'menu_slug'  => 'ci360-hero-settings',
            'capability' => 'edit_posts',
            'icon_url'   => 'dashicons-superhero-alt',
            'position'   => 4,
            'redirect'   => false,
        ) );
    }
}

// =========================================================================
// 3. REGISTER ACF FIELD GROUPS (ACF Free & Pro Compatible)
// =========================================================================
add_action( 'acf/init', 'ci360_acf_register_all_local_fields' );

function ci360_acf_register_all_local_fields() {
    if ( ! function_exists( 'acf_add_local_field_group' ) ) {
        return;
    }

    acf_add_local_field_group( array(
        'key' => 'group_ci360_hero_settings',
        'title' => 'CI360: Dynamic Home Hero Section Settings',
        'fields' => array(
            // Tab 1: Headlines & Text
            array(
                'key' => 'field_tab_hero_text',
                'label' => 'Headlines & Text',
                'type' => 'tab',
            ),
            array(
                'key' => 'field_hero_badge_text',
                'label' => 'Top Badge Text',
                'name' => 'hero_badge_text',
                'type' => 'text',
                'default_value' => 'One Integrated Partner. Every Marketing Possibility.',
            ),
            array(
                'key' => 'field_hero_title_prefix',
                'label' => 'Headline Top Line',
                'name' => 'hero_title_prefix',
                'type' => 'text',
                'default_value' => 'Stories That',
            ),
            array(
                'key' => 'field_hero_title_highlight',
                'label' => 'Gradient Highlight Words',
                'name' => 'hero_title_highlight',
                'type' => 'text',
                'default_value' => 'Move Brands',
                'instructions' => 'These words render in glowing cyan/blue gradient text.',
            ),
            array(
                'key' => 'field_hero_title_suffix',
                'label' => 'Headline Bottom Line',
                'name' => 'hero_title_suffix',
                'type' => 'text',
                'default_value' => 'Forward.',
            ),
            array(
                'key' => 'field_hero_description',
                'label' => 'Intro Description',
                'name' => 'hero_description',
                'type' => 'textarea',
                'rows' => 3,
                'default_value' => 'CI360 Degrees is an integrated digital marketing and strategic communication agency helping businesses transform ideas into impactful brand experiences and measurable growth.',
            ),

            // Tab 2: Call to Action Buttons
            array(
                'key' => 'field_tab_hero_buttons',
                'label' => 'Call to Action Buttons',
                'type' => 'tab',
            ),
            array(
                'key' => 'field_hero_btn1_text',
                'label' => 'Primary Button Label',
                'name' => 'hero_btn1_text',
                'type' => 'text',
                'default_value' => 'Start a Conversation',
            ),
            array(
                'key' => 'field_hero_btn1_url',
                'label' => 'Primary Button Link',
                'name' => 'hero_btn1_url',
                'type' => 'text',
                'default_value' => '/contact-us/',
            ),
            array(
                'key' => 'field_hero_btn2_text',
                'label' => 'Secondary Button Label',
                'name' => 'hero_btn2_text',
                'type' => 'text',
                'default_value' => 'Explore Our Work',
            ),
            array(
                'key' => 'field_hero_btn2_url',
                'label' => 'Secondary Button Link',
                'name' => 'hero_btn2_url',
                'type' => 'text',
                'default_value' => '/projects/',
            ),

            // Tab 3: Stats / Metrics (4 Metric Fields - Free & Pro compatible)
            array(
                'key' => 'field_tab_hero_stats',
                'label' => 'Live Metrics Grid',
                'type' => 'tab',
            ),
            array(
                'key' => 'field_stat1_val',
                'label' => 'Metric 1 Value',
                'name' => 'hero_stat1_value',
                'type' => 'text',
                'default_value' => '₹450Cr+',
                'wrapper' => array( 'width' => '50' ),
            ),
            array(
                'key' => 'field_stat1_lbl',
                'label' => 'Metric 1 Label',
                'name' => 'hero_stat1_label',
                'type' => 'text',
                'default_value' => 'Client Revenue',
                'wrapper' => array( 'width' => '50' ),
            ),
            array(
                'key' => 'field_stat2_val',
                'label' => 'Metric 2 Value',
                'name' => 'hero_stat2_value',
                'type' => 'text',
                'default_value' => '98.4%',
                'wrapper' => array( 'width' => '50' ),
            ),
            array(
                'key' => 'field_stat2_lbl',
                'label' => 'Metric 2 Label',
                'name' => 'hero_stat2_label',
                'type' => 'text',
                'default_value' => 'Client Retention',
                'wrapper' => array( 'width' => '50' ),
            ),
            array(
                'key' => 'field_stat3_val',
                'label' => 'Metric 3 Value',
                'name' => 'hero_stat3_value',
                'type' => 'text',
                'default_value' => '3 Studios',
                'wrapper' => array( 'width' => '50' ),
            ),
            array(
                'key' => 'field_stat3_lbl',
                'label' => 'Metric 3 Label',
                'name' => 'hero_stat3_label',
                'type' => 'text',
                'default_value' => 'Ahmedabad • Delhi • USA',
                'wrapper' => array( 'width' => '50' ),
            ),
            array(
                'key' => 'field_stat4_val',
                'label' => 'Metric 4 Value',
                'name' => 'hero_stat4_value',
                'type' => 'text',
                'default_value' => '< 1.2s',
                'wrapper' => array( 'width' => '50' ),
            ),
            array(
                'key' => 'field_stat4_lbl',
                'label' => 'Metric 4 Label',
                'name' => 'hero_stat4_label',
                'type' => 'text',
                'default_value' => 'Page Speed',
                'wrapper' => array( 'width' => '50' ),
            ),

            // Tab 4: Showcase Slider & Video Link
            array(
                'key' => 'field_tab_hero_slides',
                'label' => 'Right Showcase Slider & Video',
                'type' => 'tab',
            ),
            array(
                'key' => 'field_hero_video_link',
                'label' => '▶ Showcase Video Link (Direct MP4 URL)',
                'name' => 'hero_video_url',
                'type' => 'url',
                'instructions' => 'Paste your direct MP4 video link here to enable video playback on the 3D CGI / Project slide.',
                'default_value' => 'https://lightcyan-dinosaur-747226.hostingersite.com/wp-content/uploads/2026/09/WhatsApp-Video-2026-09-08-at-15.18.30.mp4',
            ),
            array(
                'key' => 'field_hero_video_title',
                'label' => 'Video Slide Title',
                'name' => 'hero_video_title',
                'type' => 'text',
                'default_value' => '3D CGI & Motion Graphics',
                'wrapper' => array( 'width' => '50' ),
            ),
            array(
                'key' => 'field_hero_video_tag',
                'label' => 'Video Slide Tag / Badge',
                'name' => 'hero_video_tag',
                'type' => 'text',
                'default_value' => 'Project',
                'wrapper' => array( 'width' => '50' ),
            ),
            array(
                'key' => 'field_hero_video_desc',
                'label' => 'Video Slide Description',
                'name' => 'hero_video_desc',
                'type' => 'textarea',
                'rows' => 2,
                'default_value' => 'Photorealistic 3D product visualizations, virtual environments, and motion narratives.',
            ),
            array(
                'key' => 'field_hero_slide1_image',
                'label' => 'Slide 1 Image (Brand Architecture)',
                'name' => 'hero_slide1_image',
                'type' => 'image',
                'return_format' => 'url',
            ),
            array(
                'key' => 'field_hero_slide2_image',
                'label' => 'Slide 2 Image (Strategic Storytelling)',
                'name' => 'hero_slide2_image',
                'type' => 'image',
                'return_format' => 'url',
            ),
            array(
                'key' => 'field_hero_slide3_image',
                'label' => 'Slide 3 Image (Commercial Film & Media)',
                'name' => 'hero_slide3_image',
                'type' => 'image',
                'return_format' => 'url',
            ),
            array(
                'key' => 'field_hero_slide5_image',
                'label' => 'Slide 5 Image (Websites & Experiences)',
                'name' => 'hero_slide5_image',
                'type' => 'image',
                'return_format' => 'url',
            ),
            array(
                'key' => 'field_hero_slide6_image',
                'label' => 'Slide 6 Image (4K Podcast Studio)',
                'name' => 'hero_slide6_image',
                'type' => 'image',
                'return_format' => 'url',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'ci360-hero-settings',
                ),
            ),
            array(
                array(
                    'param' => 'page_type',
                    'operator' => '==',
                    'value' => 'front_page',
                ),
            ),
            array(
                array(
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'template-home-acf.php',
                ),
            ),
        ),
    ) );
}
