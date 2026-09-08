<?php
/**
 * Custom Post Types (CPT), Taxonomies, ACF Field Groups & Meta Boxes
 * Full Image Link and Media controls for Hero and Featured Projects.
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
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'page-attributes' ),
        'show_in_rest'       => true,
    ) );

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
        'rewrite'            => array( 'slug' => 'case-study-sector' ),
        'show_in_rest'      => true,
    ) );
}

// =========================================================================
// 2. REGISTER ACF OPTIONS PAGE
// =========================================================================
add_action( 'acf/init', 'ci360_register_acf_options_page' );

function ci360_register_acf_options_page() {
    if ( function_exists( 'acf_add_options_page' ) ) {
        acf_add_options_page( array(
            'page_title' => 'CI360 Theme Settings',
            'menu_title' => 'CI360 Settings',
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

    $hero_fields = array(
        // Tab 1: Hero Headlines & Text
        array(
            'key' => 'field_tab_hero_text',
            'label' => 'Hero Headlines & Text',
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
            'label' => 'Hero Description Paragraph',
            'name' => 'hero_description',
            'type' => 'textarea',
            'rows' => 3,
            'default_value' => 'CI360 Degrees is an integrated digital marketing and strategic communication agency helping businesses transform ideas into impactful brand experiences and measurable growth.',
        ),

        // Tab 2: Hero CTAs
        array(
            'key' => 'field_tab_hero_ctas',
            'label' => 'Hero Buttons',
            'type' => 'tab',
        ),
        array(
            'key' => 'field_hero_btn1_text',
            'label' => 'Primary Button Text',
            'name' => 'hero_btn1_text',
            'type' => 'text',
            'default_value' => 'Start a Conversation',
            'wrapper' => array( 'width' => '50' ),
        ),
        array(
            'key' => 'field_hero_btn1_url',
            'label' => 'Primary Button Link',
            'name' => 'hero_btn1_url',
            'type' => 'text',
            'default_value' => '/contact-us/',
            'wrapper' => array( 'width' => '50' ),
        ),
        array(
            'key' => 'field_hero_btn2_text',
            'label' => 'Secondary Button Text',
            'name' => 'hero_btn2_text',
            'type' => 'text',
            'default_value' => 'Explore Our Work',
            'wrapper' => array( 'width' => '50' ),
        ),
        array(
            'key' => 'field_hero_btn2_url',
            'label' => 'Secondary Button Link',
            'name' => 'hero_btn2_url',
            'type' => 'text',
            'default_value' => '/projects/',
            'wrapper' => array( 'width' => '50' ),
        ),

        // Tab 3: Hero Metrics
        array(
            'key' => 'field_tab_hero_stats',
            'label' => 'Hero Metrics',
            'type' => 'tab',
        ),
        array(
            'key' => 'field_hero_stat1_value',
            'label' => 'Metric 1 Value',
            'name' => 'hero_stat1_value',
            'type' => 'text',
            'default_value' => '₹450Cr+',
            'wrapper' => array( 'width' => '50' ),
        ),
        array(
            'key' => 'field_hero_stat1_label',
            'label' => 'Metric 1 Label',
            'name' => 'hero_stat1_label',
            'type' => 'text',
            'default_value' => 'Client Revenue',
            'wrapper' => array( 'width' => '50' ),
        ),
        array(
            'key' => 'field_hero_stat2_value',
            'label' => 'Metric 2 Value',
            'name' => 'hero_stat2_value',
            'type' => 'text',
            'default_value' => '98.4%',
            'wrapper' => array( 'width' => '50' ),
        ),
        array(
            'key' => 'field_hero_stat2_label',
            'label' => 'Metric 2 Label',
            'name' => 'hero_stat2_label',
            'type' => 'text',
            'default_value' => 'Client Retention',
            'wrapper' => array( 'width' => '50' ),
        ),
        array(
            'key' => 'field_hero_stat3_value',
            'label' => 'Metric 3 Value',
            'name' => 'hero_stat3_value',
            'type' => 'text',
            'default_value' => '3 Studios',
            'wrapper' => array( 'width' => '50' ),
        ),
        array(
            'key' => 'field_hero_stat3_label',
            'label' => 'Metric 3 Label',
            'name' => 'hero_stat3_label',
            'type' => 'text',
            'default_value' => 'Ahmedabad • Delhi • USA',
            'wrapper' => array( 'width' => '50' ),
        ),
        array(
            'key' => 'field_hero_stat4_value',
            'label' => 'Metric 4 Value',
            'name' => 'hero_stat4_value',
            'type' => 'text',
            'default_value' => '< 1.2s',
            'wrapper' => array( 'width' => '50' ),
        ),
        array(
            'key' => 'field_hero_stat4_label',
            'label' => 'Metric 4 Label',
            'name' => 'hero_stat4_label',
            'type' => 'text',
            'default_value' => 'Core Web Vitals Avg',
            'wrapper' => array( 'width' => '50' ),
        ),

        // Tab 4: Right Showcase Slider (6 Videos)
        array(
            'key' => 'field_tab_hero_slides_video',
            'label' => 'Hero Slider (6 Videos)',
            'type' => 'tab',
        ),
    );

    $default_slides = array(
        1 => array( 'title' => 'Integrated Digital Ecosystems', 'tag' => 'Brand Growth', 'desc' => 'Unified multi-channel media architectures accelerating customer acquisition.', 'video' => '' ),
        2 => array( 'title' => 'Station Satcom: B2B Satellite Telecom', 'tag' => 'Satcom & Marine', 'desc' => 'Global brand repositioning and Next.js portal for maritime connectivity.', 'video' => '' ),
        3 => array( 'title' => 'High-Performance Web & App UI/UX', 'tag' => 'Digital Platforms', 'desc' => 'Next-gen reactive web applications engineered for speed and conversion.', 'video' => '' ),
        4 => array( 'title' => 'Performance Marketing & Lead Engines', 'tag' => 'Demand Gen', 'desc' => 'Data-backed paid performance marketing driving multi-crore qualified pipeline.', 'video' => '' ),
        5 => array( 'title' => 'Executive Visual Identity & 3D Media', 'tag' => 'Visual Design', 'desc' => 'Sensory 3D CGI visuals, motion typography, and executive identity systems.', 'video' => '' ),
        6 => array( 'title' => 'Production Studio & Content Engine', 'tag' => 'Content Production', 'desc' => 'In-house broadcast audio podcast suites and multi-cam capture.', 'video' => '' ),
    );

    for ( $i = 1; $i <= 6; $i++ ) {
        $d = $default_slides[$i];
        $hero_fields[] = array(
            'key' => 'field_slide' . $i . '_video_link',
            'label' => 'Slide ' . $i . ' Video Link (Direct MP4 URL)',
            'name' => 'hero_slide' . $i . '_video_url',
            'type' => 'url',
            'instructions' => 'Paste MP4 video URL for Slide ' . $i . ' (' . $d['title'] . ')',
            'default_value' => $d['video'],
        );
        $hero_fields[] = array(
            'key' => 'field_slide' . $i . '_title',
            'label' => 'Slide ' . $i . ' Title',
            'name' => 'hero_slide' . $i . '_title',
            'type' => 'text',
            'default_value' => $d['title'],
            'wrapper' => array( 'width' => '50' ),
        );
        $hero_fields[] = array(
            'key' => 'field_slide' . $i . '_tag',
            'label' => 'Slide ' . $i . ' Badge / Tag',
            'name' => 'hero_slide' . $i . '_tag',
            'type' => 'text',
            'default_value' => $d['tag'],
            'wrapper' => array( 'width' => '50' ),
        );
        $hero_fields[] = array(
            'key' => 'field_slide' . $i . '_desc',
            'label' => 'Slide ' . $i . ' Description',
            'name' => 'hero_slide' . $i . '_desc',
            'type' => 'textarea',
            'rows' => 2,
            'default_value' => $d['desc'],
        );
    }

    // Tab 5: Featured Projects Section Cards & Image Links
    $hero_fields[] = array(
        'key' => 'field_tab_fp_settings',
        'label' => 'Featured Projects Section (4 Cards)',
        'type' => 'tab',
    );
    $hero_fields[] = array(
        'key' => 'field_fp_badge_text',
        'label' => 'Section Badge',
        'name' => 'fp_badge_text',
        'type' => 'text',
        'default_value' => 'Case Studies',
        'wrapper' => array( 'width' => '50' ),
    );
    $hero_fields[] = array(
        'key' => 'field_fp_title_main',
        'label' => 'Section Main Title',
        'name' => 'fp_title_main',
        'type' => 'text',
        'default_value' => 'Featured Projects',
        'wrapper' => array( 'width' => '50' ),
    );
    $hero_fields[] = array(
        'key' => 'field_fp_description',
        'label' => 'Section Description',
        'name' => 'fp_description',
        'type' => 'textarea',
        'rows' => 2,
        'default_value' => 'Transforming ambitious brands into category leaders with data-driven strategy and precision design.',
    );
    $hero_fields[] = array(
        'key' => 'field_fp_view_all_text',
        'label' => 'View All Button Text',
        'name' => 'fp_view_all_text',
        'type' => 'text',
        'default_value' => 'View All Projects',
        'wrapper' => array( 'width' => '50' ),
    );
    $hero_fields[] = array(
        'key' => 'field_fp_view_all_url',
        'label' => 'View All Button Link',
        'name' => 'fp_view_all_url',
        'type' => 'text',
        'default_value' => '/case-studies/',
        'wrapper' => array( 'width' => '50' ),
    );

    // Card 1: Left Big Featured Card
    $hero_fields[] = array(
        'key' => 'field_fp_c1_msg',
        'label' => '🔲 Card 1: Main Left Featured Card (54% Width)',
        'type' => 'message',
        'message' => 'Configure the primary large showcased card on the left.',
    );
    $hero_fields[] = array(
        'key' => 'field_fp_card1_image_url',
        'label' => 'Card 1 Image Link (URL)',
        'name' => 'fp_card1_image_url',
        'type' => 'url',
        'instructions' => 'Paste direct image URL from WordPress Media Library or external link.',
        'default_value' => 'https://images.unsplash.com/photo-1513694203232-719a280e022f?q=80&w=1200&auto=format&fit=crop',
    );
    $hero_fields[] = array(
        'key' => 'field_fp_card1_video_url',
        'label' => 'Card 1 Video Link (Optional MP4)',
        'name' => 'fp_card1_video_url',
        'type' => 'url',
        'instructions' => 'Optional background MP4 video for Card 1.',
        'default_value' => '',
    );
    $hero_fields[] = array(
        'key' => 'field_fp_card1_badge',
        'label' => 'Card 1 Badge Text',
        'name' => 'fp_card1_badge',
        'type' => 'text',
        'default_value' => 'Featured Project',
        'wrapper' => array( 'width' => '50' ),
    );
    $hero_fields[] = array(
        'key' => 'field_fp_card1_cat',
        'label' => 'Card 1 Category & Client',
        'name' => 'fp_card1_cat',
        'type' => 'text',
        'default_value' => 'Reality • Client: Leoz',
        'wrapper' => array( 'width' => '50' ),
    );
    $hero_fields[] = array(
        'key' => 'field_fp_card1_title',
        'label' => 'Card 1 Title',
        'name' => 'fp_card1_title',
        'type' => 'text',
        'default_value' => 'LEOZ: Art of Ambiance & Architectural Illumination',
    );
    $hero_fields[] = array(
        'key' => 'field_fp_card1_desc',
        'label' => 'Card 1 Description',
        'name' => 'fp_card1_desc',
        'type' => 'textarea',
        'rows' => 2,
        'default_value' => 'Sensory ambient lighting catalogs, 3D architectural illumination renders, and high-end interior designer partnerships.',
    );
    $hero_fields[] = array(
        'key' => 'field_fp_card1_url',
        'label' => 'Card 1 Target Link',
        'name' => 'fp_card1_url',
        'type' => 'text',
        'default_value' => '/case-studies/leoz/',
    );

    // Card 2: Right Top Card
    $hero_fields[] = array(
        'key' => 'field_fp_c2_msg',
        'label' => '🔲 Card 2: Right Stacked Top Card',
        'type' => 'message',
        'message' => 'Configure the top card in the right column.',
    );
    $hero_fields[] = array(
        'key' => 'field_fp_card2_image_url',
        'label' => 'Card 2 Image Link (URL)',
        'name' => 'fp_card2_image_url',
        'type' => 'url',
        'default_value' => 'https://images.unsplash.com/photo-1541872703-74c5e44368f9?q=80&w=800&auto=format&fit=crop',
    );
    $hero_fields[] = array(
        'key' => 'field_fp_card2_cat',
        'label' => 'Card 2 Category & Client',
        'name' => 'fp_card2_cat',
        'type' => 'text',
        'default_value' => 'Public Policy • Client: Ananta Aspen Centre',
        'wrapper' => array( 'width' => '50' ),
    );
    $hero_fields[] = array(
        'key' => 'field_fp_card2_title',
        'label' => 'Card 2 Title',
        'name' => 'fp_card2_title',
        'type' => 'text',
        'default_value' => 'Ananta Aspen Centre: High-Level Track-II Diplomacy & Leadership',
        'wrapper' => array( 'width' => '50' ),
    );
    $hero_fields[] = array(
        'key' => 'field_fp_card2_desc',
        'label' => 'Card 2 Description',
        'name' => 'fp_card2_desc',
        'type' => 'textarea',
        'rows' => 2,
        'default_value' => 'International bilateral summit digital stage graphics, track-two diplomacy identity, and policy research monographs.',
    );
    $hero_fields[] = array(
        'key' => 'field_fp_card2_url',
        'label' => 'Card 2 Target Link',
        'name' => 'fp_card2_url',
        'type' => 'text',
        'default_value' => '/case-studies/ananta-centre-aspen/',
    );

    // Card 3: Right Middle Card
    $hero_fields[] = array(
        'key' => 'field_fp_c3_msg',
        'label' => '🔲 Card 3: Right Stacked Middle Card',
        'type' => 'message',
        'message' => 'Configure the middle card in the right column.',
    );
    $hero_fields[] = array(
        'key' => 'field_fp_card3_image_url',
        'label' => 'Card 3 Image Link (URL)',
        'name' => 'fp_card3_image_url',
        'type' => 'url',
        'default_value' => 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?q=80&w=800&auto=format&fit=crop',
    );
    $hero_fields[] = array(
        'key' => 'field_fp_card3_cat',
        'label' => 'Card 3 Category & Client',
        'name' => 'fp_card3_cat',
        'type' => 'text',
        'default_value' => 'Education • Client: Chaitanya School Gandhinagar',
        'wrapper' => array( 'width' => '50' ),
    );
    $hero_fields[] = array(
        'key' => 'field_fp_card3_title',
        'label' => 'Card 3 Title',
        'name' => 'fp_card3_title',
        'type' => 'text',
        'default_value' => 'Chaitanya School Gandhinagar: Academic Pedagogy & Campus Admissions',
        'wrapper' => array( 'width' => '50' ),
    );
    $hero_fields[] = array(
        'key' => 'field_fp_card3_desc',
        'label' => 'Card 3 Description',
        'name' => 'fp_card3_desc',
        'type' => 'textarea',
        'rows' => 2,
        'default_value' => 'Campus life documentary cinematography, value-based curriculum branding, and 100% capacity student admissions scaling.',
    );
    $hero_fields[] = array(
        'key' => 'field_fp_card3_url',
        'label' => 'Card 3 Target Link',
        'name' => 'fp_card3_url',
        'type' => 'text',
        'default_value' => '/case-studies/chaitanya-school-gandhinagar/',
    );

    // Card 4: Right Bottom Card
    $hero_fields[] = array(
        'key' => 'field_fp_c4_msg',
        'label' => '🔲 Card 4: Right Stacked Bottom Card',
        'type' => 'message',
        'message' => 'Configure the bottom card in the right column.',
    );
    $hero_fields[] = array(
        'key' => 'field_fp_card4_image_url',
        'label' => 'Card 4 Image Link (URL)',
        'name' => 'fp_card4_image_url',
        'type' => 'url',
        'default_value' => 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?q=80&w=800&auto=format&fit=crop',
    );
    $hero_fields[] = array(
        'key' => 'field_fp_card4_cat',
        'label' => 'Card 4 Category & Client',
        'name' => 'fp_card4_cat',
        'type' => 'text',
        'default_value' => 'Satcom • Client: Station Satcom',
        'wrapper' => array( 'width' => '50' ),
    );
    $hero_fields[] = array(
        'key' => 'field_fp_card4_title',
        'label' => 'Card 4 Title',
        'name' => 'fp_card4_title',
        'type' => 'text',
        'default_value' => 'Station Satcom: B2B Satellite Telecom Modernization',
        'wrapper' => array( 'width' => '50' ),
    );
    $hero_fields[] = array(
        'key' => 'field_fp_card4_desc',
        'label' => 'Card 4 Description',
        'name' => 'fp_card4_desc',
        'type' => 'textarea',
        'rows' => 2,
        'default_value' => 'Global brand repositioning and Next.js portal for maritime, defense, and enterprise satellite connectivity.',
    );
    $hero_fields[] = array(
        'key' => 'field_fp_card4_url',
        'label' => 'Card 4 Target Link',
        'name' => 'fp_card4_url',
        'type' => 'text',
        'default_value' => '/case-studies/station-satcom/',
    );
    // Bottom Callout Bar Settings
    $hero_fields[] = array(
        'key' => 'field_fp_bottom_msg',
        'label' => '🌐 Bottom Callout & CTA Bar',
        'type' => 'message',
        'message' => 'Configure the bottom insights banner and action button.',
    );
    $hero_fields[] = array(
        'key' => 'field_fp_bottom_title',
        'label' => 'Bottom Banner Tagline',
        'name' => 'fp_bottom_title',
        'type' => 'text',
        'default_value' => 'Stay informed. Stay ahead.',
        'wrapper' => array( 'width' => '50' ),
    );
    $hero_fields[] = array(
        'key' => 'field_fp_bottom_subtitle',
        'label' => 'Bottom Banner Subtitle',
        'name' => 'fp_bottom_subtitle',
        'type' => 'textarea',
        'rows' => 2,
        'default_value' => 'Curated insights and expert analysis to help you navigate change and lead with confidence.',
    );
    $hero_fields[] = array(
        'key' => 'field_fp_bottom_btn_text',
        'label' => 'Bottom Button Text',
        'name' => 'fp_bottom_btn_text',
        'type' => 'text',
        'default_value' => 'Check All Case Studies',
        'wrapper' => array( 'width' => '50' ),
    );
    $hero_fields[] = array(
        'key' => 'field_fp_bottom_btn_url',
        'label' => 'Bottom Button Link',
        'name' => 'fp_bottom_btn_url',
        'type' => 'text',
        'default_value' => '/case-studies/',
        'wrapper' => array( 'width' => '50' ),
    );

    acf_add_local_field_group( array(
        'key' => 'group_ci360_hero_settings',
        'title' => 'CI360: Theme & Homepage Section Settings',
        'fields' => $hero_fields,
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

    // -------------------------------------------------------------
    // 3.2 CASE STUDY CPT METABOX (ACF Field Group)
    // -------------------------------------------------------------
    acf_add_local_field_group( array(
        'key' => 'group_ci360_case_study_metabox',
        'title' => 'Case Study Showcase & Meta Settings',
        'fields' => array(
            array(
                'key' => 'field_cs_is_featured',
                'label' => '⭐ Feature as Primary Big Card',
                'name' => 'is_featured_project',
                'type' => 'true_false',
                'instructions' => 'Enable to display this case study as the main left 54% featured card on homepage.',
                'ui' => 1,
                'default_value' => 0,
            ),
            array(
                'key' => 'field_cs_image_url',
                'label' => 'Project Image Link (URL)',
                'name' => 'project_image_url',
                'type' => 'url',
                'instructions' => 'Paste direct image URL (e.g. from Media Library). Overrides featured image if set.',
            ),
            array(
                'key' => 'field_cs_video_url',
                'label' => 'Direct Video Link (Optional MP4)',
                'name' => 'project_video_url',
                'type' => 'url',
                'instructions' => 'Direct link to an MP4 video (optional background preview).',
            ),
            array(
                'key' => 'field_cs_client_name',
                'label' => 'Client / Brand Name',
                'name' => 'client_name',
                'type' => 'text',
                'instructions' => 'e.g. Leoz, Ananta Aspen Centre, Station Satcom',
                'wrapper' => array( 'width' => '50' ),
            ),
            array(
                'key' => 'field_cs_card_tagline',
                'label' => 'Project Subtitle / Tagline',
                'name' => 'card_tagline',
                'type' => 'text',
                'instructions' => 'e.g. Art of Ambiance & Architectural Illumination',
                'wrapper' => array( 'width' => '50' ),
            ),
            array(
                'key' => 'field_cs_card_summary',
                'label' => 'Card Summary (Homepage Excerpt)',
                'name' => 'card_summary',
                'type' => 'textarea',
                'rows' => 3,
                'instructions' => 'Short 2-line summary shown on the project card.',
            ),
            array(
                'key' => 'field_cs_custom_url',
                'label' => 'Custom Target URL (Optional)',
                'name' => 'custom_case_study_url',
                'type' => 'url',
                'instructions' => 'Leave blank to link to standard case study single post URL.',
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
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
    ) );
}

// =========================================================================
// 4. NATIVE WORDPRESS FALLBACK METABOX FOR CASE STUDIES
// =========================================================================
add_action( 'add_meta_boxes', 'ci360_register_native_case_study_metabox' );
add_action( 'save_post_case_study', 'ci360_save_native_case_study_metabox' );

function ci360_register_native_case_study_metabox() {
    add_meta_box(
        'ci360_case_study_meta_box',
        __( 'CI360 Case Study Showcase Details', 'hello-elementor-child-ci360-acf' ),
        'ci360_render_native_case_study_metabox',
        'case_study',
        'normal',
        'high'
    );
}

function ci360_render_native_case_study_metabox( $post ) {
    wp_nonce_field( 'ci360_case_study_nonce_action', 'ci360_case_study_nonce' );

    $image_url      = get_post_meta( $post->ID, 'project_image_url', true );
    $video_url      = get_post_meta( $post->ID, 'project_video_url', true );
    $client_name    = get_post_meta( $post->ID, 'client_name', true );
    $card_tagline   = get_post_meta( $post->ID, 'card_tagline', true );
    $card_summary   = get_post_meta( $post->ID, 'card_summary', true );
    $custom_url     = get_post_meta( $post->ID, 'custom_case_study_url', true );
    $is_featured    = get_post_meta( $post->ID, 'is_featured_project', true );
    ?>
    <style>
        .ci360-mb-row { margin-bottom: 15px; }
        .ci360-mb-row label { display: block; font-weight: 600; margin-bottom: 5px; }
        .ci360-mb-row input[type="text"], .ci360-mb-row input[type="url"], .ci360-mb-row textarea { width: 100%; max-width: 600px; }
        .ci360-mb-grid { display: flex; gap: 20px; flex-wrap: wrap; }
        .ci360-mb-col { flex: 1; min-width: 260px; }
    </style>
    <div class="ci360-metabox-wrap">
        <div class="ci360-mb-row">
            <label>
                <input type="checkbox" name="is_featured_project" value="1" <?php checked( $is_featured, '1' ); ?>>
                <strong>⭐ Feature as Primary Big Card on Homepage</strong>
            </label>
        </div>
        <div class="ci360-mb-grid">
            <div class="ci360-mb-col">
                <div class="ci360-mb-row">
                    <label for="project_image_url">Project Image Link (URL):</label>
                    <input type="url" id="project_image_url" name="project_image_url" value="<?php echo esc_url( $image_url ); ?>" placeholder="https://.../image.jpg">
                </div>
            </div>
            <div class="ci360-mb-col">
                <div class="ci360-mb-row">
                    <label for="project_video_url">Direct Video Link (MP4 URL):</label>
                    <input type="url" id="project_video_url" name="project_video_url" value="<?php echo esc_url( $video_url ); ?>" placeholder="https://.../video.mp4">
                </div>
            </div>
        </div>
        <div class="ci360-mb-grid">
            <div class="ci360-mb-col">
                <div class="ci360-mb-row">
                    <label for="client_name">Client / Brand Name:</label>
                    <input type="text" id="client_name" name="client_name" value="<?php echo esc_attr( $client_name ); ?>" placeholder="e.g. Leoz">
                </div>
            </div>
            <div class="ci360-mb-col">
                <div class="ci360-mb-row">
                    <label for="card_tagline">Project Subtitle / Tagline:</label>
                    <input type="text" id="card_tagline" name="card_tagline" value="<?php echo esc_attr( $card_tagline ); ?>" placeholder="e.g. Art of Ambiance">
                </div>
            </div>
        </div>
        <div class="ci360-mb-row">
            <label for="card_summary">Card Short Summary:</label>
            <textarea id="card_summary" name="card_summary" rows="3" placeholder="Brief 2-line summary..."><?php echo esc_textarea( $card_summary ); ?></textarea>
        </div>
        <div class="ci360-mb-row">
            <label for="custom_case_study_url">Custom Target URL (Optional):</label>
            <input type="url" id="custom_case_study_url" name="custom_case_study_url" value="<?php echo esc_url( $custom_url ); ?>" placeholder="https://...">
        </div>
    </div>
    <?php
}

function ci360_save_native_case_study_metabox( $post_id ) {
    if ( ! isset( $_POST['ci360_case_study_nonce'] ) || ! wp_verify_nonce( $_POST['ci360_case_study_nonce'], 'ci360_case_study_nonce_action' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    $fields = array( 'project_image_url', 'project_video_url', 'client_name', 'card_tagline', 'card_summary', 'custom_case_study_url' );
    foreach ( $fields as $field ) {
        if ( isset( $_POST[$field] ) ) {
            update_post_meta( $post_id, $field, sanitize_text_field( $_POST[$field] ) );
        }
    }

    $is_featured = isset( $_POST['is_featured_project'] ) ? '1' : '0';
    update_post_meta( $post_id, 'is_featured_project', $is_featured );
}
