<?php
/**
 * ACF Field Groups Registration
 * Automatically registers ACF fields in WordPress admin for Front Page / Home Template.
 *
 * @package HelloElementorChildCI360ACF
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'acf/init', 'ci360_acf_register_hero_fields' );

function ci360_acf_register_hero_fields() {
    if ( ! function_exists( 'acf_add_local_field_group' ) ) {
        return;
    }

    acf_add_local_field_group( array(
        'key' => 'group_ci360_hero_settings',
        'title' => 'Home Page: Hero Section Settings (CI360)',
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
                'instructions' => 'Top pill badge text shown above the headline.',
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
