<?php

namespace Goodmotion\inc\woocommerce\download;


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

    /** add text on image */
    putenv('GDFONTPATH=' . dirname(__FILE__) . '/../../assets/fonts/');
    $img = imagecreatefromjpeg($path);
    $color = imagecolorallocate($img, 0, 0, 0);
    $id = 'Mercredi-' . $order->get_id();
    $font = 'Roboto-Bold';
    $new_name = 'order' . $id . '.jpeg';

    imagettftext($img, 24, 0, 10, 32, $color, $font, $id);

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
