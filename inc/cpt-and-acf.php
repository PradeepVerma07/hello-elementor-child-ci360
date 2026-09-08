<?php
/**
 * Custom Post Types (CPT), Taxonomies, ACF Field Groups & Meta Boxes
 * Includes Hero Settings, Case Studies Meta Box, and Featured Projects Section.
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
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'page-attributes' ),
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
        'rewrite'            => array( 'slug' => 'case-study-sector' ),
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
// 3. REGISTER ACF FIELD GROUPS (Hero, Showcase Videos, Featured Projects, CPT)
// =========================================================================
add_action( 'acf/init', 'ci360_acf_register_all_local_fields' );

function ci360_acf_register_all_local_fields() {
    if ( ! function_exists( 'acf_add_local_field_group' ) ) {
        return;
    }

    // -------------------------------------------------------------
    // 3.1 HERO & THEME SETTINGS FIELD GROUP
    // -------------------------------------------------------------
    $hero_fields = array(
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
            'label' => 'Hero Description Paragraph',
            'name' => 'hero_description',
            'type' => 'textarea',
            'rows' => 3,
            'default_value' => 'CI360 Degrees is an integrated digital marketing and strategic communication agency helping businesses transform ideas into impactful brand experiences and measurable growth.',
        ),

        // Tab 2: CTA Buttons
        array(
            'key' => 'field_tab_hero_ctas',
            'label' => 'Call To Action Buttons',
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

        // Tab 3: Live Stats
        array(
            'key' => 'field_tab_hero_stats',
            'label' => 'Live Metrics & Badges',
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
            'label' => 'Right Showcase Slider (6 Videos)',
            'type' => 'tab',
        ),
    );

    $default_slides = array(
        1 => array(
            'title' => 'Integrated Digital Ecosystems',
            'tag'   => 'Brand Growth',
            'desc'  => 'Unified multi-channel media architectures accelerating customer acquisition and retention.',
            'video' => '',
        ),
        2 => array(
            'title' => 'Station Satcom: B2B Satellite Telecom',
            'tag'   => 'Satcom & Marine',
            'desc'  => 'Global brand repositioning and Next.js portal for maritime, defense, and enterprise satellite connectivity.',
            'video' => '',
        ),
        3 => array(
            'title' => 'High-Performance Web & App UI/UX',
            'tag'   => 'Digital Platforms',
            'desc'  => 'Next-gen reactive web applications engineered for speed, conversion, and global accessibility.',
            'video' => '',
        ),
        4 => array(
            'title' => 'Performance Marketing & Lead Engines',
            'tag'   => 'Demand Gen',
            'desc'  => 'Data-backed paid performance marketing driving multi-crore qualified pipeline.',
            'video' => '',
        ),
        5 => array(
            'title' => 'Executive Visual Identity & 3D Media',
            'tag'   => 'Visual Design',
            'desc'  => 'Sensory 3D CGI visuals, motion typography, and executive identity systems.',
            'video' => '',
        ),
        6 => array(
            'title' => 'Production Studio & Content Engine',
            'tag'   => 'Content Production',
            'desc'  => 'In-house broadcast audio podcast suites, multi-cam capture, and transatlantic live bridges.',
            'video' => '',
        ),
    );

    for ( $i = 1; $i <= 6; $i++ ) {
        $d = $default_slides[$i];
        $hero_fields[] = array(
            'key' => 'field_slide' . $i . '_heading_msg',
            'label' => '▶ Slide ' . $i . ' (' . $d['title'] . ')',
            'type' => 'message',
            'message' => 'Configure Video Link and details for Showcase Slide ' . $i,
        );
        $hero_fields[] = array(
            'key' => 'field_slide' . $i . '_video_link',
            'label' => 'Slide ' . $i . ' Video Link (Direct MP4 URL)',
            'name' => 'hero_slide' . $i . '_video_url',
            'type' => 'url',
            'instructions' => 'Paste your direct MP4 video link here (e.g. https://.../video.mp4)',
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

    // Tab 5: Featured Projects Section Settings
    $hero_fields[] = array(
        'key' => 'field_tab_fp_settings',
        'label' => 'Featured Projects Section',
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
                'instructions' => 'Enable this to display this case study as the main left 54% featured card on the homepage.',
                'ui' => 1,
                'default_value' => 0,
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
                'key' => 'field_cs_video_url',
                'label' => 'Direct Video Link (Optional MP4)',
                'name' => 'project_video_url',
                'type' => 'url',
                'instructions' => 'Direct link to an MP4 video (optional background preview).',
                'wrapper' => array( 'width' => '50' ),
            ),
            array(
                'key' => 'field_cs_custom_url',
                'label' => 'Custom Target URL (Optional)',
                'name' => 'custom_case_study_url',
                'type' => 'url',
                'instructions' => 'Leave blank to link to standard case study single post URL.',
                'wrapper' => array( 'width' => '50' ),
            ),
            array(
                'key' => 'field_cs_metric1_val',
                'label' => 'Key Metric 1 Value',
                'name' => 'stat1_value',
                'type' => 'text',
                'instructions' => 'e.g. +340%',
                'wrapper' => array( 'width' => '25' ),
            ),
            array(
                'key' => 'field_cs_metric1_lbl',
                'label' => 'Key Metric 1 Label',
                'name' => 'stat1_label',
                'type' => 'text',
                'instructions' => 'e.g. Pipeline Velocity',
                'wrapper' => array( 'width' => '25' ),
            ),
            array(
                'key' => 'field_cs_metric2_val',
                'label' => 'Key Metric 2 Value',
                'name' => 'stat2_value',
                'type' => 'text',
                'instructions' => 'e.g. 98.4%',
                'wrapper' => array( 'width' => '25' ),
            ),
            array(
                'key' => 'field_cs_metric2_lbl',
                'label' => 'Key Metric 2 Label',
                'name' => 'stat2_label',
                'type' => 'text',
                'instructions' => 'e.g. Client Retention',
                'wrapper' => array( 'width' => '25' ),
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
// (Ensures fields work even if ACF plugin is deactivated)
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

    $client_name    = get_post_meta( $post->ID, 'client_name', true );
    $card_tagline   = get_post_meta( $post->ID, 'card_tagline', true );
    $card_summary   = get_post_meta( $post->ID, 'card_summary', true );
    $video_url      = get_post_meta( $post->ID, 'project_video_url', true );
    $custom_url     = get_post_meta( $post->ID, 'custom_case_study_url', true );
    $is_featured    = get_post_meta( $post->ID, 'is_featured_project', true );
    $stat1_val      = get_post_meta( $post->ID, 'stat1_value', true );
    $stat1_lbl      = get_post_meta( $post->ID, 'stat1_label', true );
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
        <div class="ci360-mb-grid">
            <div class="ci360-mb-col">
                <div class="ci360-mb-row">
                    <label for="project_video_url">Direct Video Link (MP4 URL):</label>
                    <input type="url" id="project_video_url" name="project_video_url" value="<?php echo esc_url( $video_url ); ?>" placeholder="https://.../video.mp4">
                </div>
            </div>
            <div class="ci360-mb-col">
                <div class="ci360-mb-row">
                    <label for="custom_case_study_url">Custom Target URL (Optional):</label>
                    <input type="url" id="custom_case_study_url" name="custom_case_study_url" value="<?php echo esc_url( $custom_url ); ?>" placeholder="https://...">
                </div>
            </div>
        </div>
        <div class="ci360-mb-grid">
            <div class="ci360-mb-col">
                <div class="ci360-mb-row">
                    <label for="stat1_value">Key Impact Stat Value:</label>
                    <input type="text" id="stat1_value" name="stat1_value" value="<?php echo esc_attr( $stat1_val ); ?>" placeholder="e.g. +340% ROI">
                </div>
            </div>
            <div class="ci360-mb-col">
                <div class="ci360-mb-row">
                    <label for="stat1_label">Key Impact Stat Label:</label>
                    <input type="text" id="stat1_label" name="stat1_label" value="<?php echo esc_attr( $stat1_lbl ); ?>" placeholder="e.g. Revenue Growth">
                </div>
            </div>
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

    $fields = array( 'client_name', 'card_tagline', 'card_summary', 'project_video_url', 'custom_case_study_url', 'stat1_value', 'stat1_label' );
    foreach ( $fields as $field ) {
        if ( isset( $_POST[$field] ) ) {
            update_post_meta( $post_id, $field, sanitize_text_field( $_POST[$field] ) );
        }
    }

    $is_featured = isset( $_POST['is_featured_project'] ) ? '1' : '0';
    update_post_meta( $post_id, 'is_featured_project', $is_featured );
}
