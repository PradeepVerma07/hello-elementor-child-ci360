<?php
/**
 * Custom Post Types (CPT), Taxonomies, ACF Field Groups & Meta Boxes
 * Robust and compatible with PHP 7.4 through PHP 8.3+
 *
 * @package HelloElementorChildCI360ACF
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// =========================================================================
// 1. REGISTER CUSTOM POST TYPES & TAXONOMIES
// =========================================================================
if ( ! function_exists( 'ci360_register_custom_post_types_and_taxonomies' ) ) {
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
}
add_action( 'init', 'ci360_register_custom_post_types_and_taxonomies' );

// =========================================================================
// 2. REGISTER ACF OPTIONS PAGE
// =========================================================================
if ( ! function_exists( 'ci360_register_acf_options_page' ) ) {
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
}
add_action( 'acf/init', 'ci360_register_acf_options_page' );

// =========================================================================
// 3. REGISTER ACF FIELD GROUPS
// =========================================================================
if ( ! function_exists( 'ci360_acf_register_all_local_fields' ) ) {
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
            'key' => 'field_fp_card1_image_url',
            'label' => 'Card 1 Image Link (URL)',
            'name' => 'fp_card1_image_url',
            'type' => 'url',
            'default_value' => 'https://images.unsplash.com/photo-1513694203232-719a280e022f?q=80&w=1200&auto=format&fit=crop',
        );
        $hero_fields[] = array(
            'key' => 'field_fp_card1_video_url',
            'label' => 'Card 1 Video Link (Optional MP4)',
            'name' => 'fp_card1_video_url',
            'type' => 'url',
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

        // Card 2
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

        // Card 3
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

        // Card 4
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

        // Bottom Callout
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

        // Tab 6: Foundational Pillars
        $hero_fields[] = array(
            'key' => 'field_tab_pillars_settings',
            'label' => 'Foundational Pillars (Vision, Mission, Values)',
            'type' => 'tab',
        );
        $hero_fields[] = array(
            'key' => 'field_pillars_badge_text',
            'label' => 'Pillars Top Badge',
            'name' => 'pillars_badge_text',
            'type' => 'text',
            'default_value' => 'Foundational Pillars',
            'wrapper' => array( 'width' => '50' ),
        );
        $hero_fields[] = array(
            'key' => 'field_pillars_title_text',
            'label' => 'Pillars Section Title',
            'name' => 'pillars_title_text',
            'type' => 'text',
            'default_value' => 'Vision. Mission. Values.',
            'wrapper' => array( 'width' => '50' ),
        );
        $hero_fields[] = array(
            'key' => 'field_pillars_description',
            'label' => 'Pillars Subtitle / Description',
            'name' => 'pillars_description',
            'type' => 'textarea',
            'rows' => 2,
            'default_value' => 'The foundational compass guiding our culture, client partnerships, and creative rigor.',
        );
        $hero_fields[] = array(
            'key' => 'field_p1_title',
            'label' => 'Pillar 1 Title',
            'name' => 'p1_title',
            'type' => 'text',
            'default_value' => 'Our Vision',
            'wrapper' => array( 'width' => '33' ),
        );
        $hero_fields[] = array(
            'key' => 'field_p1_subtitle',
            'label' => 'Pillar 1 Tagline',
            'name' => 'p1_subtitle',
            'type' => 'text',
            'default_value' => 'Architecting Tomorrow\'s Brand Ecosystems',
            'wrapper' => array( 'width' => '33' ),
        );
        $hero_fields[] = array(
            'key' => 'field_p1_tag',
            'label' => 'Pillar 1 Badge',
            'name' => 'p1_tag',
            'type' => 'text',
            'default_value' => 'Pillar 01',
            'wrapper' => array( 'width' => '33' ),
        );
        $hero_fields[] = array(
            'key' => 'field_p1_desc',
            'label' => 'Pillar 1 Description',
            'name' => 'p1_description',
            'type' => 'textarea',
            'rows' => 2,
            'default_value' => 'To be the premier global catalyst where visionary thinking, generative intelligence, and sensory storytelling converge to redefine how enterprises connect with humanity.',
        );

        $hero_fields[] = array(
            'key' => 'field_p2_title',
            'label' => 'Pillar 2 Title',
            'name' => 'p2_title',
            'type' => 'text',
            'default_value' => 'Our Mission',
            'wrapper' => array( 'width' => '33' ),
        );
        $hero_fields[] = array(
            'key' => 'field_p2_subtitle',
            'label' => 'Pillar 2 Tagline',
            'name' => 'p2_subtitle',
            'type' => 'text',
            'default_value' => 'Engineering Measurable Growth & Impact',
            'wrapper' => array( 'width' => '33' ),
        );
        $hero_fields[] = array(
            'key' => 'field_p2_tag',
            'label' => 'Pillar 2 Badge',
            'name' => 'p2_tag',
            'type' => 'text',
            'default_value' => 'Pillar 02',
            'wrapper' => array( 'width' => '33' ),
        );
        $hero_fields[] = array(
            'key' => 'field_p2_desc',
            'label' => 'Pillar 2 Description',
            'name' => 'p2_description',
            'type' => 'textarea',
            'rows' => 2,
            'default_value' => 'Empower transformative brands through precision digital infrastructure, multi-channel marketing velocity, and bespoke brand narratives that convert complexity into clear competitive advantage.',
        );

        $hero_fields[] = array(
            'key' => 'field_p3_title',
            'label' => 'Pillar 3 Title',
            'name' => 'p3_title',
            'type' => 'text',
            'default_value' => 'Core Values',
            'wrapper' => array( 'width' => '33' ),
        );
        $hero_fields[] = array(
            'key' => 'field_p3_subtitle',
            'label' => 'Pillar 3 Tagline',
            'name' => 'p3_subtitle',
            'type' => 'text',
            'default_value' => 'Uncompromising Rigor & Authenticity',
            'wrapper' => array( 'width' => '33' ),
        );
        $hero_fields[] = array(
            'key' => 'field_p3_tag',
            'label' => 'Pillar 3 Badge',
            'name' => 'p3_tag',
            'type' => 'text',
            'default_value' => 'Pillar 03',
            'wrapper' => array( 'width' => '33' ),
        );
        $hero_fields[] = array(
            'key' => 'field_p3_desc',
            'label' => 'Pillar 3 Description',
            'name' => 'p3_description',
            'type' => 'textarea',
            'rows' => 2,
            'default_value' => 'Our work is anchored in deep integrity, relentless craft perfection, radical empathy for user experiences, and enduring long-term client partnership stewardship.',
        );

        // Tab 7: Blog & Insights Page Settings
        
        // Tab 7: Blog Hero & Insights Page Settings
        $hero_fields[] = array(
            'key' => 'field_tab_blog_settings',
            'label' => 'Blog Hero & Query Settings',
            'type' => 'tab',
        );
        $hero_fields[] = array(
            'key' => 'field_blog_hero_badge',
            'label' => 'Blog Hero Top Badge',
            'name' => 'blog_hero_badge',
            'type' => 'text',
            'default_value' => 'Editorial & Strategic Insights',
            'wrapper' => array( 'width' => '50' ),
        );
        $hero_fields[] = array(
            'key' => 'field_blog_hero_title_prefix',
            'label' => 'Hero Title Top Line',
            'name' => 'blog_hero_title_prefix',
            'type' => 'text',
            'default_value' => 'Perspectives That',
            'wrapper' => array( 'width' => '50' ),
        );
        $hero_fields[] = array(
            'key' => 'field_blog_hero_title_highlight',
            'label' => 'Hero Title Highlight (Cyan Gradient)',
            'name' => 'blog_hero_title_highlight',
            'type' => 'text',
            'default_value' => 'Shape The Future',
            'wrapper' => array( 'width' => '50' ),
        );
        $hero_fields[] = array(
            'key' => 'field_blog_hero_title_suffix',
            'label' => 'Hero Title Bottom Line',
            'name' => 'blog_hero_title_suffix',
            'type' => 'text',
            'default_value' => 'of Digital Leadership.',
            'wrapper' => array( 'width' => '50' ),
        );
        $hero_fields[] = array(
            'key' => 'field_blog_hero_description',
            'label' => 'Hero Description Paragraph',
            'name' => 'blog_hero_description',
            'type' => 'textarea',
            'rows' => 3,
            'default_value' => 'Original frameworks, strategic foresight, and deep-dive analysis on digital architecture, brand velocity, and transformative technology.',
        );
        $hero_fields[] = array(
            'key' => 'field_blog_hero_image_url',
            'label' => 'Hero Right Showcase Image Link (URL)',
            'name' => 'blog_hero_image_url',
            'type' => 'url',
            'instructions' => 'Paste image URL for the right-side hero showcase card.',
            'default_value' => 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?q=80&w=1200&auto=format&fit=crop',
        );
        $hero_fields[] = array(
            'key' => 'field_blog_hero_video_url',
            'label' => 'Hero Right Showcase Video Link (Optional MP4)',
            'name' => 'blog_hero_video_url',
            'type' => 'url',
            'default_value' => '',
        );
        $hero_fields[] = array(
            'key' => 'field_blog_hero_card_tag',
            'label' => 'Hero Showcase Badge',
            'name' => 'blog_hero_card_tag',
            'type' => 'text',
            'default_value' => 'Executive Briefing',
            'wrapper' => array( 'width' => '50' ),
        );
        $hero_fields[] = array(
            'key' => 'field_blog_hero_card_title',
            'label' => 'Hero Showcase Card Title',
            'name' => 'blog_hero_card_title',
            'type' => 'text',
            'default_value' => 'Architecting Modern Enterprise Moats in the Age of AI',
            'wrapper' => array( 'width' => '50' ),
        );
        $hero_fields[] = array(
            'key' => 'field_blog_hero_card_desc',
            'label' => 'Hero Showcase Card Subtext',
            'name' => 'blog_hero_card_desc',
            'type' => 'textarea',
            'rows' => 2,
            'default_value' => 'How forward-thinking brands bridge the gap between human storytelling and autonomous digital scale.',
        );
        $hero_fields[] = array(
            'key' => 'field_blog_include_categories',
            'label' => 'Include Specific Categories (Slugs or IDs)',
            'name' => 'blog_include_categories',
            'type' => 'text',
            'instructions' => 'Comma-separated category slugs or IDs to display. Leave blank to show all.',
            'wrapper' => array( 'width' => '50' ),
        );
        $hero_fields[] = array(
            'key' => 'field_blog_exclude_categories',
            'label' => 'Exclude Specific Categories (Slugs or IDs)',
            'name' => 'blog_exclude_categories',
            'type' => 'text',
            'instructions' => 'Comma-separated category slugs to hide.',
            'wrapper' => array( 'width' => '50' ),
        );
        $hero_fields[] = array(
            'key' => 'field_blog_posts_per_page',
            'label' => 'Articles Per Page',
            'name' => 'blog_posts_per_page',
            'type' => 'number',
            'default_value' => 9,
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
                array(
                    array(
                        'param' => 'page_template',
                        'operator' => '==',
                        'value' => 'template-blog.php',
                    ),
                ),
            ),
        ) );

        // 3.2 Case Study CPT Metabox
        acf_add_local_field_group( array(
            'key' => 'group_ci360_case_study_metabox',
            'title' => 'Case Study Showcase & Meta Settings',
            'fields' => array(
                array(
                    'key' => 'field_cs_is_featured',
                    'label' => '⭐ Feature as Primary Big Card',
                    'name' => 'is_featured_project',
                    'type' => 'true_false',
                    'ui' => 1,
                    'default_value' => 0,
                ),
                array(
                    'key' => 'field_cs_image_url',
                    'label' => 'Project Image Link (URL)',
                    'name' => 'project_image_url',
                    'type' => 'url',
                ),
                array(
                    'key' => 'field_cs_video_url',
                    'label' => 'Direct Video Link (Optional MP4)',
                    'name' => 'project_video_url',
                    'type' => 'url',
                ),
                array(
                    'key' => 'field_cs_client_name',
                    'label' => 'Client / Brand Name',
                    'name' => 'client_name',
                    'type' => 'text',
                    'wrapper' => array( 'width' => '50' ),
                ),
                array(
                    'key' => 'field_cs_card_tagline',
                    'label' => 'Project Subtitle / Tagline',
                    'name' => 'card_tagline',
                    'type' => 'text',
                    'wrapper' => array( 'width' => '50' ),
                ),
                array(
                    'key' => 'field_cs_card_summary',
                    'label' => 'Card Summary (Homepage Excerpt)',
                    'name' => 'card_summary',
                    'type' => 'textarea',
                    'rows' => 3,
                ),
                array(
                    'key' => 'field_cs_custom_url',
                    'label' => 'Custom Target URL (Optional)',
                    'name' => 'custom_case_study_url',
                    'type' => 'url',
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
}
add_action( 'acf/init', 'ci360_acf_register_all_local_fields' );

// =========================================================================
// 4. NATIVE WORDPRESS METABOXES (Safe Fallbacks)
// =========================================================================
if ( ! function_exists( 'ci360_register_native_case_study_metabox' ) ) {
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
}
add_action( 'add_meta_boxes', 'ci360_register_native_case_study_metabox' );

if ( ! function_exists( 'ci360_render_native_case_study_metabox' ) ) {
    function ci360_render_native_case_study_metabox( $post ) {
        if ( ! $post ) return;
        wp_nonce_field( 'ci360_case_study_nonce_action', 'ci360_case_study_nonce' );

        $image_url      = get_post_meta( $post->ID, 'project_image_url', true );
        $video_url      = get_post_meta( $post->ID, 'project_video_url', true );
        $client_name    = get_post_meta( $post->ID, 'client_name', true );
        $card_tagline   = get_post_meta( $post->ID, 'card_tagline', true );
        $card_summary   = get_post_meta( $post->ID, 'card_summary', true );
        $custom_url     = get_post_meta( $post->ID, 'custom_case_study_url', true );
        $is_featured    = get_post_meta( $post->ID, 'is_featured_project', true );
        ?>
        <div style="padding: 10px 0;">
            <p><label><input type="checkbox" name="is_featured_project" value="1" <?php checked( $is_featured, '1' ); ?>> <strong>⭐ Feature as Primary Big Card on Homepage</strong></label></p>
            <p><label><strong>Project Image Link:</strong><br><input type="url" name="project_image_url" value="<?php echo esc_url( $image_url ); ?>" style="width:100%; max-width:600px;"></label></p>
            <p><label><strong>Video Link (MP4 URL):</strong><br><input type="url" name="project_video_url" value="<?php echo esc_url( $video_url ); ?>" style="width:100%; max-width:600px;"></label></p>
            <p><label><strong>Client Name:</strong><br><input type="text" name="client_name" value="<?php echo esc_attr( $client_name ); ?>" style="width:100%; max-width:600px;"></label></p>
            <p><label><strong>Card Summary:</strong><br><textarea name="card_summary" rows="3" style="width:100%; max-width:600px;"><?php echo esc_textarea( $card_summary ); ?></textarea></label></p>
            <p><label><strong>Custom Link URL:</strong><br><input type="url" name="custom_case_study_url" value="<?php echo esc_url( $custom_url ); ?>" style="width:100%; max-width:600px;"></label></p>
        </div>
        <?php
    }
}

if ( ! function_exists( 'ci360_save_native_case_study_metabox' ) ) {
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
}
add_action( 'save_post_case_study', 'ci360_save_native_case_study_metabox' );

// 4.2 Native Page Metabox for Blog Include/Exclude
if ( ! function_exists( 'ci360_register_blog_page_metabox' ) ) {
    function ci360_register_blog_page_metabox() {
        add_meta_box(
            'ci360_blog_settings_metabox',
            __( 'CI360 Blog Query & Category Filter Controls', 'hello-elementor-child-ci360-acf' ),
            'ci360_render_blog_page_metabox',
            'page',
            'normal',
            'default'
        );
    }
}
add_action( 'add_meta_boxes', 'ci360_register_blog_page_metabox' );

if ( ! function_exists( 'ci360_render_blog_page_metabox' ) ) {
    function ci360_render_blog_page_metabox( $post ) {
        if ( ! $post ) return;
        wp_nonce_field( 'ci360_blog_nonce_action', 'ci360_blog_nonce' );

        $inc_cats    = get_post_meta( $post->ID, 'blog_include_categories', true );
        $exc_cats    = get_post_meta( $post->ID, 'blog_exclude_categories', true );
        $posts_pp    = get_post_meta( $post->ID, 'blog_posts_per_page', true ) ?: 9;
        $show_feat   = get_post_meta( $post->ID, 'blog_show_featured', true ) ?: '1';
        ?>
        <div style="padding:10px 0;">
            <p style="color:#64748b; font-size:13px;">Manage real blog categories and query settings for this page.</p>
            <p><label><strong>Include Specific Categories (Slugs or IDs):</strong><br><input type="text" name="blog_include_categories" value="<?php echo esc_attr( $inc_cats ); ?>" placeholder="e.g. strategy, technology, design" style="width:100%; max-width:600px;"></label><br><small style="color:#64748b;">Leave blank to include all categories.</small></p>
            <p><label><strong>Exclude Specific Categories (Slugs or IDs):</strong><br><input type="text" name="blog_exclude_categories" value="<?php echo esc_attr( $exc_cats ); ?>" placeholder="e.g. uncategorized, archive" style="width:100%; max-width:600px;"></label></p>
            <p><label><strong>Articles Per Page:</strong> <input type="number" name="blog_posts_per_page" value="<?php echo esc_attr( $posts_pp ); ?>" style="width:80px;"></label></p>
            <p><label><input type="checkbox" name="blog_show_featured" value="1" <?php checked( $show_feat, '1' ); ?>> Display Top Featured Article</label></p>
        </div>
        <?php
    }
}

if ( ! function_exists( 'ci360_save_blog_page_metabox' ) ) {
    function ci360_save_blog_page_metabox( $post_id ) {
        if ( ! isset( $_POST['ci360_blog_nonce'] ) || ! wp_verify_nonce( $_POST['ci360_blog_nonce'], 'ci360_blog_nonce_action' ) ) {
            return;
        }
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }
        if ( ! current_user_can( 'edit_page', $post_id ) ) {
            return;
        }

        $fields = array( 'blog_include_categories', 'blog_exclude_categories', 'blog_posts_per_page' );
        foreach ( $fields as $field ) {
            if ( isset( $_POST[$field] ) ) {
                update_post_meta( $post_id, $field, sanitize_text_field( $_POST[$field] ) );
            }
        }
        $show_feat = isset( $_POST['blog_show_featured'] ) ? '1' : '0';
        update_post_meta( $post_id, 'blog_show_featured', $show_feat );
    }
}
add_action( 'save_post_page', 'ci360_save_blog_page_metabox' );
