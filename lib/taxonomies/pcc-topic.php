<?php

namespace PCCFramework\Taxonomies\Topic;

/**
 * Registers the `pcc_topic` taxonomy,
 * for use with 'pcc-person', 'pcc-resource', and 'post'.
 */
function init()
{
    register_extended_taxonomy(
        'pcc-topic',
        [
            'pcc-person',
            'post'
        ],
        [
            'hierarchical' => false,
            'show_in_rest' => true,
        ],
        [
            'singular' => __('Topic', 'pcc-framework'),
            'plural'   => __('Topics', 'pcc-framework'),
            'slug'     => __('topic', 'pcc-framework'),
        ]
    );
}
