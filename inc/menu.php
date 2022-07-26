<?php

namespace Goodmotion\inc\menu;


function register_lang_menu()
{
  register_nav_menu('primary', __('Primary Menu ', 'mercredi-theme'));
  register_nav_menu('secondary', __('Secondary Menu', 'mercredi-theme'));
}

add_action('after_setup_theme', __NAMESPACE__ . '\register_lang_menu');
