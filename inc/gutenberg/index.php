<?php

namespace Goodmotion\inc\gutenberg;


// require_once(dirname(__FILE__) . '/settings.php');
require_once(dirname(__FILE__) . '/blocks.php');
require_once(dirname(__FILE__) . '/patterns.php');


/**
 * add style for gutenberg editor block
 */
function gutenberg_css()
{
  // you must use this method because wp adapt css to gutenberg frame
  add_theme_support('editor-styles');
  add_editor_style('style-editor.css');
  add_theme_support('wp-block-styles');

  // remove template support
  remove_theme_support('block-templates');
}

add_action('init', __NAMESPACE__ . '\gutenberg_css');

/**
 * set editor full width
 */
add_action('admin_head', function () {
  echo '<style>
      .editor-styles-wrapper {
        max-width: none !important;
        margin: 0 auto;
      }
      </style>';
});

/**
 * enqueue script for editor settings
 */
function editor_enqueue()
{
  wp_enqueue_script('custom-editor-script', get_template_directory_uri() . '/editor/js/reset.js', array('wp-blocks', 'wp-dom-ready', 'wp-edit-post'), '1.0', true);
}

add_action('enqueue_block_editor_assets', __NAMESPACE__ . '\editor_enqueue');
