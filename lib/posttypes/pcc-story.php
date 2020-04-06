<?php

namespace PCCFramework\PostTypes\Story;

/**
 * Registers the `pcc-story` post type.
 */
function init()
{
    register_extended_post_type(
        'pcc-story',
        [
            'has_archive' => false,
            'menu_icon' => 'dashicons-microphone',
            'menu_position' => 24,
            'show_in_rest' => true,
            'supports' => ['title', 'editor', 'custom-fields', 'thumbnail'],
            'template' => [
                [
                    'core/quote'
                ],
            ],
            'template_lock' => 'all',
            'admin_cols' => [
                'title',
                'topics' => [
                    'title' => __('Topics', 'pcc-framework'),
                    'taxonomy' => 'post_tag',
                ],
                'regions' => [
                    'title' => __('Regions', 'pcc-framework'),
                    'taxonomy' => 'pcc-region',
                ],
            ],
            'taxonomies' => ['post_tag'],
        ],
        [
            'singular' => __('Story', 'pcc-framework'),
            'plural' => __('Stories', 'pcc-framework'),
            'slug' => 'stories',
        ]
    );
}

/**
 * Registers meta fields for the `pcc-voice` post type.
 *
 * @return null
 */
function register_meta()
{
    register_post_meta('pcc-story', 'pcc_story_organization', [
        'show_in_rest' => true,
        'single' => true,
        'type' => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'auth_callback' => function () {
            return current_user_can('edit_posts');
        }
    ]);

    register_post_meta('pcc-story', 'pcc_story_video_link', [
        'show_in_rest' => true,
        'single' => true,
        'type' => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'auth_callback' => function () {
            return current_user_can('edit_posts');
        }
    ]);
}
