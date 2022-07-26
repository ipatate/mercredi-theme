<?php

namespace Goodmotion\inc\gutenberg\settings;


/**
 * gutenberg settings
 */
function gutenberg_settings()
{
    add_theme_support('editor-font-sizes', array(
        array(
            'name' => __('x-small', 'mercredi-theme'),
            'shortName' => __('XS', 'mercredi-theme'),
            'size' => '0.75rem',
            'slug' => 'x-small'
        ),
        array(
            'name' => __('small', 'mercredi-theme'),
            'shortName' => __('S', 'mercredi-theme'),
            'size' => '0.875rem',
            'slug' => 'small'
        ),
        array(
            'name' => __('regular', 'mercredi-theme'),
            'shortName' => __('M', 'mercredi-theme'),
            'size' => '1rem',
            'slug' => 'regular'
        ),
        array(
            'name' => __('large', 'mercredi-theme'),
            'shortName' => __('L', 'mercredi-theme'),
            'size' => '1.125rem',
            'slug' => 'large'
        ),
        array(
            'name' => __('x-large', 'mercredi-theme'),
            'shortName' => __('XL', 'mercredi-theme'),
            'size' => '1.25rem',
            'slug' => 'x-large'
        ),
    ));

    add_theme_support(
        'editor-color-palette',
        array(
            array('name' => 'default', 'slug' => 'black', 'color' => '#1e1e1e'),
            array('name' => 'accent', 'slug' => 'accent', 'color' => '#800b87'),
            array('name' => 'white', 'slug' => 'white', 'color' => '#FFFFFF'),
            array('name' => 'gray', 'slug' => 'gray', 'color' => '#696969'),
        )
    );

    add_theme_support('editor-gradient-presets', []);

    add_theme_support('disable-custom-colors');
    add_theme_support('disable-custom-gradients');
    add_theme_support('disable-custom-font-sizes');
    add_theme_support('align-wide');
    add_theme_support('responsive-embeds');
    // add_theme_support( 'custom-line-height' );
    add_theme_support('custom-spacing');
    add_theme_support('wp-block-styles');
    // remove block for theme
    remove_theme_support('block-templates');
}

add_action('after_setup_theme', __NAMESPACE__ . '\gutenberg_settings');
