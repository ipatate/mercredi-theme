<?php

namespace GoodmotionStarter\inc\shortcode;



function shortcode_address($atts, $content)
{
  $address = get_field('infos_address', 'options');
  $address_store = get_field('infos_address_store', 'options');
  return '<div>' . $address . '</div><div>' . $address_store . '</div>';
}

add_shortcode('merc-address', __NAMESPACE__ . '\shortcode_address');


function shortcode_phone($atts, $content)
{
  $phone = get_field('infos_phone', 'options');
  return '<a href="tel:+33' . substr(str_replace(' ', '', $phone), 1) . '" title="' . __('contact phone') . '">' . $phone . '</a>';
}

add_shortcode('merc-phone', __NAMESPACE__ . '\shortcode_phone');


function shortcode_mail($atts, $content)
{
  $email = get_field('infos_email', 'options');
  return '<a href="mailto' . str_replace(' ', '', $email) . '" title="' . __('contact phone') . '">' . $email . '</a>';
}

add_shortcode('merc-email', __NAMESPACE__ . '\shortcode_mail');

function shortcode_schedules($atts, $content)
{
  return get_field('infos_schedules', 'options');
}

add_shortcode('merc-schedules', __NAMESPACE__ . '\shortcode_schedules');


function shortcode_facebook($atts, $content)
{
  $url = get_field('facebook_page', 'options');
  return '<a href="' . $url . '" title="' . __('Facebook') . '" target="_blank">' . __('Facebook') . '</a>';
}

add_shortcode('merc-facebook', __NAMESPACE__ . '\shortcode_facebook');


function shortcode_instagram($atts, $content)
{
  $url = get_field('instagram_page', 'options');
  return '<a href="' . $url . '" title="' . __('Instagram') . '" target="_blank">' . __('Instagram') . '</a>';
}

add_shortcode('merc-instagram', __NAMESPACE__ . '\shortcode_instagram');
