<?php

namespace PCCFramework\PostTypes\Project;

/**
 * Registers the `pcc-project` post type.
 *
 * @return null
 */
function init()
{
    register_extended_post_type(
        'pcc-project',
        [
            'has_archive' => false,
            'hierarchical' => true,
            'menu_icon' => 'dashicons-analytics',
            'menu_position' => 24,
            'show_in_rest' => true,
            'supports' => ['title', 'editor', 'page-attributes', 'custom-fields', 'thumbnail'],
            'taxonomies' => ['post_tag'],
        ],
        [
            'singular' => __('Project', 'pcc-framework'),
            'plural' => __('Projects', 'pcc-framework'),
            'slug' => 'projects',
        ]
    );
}

/**
 * Registers meta fields for the `pcc-project` post type.
 *
 * @return null
 */
function register_meta()
{
    // TODO.
}
