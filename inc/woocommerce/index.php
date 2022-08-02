<?php

namespace Goodmotion\inc\woocommerce;

require_once(dirname(__FILE__) . '/download.php');
require_once(dirname(__FILE__) . '/field.php');

function theme_add_woocommerce_support()
{
  add_theme_support('woocommerce');
}

add_action('after_setup_theme', __NAMESPACE__ . '\theme_add_woocommerce_support');


function logout()
{
  $items = '';
  if (is_user_logged_in()) {
    $items .= '<a href="' . wp_logout_url(get_permalink(wc_get_page_id('myaccount'))) . '">Log Out</a>';
  }
  return $items;
}


/** fragment for cart head */
function getCartFragment()
{
  $total = WC()->cart->get_cart_contents_count();
  return '<a href="' . wc_get_cart_url() . '" class="gm-cart">' . __('Cart', '') .  ($total > 0 ? '<span>' . $total . '</span>' : '') . '</a>';
}

/** head store */
function before_content_wrapper()
{
  echo '<div class="gm-head-woocommerce">' . (is_user_logged_in() ?
    '<a href=" ' . get_permalink(get_option('woocommerce_myaccount_page_id')) . '" title=" ' . __('Account', '') . '">' . __('Account', '') . '</a>' : '') .
    ' ' . namespace\getCartFragment() . ' ' . namespace\logout() . '
  </div>';
}

add_action('woocommerce_before_main_content', __NAMESPACE__ .  '\before_content_wrapper');

add_action('woocommerce_before_account_navigation', __NAMESPACE__ .  '\before_content_wrapper');


/** fragment ajax for update cart head */
function add_to_cart_fragment($fragments)
{

  $fragments['.gm-cart'] = namespace\getCartFragment();
  return $fragments;
}

add_filter('woocommerce_add_to_cart_fragments', __NAMESPACE__ .  '\add_to_cart_fragment');


function theme_setup()
{
  // add_theme_support('wc-product-gallery-zoom');
  // add_theme_support('wc-product-gallery-lightbox');
  add_theme_support('wc-product-gallery-slider');
}

add_action('after_setup_theme', __NAMESPACE__ .  '\theme_setup');


/**
 * Set WooCommerce image dimensions upon theme activation
 */
// Remove each style one by one
// add_filter('woocommerce_enqueue_styles', __NAMESPACE__ .  '\dequeue_styles');
function dequeue_styles($enqueue_styles)
{
  unset($enqueue_styles['woocommerce-general']);  // Remove the gloss
  unset($enqueue_styles['woocommerce-layout']);    // Remove the layout
  unset($enqueue_styles['woocommerce-smallscreen']);  // Remove the smallscreen optimisation
  return $enqueue_styles;
}

// Or just remove them all in one line
// add_filter('woocommerce_enqueue_styles', '__return_false');
