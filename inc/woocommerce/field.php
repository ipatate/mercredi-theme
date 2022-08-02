<?php

namespace Goodmotion\inc\woocommerce\field;

// Exit if accessed directly
if (!defined('ABSPATH')) {
  exit;
}

/**
 * Display the custom text field
 * @since 1.0.0
 */
function create_custom_field()
{
  // $value = get_post_meta(get_the_ID(), 'gm-show-name-field', true);
  $args = array(
    'id'            => 'gm-show-name-field',
    'label'         => __('Show the name field', 'mercredi'),
    'class'          => 'mercredi-custom-field',
    // 'desc_tip'      => true,
    'description'   => __('Display the name field to client.', 'mercredi'),
  );
  woocommerce_wp_checkbox($args);
}
add_action('woocommerce_product_options_general_product_data', __NAMESPACE__ . '\create_custom_field');

/**
 * Save the custom field
 * @since 1.0.0
 */
function save_custom_field($post_id)
{
  $product = wc_get_product($post_id);
  $showField = isset($_POST['gm-show-name-field']) ? 'yes' : 'no';
  if ($showField) {
    $product->update_meta_data('gm-show-name-field', $showField);
    $product->save();
  }
}
add_action('woocommerce_process_product_meta', __NAMESPACE__ . '\save_custom_field');


/**
 * Display custom field on the front end
 * @since 1.0.0
 */
function display_custom_field()
{
  global $post;
  // Check for the custom field value
  $product = wc_get_product($post->ID);
  $showTitle = $product->get_meta('gm-show-name-field');
  if ($showTitle === 'yes') {
    // Only display our field if we've got a value for the field title
    printf(
      '<div class="mercredi-custom-field-wrapper"><label for="mercredi-title-field">%s</label><input type="text" id="gm-field-name" name="gm-field-name" value=""></div>',
      __('Enter the firstname and lastname for the card', 'mercredi')
    );
  }
}
add_action('woocommerce_before_add_to_cart_button', __NAMESPACE__ . '\display_custom_field');

/**
 * Validate the text field
 * @since 1.0.0
 * @param Array 		$passed					Validation status.
 * @param Integer   $product_id     Product ID.
 * @param Boolean  	$quantity   		Quantity
 */
function validate_custom_field($passed, $product_id, $quantity)
{
  $product = wc_get_product($product_id);
  $showTitle = $product->get_meta('gm-show-name-field');
  if ($showTitle && empty($_POST['gm-field-name'])) {
    // Fails validation
    $passed = false;
    wc_add_notice(__('Please enter a value into the text field', 'mercredi'), 'error');
  }
  return $passed;
}
add_filter('woocommerce_add_to_cart_validation', __NAMESPACE__ . '\validate_custom_field', 10, 3);

/**
 * Add the text field as item data to the cart object
 * @since 1.0.0
 * @param Array 		$cart_item_data Cart item meta data.
 * @param Integer   $product_id     Product ID.
 * @param Integer   $variation_id   Variation ID.
 * @param Boolean  	$quantity   		Quantity
 */
function add_custom_field_item_data($cart_item_data, $product_id, $variation_id, $quantity)
{
  if (!empty($_POST['gm-field-name'])) {
    // Add the item data
    $cart_item_data['title_field'] = $_POST['gm-field-name'];
    $product = wc_get_product($product_id); // Expanded function
    // $price = $product->get_price(); // Expanded function
    // $cart_item_data['total_price'] = $price + 100; // Expanded function
  }
  return $cart_item_data;
}
add_filter('woocommerce_add_cart_item_data', __NAMESPACE__ . '\add_custom_field_item_data', 10, 4);

/**
 * Update the price in the cart
 * @since 1.0.0
 */
function before_calculate_totals($cart_obj)
{
  if (is_admin() && !defined('DOING_AJAX')) {
    return;
  }
  // Iterate through each cart item
  foreach ($cart_obj->get_cart() as $key => $value) {
    if (isset($value['total_price'])) {
      $price = $value['total_price'];
      $value['data']->set_price(($price));
    }
  }
}
// add_action('woocommerce_before_calculate_totals', __NAMESPACE__ . '\before_calculate_totals', 10, 1);

/**
 * Display the custom field value in the cart
 * @since 1.0.0
 */
function cart_item_name($name, $cart_item, $cart_item_key)
{
  if (isset($cart_item['title_field'])) {
    $name .= sprintf(
      '<p>%s : %s</p>',
      __('Firstname and lastname for the card', 'mercredi'),
      esc_html($cart_item['title_field'])
    );
  }
  return $name;
}
add_filter('woocommerce_cart_item_name', __NAMESPACE__ . '\cart_item_name', 10, 3);

/**
 * Add custom field to order object
 */
function add_custom_data_to_order($item, $cart_item_key, $values, $order)
{
  foreach ($item as $cart_item_key => $values) {
    if (isset($values['title_field'])) {
      $item->add_meta_data('gm-field-name', $values['title_field'], true);
    }
  }
}
add_action('woocommerce_checkout_create_order_line_item', __NAMESPACE__ . '\add_custom_data_to_order', 10, 4);
