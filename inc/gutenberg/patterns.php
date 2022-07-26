<?php

namespace Goodmotion\inc\gutenberg\patterns;



add_action(
    'init',
    function () {
        register_block_pattern_category('mercredi/mercredi-patterns', array('label' => __('Talents Academy', 'mercredi-theme')));
        // not needed for now
        // add_theme_support('core-block-patterns');
        // remove the theme support for the core-block-patterns
        remove_theme_support('core-block-patterns');
    }
);

function unregister_category()
{
    unregister_block_pattern_category('buttons');
    unregister_block_pattern_category('query');
}
add_action('init', __NAMESPACE__ . '\unregister_category');
