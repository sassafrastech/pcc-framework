<?php

namespace PCCFramework\PostTypes\Project;

use function PCCFramework\PostTypes\Person\get_people;

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
    register_post_meta('pcc-project', 'pcc_project_test', [
        'show_in_rest' => true,
        'single' => true,
        'type' => 'integer',
    ]);
}

/**
 * Registers the Post Data metabox and meta fields.
 *
 * @return null
 */
function data()
{
    $prefix = 'pcc_project_';

    $cmb = new_cmb2_box([
        'id'            => 'project_data',
        'title'         => __('Project Data', 'pcc-framework'),
        'object_types'  => ['pcc-project'],
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true,
    ]);

    $cmb ->add_field([
        'name' => __('Researchers', 'pcc-framework'),
        'desc' => '',
        'id'   => $prefix . 'researchers',
        'type' => 'select',
        'show_option_none' => true,
        'options' => get_people(),
        'repeatable' => true,
        'text' => [
            'add_row_text' => __('Add Researcher', 'pcc-framework'),
        ]
    ]);
}
