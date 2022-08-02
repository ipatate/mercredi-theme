<?php

namespace Goodmotion\inc\woocommerce\download;

use DateTime;

add_filter('woocommerce_download_product_filepath', __NAMESPACE__ . '\woocommerce_download_product_filepath_filter', 10, 5);

/**
 * Function for `woocommerce_download_product_filepath` filter-hook.
 *
 * @param string $file_path File path.
 * @param string $email_address Email address.
 * @param WC_Order|bool $order Order object or false.
 * @param WC_Product $product Product object.
 * @param WC_Customer_Download $download Download data.
 *
 * @return string
 */
function woocommerce_download_product_filepath_filter($file_path, $email_address, $order, $product, $download)
{
  // test
  if (str_contains($file_path, 'bon-achat')) {
    // get relative path
    $path = parse_url($file_path, PHP_URL_PATH);
    $path = dirname(__FILE__) . '/../../../../..' . $path;
    $dt = new DateTime($order->get_date_created());
    /** add text on image */
    putenv('GDFONTPATH=' . dirname(__FILE__) . '/../../assets/fonts/');
    $img = imagecreatefromjpeg($path);
    $color = imagecolorallocate($img, 0, 0, 0);
    // echo '<pre>';
    // var_dump($download);
    // echo '<pre>';
    // die;
    // get the product for the download
    $product_id = $download->product_id;
    $name = null;
    foreach (($order->get_items()) as $key => $value) {
      if ($value->get_variation_id() === $product_id || $value->get_product_id() === $product_id) {
        $name = wc_get_order_item_meta($value->get_id(), 'gm-field-name');
      }
    }

    $id = 'MERC-' . $dt->format('dmy') . '-' . $order->get_id();
    $fontName = 'DancingScript-Medium';
    $font = 'Roboto-Bold';
    $new_name = $id . '.jpeg';

    // if ($name) {
    //   imagettftext($img, 21, 0, 400, 405, $color, $fontName, __('For') . ' ' . $name);
    // }

    imagettftext($img, 12, 0, 400, $name ? 400 : 420, $color, $fontName, $id);

    $directory = dirname(__FILE__) . '/../../gift-card/';
    /* create directory */
    if (!file_exists($directory)) {
      mkdir($directory, 0777, true);
    }

    /* image save */
    imagejpeg($img, $directory . $new_name);

    imagedestroy($img);

    return $directory . $new_name;
  }
  return $file_path;
}
