<?php

namespace Goodmotion\inc\editor;


function block_category($categories)
{
  array_splice(
    $categories,
    2,
    0,
    array(
      array(
        'slug' => 'goodmotion-blocks',
        'title' => __('Mercredi Blocks', 'mercredi-theme'),
      )
    )
  );
  return $categories;
}



add_filter('block_categories_all',  __NAMESPACE__ . '\block_category', 10, 2);
