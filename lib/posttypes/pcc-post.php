<?php

namespace PCCFramework\PostTypes\Post;

/**
 * Registers meta for the the `pcc-person` post type.
 */
function register_meta()
{
    register_post_meta('post', 'pcc_post_authors', [
        'type' => 'integer',
        'description' => 'The IDs of the people who authored this post.',
        'single' => false,
        'show_in_rest' => true,
    ]);
}

/**
 * Registers the Post Data metabox and meta fields.
 *
 * @return null
 */
function data()
{
    $people = get_posts(['post_type' => 'pcc-person', 'numberposts' => -1]);
    $options = [];
    foreach ($people as $person) {
        $options[$person->ID] = $person->post_title;
    }
    asort($options);

    $prefix = 'pcc_post_';

    $cmb = new_cmb2_box([
        'id'            => 'post_data',
        'title'         => __('Post Data', 'pcc-framework'),
        'object_types'  => ['post'],
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true,
    ]);

    $cmb->add_field([
        'name' => __('Post Author', 'pcc-framework'),
        'id'   => $prefix . 'authors',
        'type' => 'select',
        'show_option_none' => true,
        'options'          => $options,
        'description' =>
            __('The author of this post (use this if they do not have a WordPress account).', 'pcc-framework'),
    ]);
}
