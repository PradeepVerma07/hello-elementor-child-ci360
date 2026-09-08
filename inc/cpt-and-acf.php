<?php
/**
 * Custom Post Types (CPT), Taxonomies & ACF Fields Setup
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
// 2. REGISTER ACF OPTIONS PAGE ("CI360 Hero Settings")
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
// 3. REGISTER ACF FIELD GROUPS
// =========================================================================
add_action( 'acf/init', 'ci360_acf_register_all_local_fields' );

function ci360_acf_register_all_local_fields() {
    if ( ! function_exists( 'acf_add_local_field_group' ) ) {
        return;
    }

    // ---------------------------------------------------------------------
    // Field Group 1: Hero Section Settings (Options Page + Front Page)
    // ---------------------------------------------------------------------
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

            // Tab 3: Stats / Metrics
            array(
                'key' => 'field_tab_hero_stats',
                'label' => 'Live Metrics Grid',
                'type' => 'tab',
            ),
            array(
                'key' => 'field_hero_stats_repeater',
                'label' => 'Hero Stats (4 Items Recommended)',
                'name' => 'hero_stats_repeater',
                'type' => 'repeater',
                'layout' => 'table',
                'button_label' => 'Add Stat Card',
                'sub_fields' => array(
                    array(
                        'key' => 'field_stat_value',
                        'label' => 'Metric Number / Value (e.g. ₹450Cr+)',
                        'name' => 'stat_value',
                        'type' => 'text',
                        'required' => 1,
                    ),
                    array(
                        'key' => 'field_stat_label',
                        'label' => 'Metric Label (e.g. Client Revenue)',
                        'name' => 'stat_label',
                        'type' => 'text',
                        'required' => 1,
                    ),
                    array(
                        'key' => 'field_stat_color',
                        'label' => 'Accent Color',
                        'name' => 'stat_color',
                        'type' => 'select',
                        'choices' => array(
                            'text-emerald-400' => 'Emerald Green',
                            'text-cyan-400'    => 'Cyan Blue',
                            'text-blue-400'    => 'Electric Blue',
                            'text-indigo-400'  => 'Indigo Violet',
                        ),
                        'default_value' => 'text-cyan-400',
                    ),
                ),
            ),

            // Tab 4: Showcase Slides & Video
            array(
                'key' => 'field_tab_hero_slides',
                'label' => 'Right Showcase Slider',
                'type' => 'tab',
            ),
            array(
                'key' => 'field_hero_slides_repeater',
                'label' => 'Showcase Cards (Images or Videos)',
                'name' => 'hero_slides_repeater',
                'type' => 'repeater',
                'layout' => 'block',
                'button_label' => 'Add Showcase Slide',
                'sub_fields' => array(
                    array(
                        'key' => 'field_slide_title',
                        'label' => 'Slide Title',
                        'name' => 'slide_title',
                        'type' => 'text',
                        'required' => 1,
                    ),
                    array(
                        'key' => 'field_slide_tag',
                        'label' => 'Pill Tag (e.g. Visual Moats, Project)',
                        'name' => 'slide_tag',
                        'type' => 'text',
                        'default_value' => 'Showcase',
                    ),
                    array(
                        'key' => 'field_slide_description',
                        'label' => 'Short Summary',
                        'name' => 'slide_description',
                        'type' => 'textarea',
                        'rows' => 2,
                    ),
                    array(
                        'key' => 'field_slide_image',
                        'label' => 'Slide Cover Image',
                        'name' => 'slide_image',
                        'type' => 'image',
                        'return_format' => 'url',
                    ),
                    array(
                        'key' => 'field_slide_video_url',
                        'label' => 'Direct MP4 Video URL (Optional)',
                        'name' => 'slide_video_url',
                        'type' => 'url',
                        'instructions' => 'If provided, the slide plays direct MP4 video instead of the static image.',
                    ),
                ),
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

    // ---------------------------------------------------------------------
    // Field Group 2: Case Study Single Project Details (CPT: case_study)
    // ---------------------------------------------------------------------
    acf_add_local_field_group( array(
        'key' => 'group_ci360_case_study_details',
        'title' => 'Case Study Project Metadata & Metrics',
        'fields' => array(
            array(
                'key' => 'field_cs_client_name',
                'label' => 'Client Name',
                'name' => 'client_name',
                'type' => 'text',
            ),
            array(
                'key' => 'field_cs_summary',
                'label' => 'Card Short Summary',
                'name' => 'card_summary',
                'type' => 'textarea',
                'rows' => 2,
            ),
            array(
                'key' => 'field_cs_metrics',
                'label' => 'Impact Metrics (3 Items)',
                'name' => 'impact_metrics',
                'type' => 'repeater',
                'layout' => 'table',
                'button_label' => 'Add Metric',
                'sub_fields' => array(
                    array(
                        'key' => 'field_cs_metric_val',
                        'label' => 'Value (e.g. ₹180Cr+, +210%)',
                        'name' => 'metric_value',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_cs_metric_lbl',
                        'label' => 'Label (e.g. Pipeline Influenced)',
                        'name' => 'metric_label',
                        'type' => 'text',
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'case_study',
                ),
            ),
        ),
    ) );
}
