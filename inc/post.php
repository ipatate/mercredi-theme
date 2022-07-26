<?php

namespace Goodmotion\inc\post;

function excerpt_more($more)
{
  return '...';
}
add_filter('excerpt_more', __NAMESPACE__ . '\excerpt_more');
