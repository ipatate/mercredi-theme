<?php

namespace Goodmotion\inc\woocommerce;


function theme_add_woocommerce_support()
{
  add_theme_support('woocommerce');
}

add_action('after_setup_theme', __NAMESPACE__ . '\theme_add_woocommerce_support');


function getCartFragment()
{
  $total = WC()->cart->get_cart_contents_count();
  return '<a href="' . wc_get_cart_url() . '" class="gm-cart">' . __('Cart', '') .  ($total > 0 ? '<span>' . $total . '</span>' : '') . '</a>';
}

/** head store */
function before_content_wrapper()
{
  echo '<div class="gm-head-woocommerce"><a href=" ' . get_permalink(get_option('woocommerce_myaccount_page_id')) . '" title=" ' . __('My Account', '') . '">' . __('My Account', '') . '</a>
  ' . namespace\getCartFragment() . '
  </div>';
}

add_action('woocommerce_before_main_content', __NAMESPACE__ .  '\before_content_wrapper');

/** fragment ajax for update cart head */
function add_to_cart_fragment($fragments)
{

  $fragments['.gm-cart'] = namespace\getCartFragment();
  return $fragments;
}

add_filter('woocommerce_add_to_cart_fragments', __NAMESPACE__ .  '\add_to_cart_fragment');


function theme_setup()
{
  add_theme_support('wc-product-gallery-zoom');
  add_theme_support('wc-product-gallery-lightbox');
  add_theme_support('wc-product-gallery-slider');
}

add_action('after_setup_theme', __NAMESPACE__ .  '\theme_setup');
