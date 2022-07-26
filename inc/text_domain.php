<?php

namespace Goodmotion\inc\textDomain;


function gm_load_theme_textdomain()
{
    load_theme_textdomain('mercredi-theme', get_template_directory() . '/languages');
}

add_action('after_setup_theme', __NAMESPACE__ . '\gm_load_theme_textdomain');
