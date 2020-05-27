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
            'menu_icon' => 'dashicons-calendar-alt',
            'menu_position' => 24,
            'show_in_rest' => true,
            'supports' => ['title', 'editor', 'page-attributes', 'custom-fields', 'thumbnail'],
            'taxonomies' => ['post_tag', 'pcc-role'],
        ],
        [
            'singular' => __('Project', 'pcc-framework'),
            'plural' => __('Projects', 'pcc-framework'),
            'slug' => 'project'
        ]
    );
}

/**
 * Registers meta fields for the `pcc-event` post type.
 *
 * @return null
 */
function register_meta() {
  register_post_meta('pcc-project', 'pcc_people', [
      'show_in_rest' => true,
      'single' => true,
      'type' => 'string',
  ]);
}

/**
 * Registers the Event Data metabox and meta fields.
 *
 * @return null
 */
function data() {
  $cmb = new_cmb2_box([
      'id'            => 'project_data',
      'title'         => __('Project', 'pcc-framework'),
      'object_types'  => ['pcc-project'],
      'context'       => 'normal',
      'priority'      => 'high',
      'show_names'    => true,
  ]);

  $cmb->add_field([
      'name' => __('People', 'pcc-framework'),
      'desc' =>
          'People and researchers will be shown on the project\'s page',
      'id'   => $prefix . 'pcc_people',
      'type' => 'select',
      'show_option_none' => true,
      'options' => get_people(),
      'repeatable' => true,
      'text' => [
          'add_row_text' => __('Add Person', 'pcc-framework'),
      ]
  ]);

  $cmb->add_field([
      'name' => __('Participants', 'pcc-framework'),
      'desc' =>
          'Participants will be shown alphabetically on the participants page.',
      'id'   => $prefix . 'participants',
      'type' => 'select',
      'show_option_none' => true,
      'options' => get_people(),
      'repeatable' => true,
      'text' => [
          'add_row_text' => __('Add Participant', 'pcc-framework'),
      ]
  ]);
}
