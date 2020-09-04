<?php

namespace PCCFramework\Settings;

/**
 * Register Configuration settings page and meta fields.
 */
function configuration()
{
    $cmb = new_cmb2_box([
        'id' => 'platformcoop_configuration',
        'title' => __('Site Configuration', 'pcc-framework'),
        'menu_title' => __('Configuration', 'pcc-framework'),
        'object_types' => ['options-page'],
        'option_key' => 'platformcoop_configuration',
        'capability' => 'manage_options',
    ]);
    $cmb->add_field([
        'name' => __('Donate Link', 'pcc-framework'),
        'desc' =>
            __(
                'Link to external donation form (used in site footer and some page templates).',
                'pcc-framework'
            ),
        'id' => 'donate_link',
        'type' => 'text_url',
        'default' =>
            'https://go.newschool.edu/s/1811/17/interior.aspx?sid=1811&gid=2&pgid=537&cid=1698&dids=34&bledit=1',
    ]);
    $cmb->add_field([
        'name' => __('Newsletter Signup Link', 'pcc-framework'),
        'desc' =>
            __(
                'Link to external newsletter signup form (used in site footer and some page templates).',
                'pcc-framework'
            ),
        'id' => 'signup_link',
        'type' => 'text_url',
        'default' => 'https://mailchi.mp/platform/coop',
    ]);
}

/**
 * Register Configuration settings page and meta fields.
 */
function localization()
{
    $cmb = new_cmb2_box([
        'id' => 'platformcoop_localization',
        'title' => __('Localization', 'pcc-framework'),
        'menu_title' => __('Localization', 'pcc-framework'),
        'object_types' => ['options-page'],
        'option_key' => 'platformcoop_localization',
        'position' => 95,
        'icon_url'   => 'dashicons-admin-site-alt3',
        'capability' => 'manage_options',
    ]);

    $langs = [];

    if (function_exists('pll_languages_list')) {
        $slugs = pll_languages_list(['hide_empty' => 1]);
        $names = pll_languages_list(['hide_empty' => 1, 'fields' => 'name']);
        foreach ($slugs as $k => $slug) {
            if ($slug !== 'en') {
                $langs[$slug] = $names[$k];
            }
        }
    }

    asort($langs);

    $cmb->add_field([
        'name' => __('Localization Settings', 'pcc-framework'),
        'desc' =>
            __(
                'Select the languages you’d like to be displayed to site visitors. English content will always be displayed.', // @codingStandardsIgnoreLine
                'pcc-framework'
            ),
        'id' => 'enabled_languages',
        'type'    => 'multicheck',
        'options' => $langs
    ]);
}
