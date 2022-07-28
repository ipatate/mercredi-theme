<?php

/**
 * Timber goodmotion-starter
 * https://github.com/timber/starter-theme
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.1
 */
/**
 * If you are installing Timber as a Composer dependency in your theme, you'll need this block
 * to load your dependencies and initialize Timber. If you are using Timber via the WordPress.org
 * plug-in, you can safely delete this block.
 */
$composer_autoload = __DIR__ . '/vendor/autoload.php';

if (file_exists($composer_autoload)) {
  require_once $composer_autoload;
  $timber = new Timber\Timber();
}

require_once dirname(__FILE__) . '/inc/assets.php';
require_once dirname(__FILE__) . '/inc/gutenberg/index.php';
require_once dirname(__FILE__) . '/inc/disable.php';
require_once dirname(__FILE__) . '/inc/disable_comments.php';
require_once dirname(__FILE__) . '/inc/menu.php';
require_once dirname(__FILE__) . '/inc/text_domain.php';
require_once dirname(__FILE__) . '/inc/acf.php';
require_once dirname(__FILE__) . '/inc/acf_config.php';
require_once dirname(__FILE__) . '/inc/images.php';
require_once dirname(__FILE__) . '/inc/post.php';
require_once(dirname(__FILE__) . '/inc/woocommerce/index.php');
require_once(dirname(__FILE__) . '/inc/shortcode.php');
require_once(dirname(__FILE__) . '/inc/cookies.php');

require_once(dirname(__FILE__) . '/post-types/event.php');
require_once(dirname(__FILE__) . '/post-types/product.php');
require_once(dirname(__FILE__) . '/post-types/menu.php');

/**
 * This ensures that Timber is loaded and available as a PHP class.
 * If not, it gives an error message to help direct developers on where to activate
 */
if (!class_exists('Timber')) {

  add_action(
    'admin_notices',
    function () {
      echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url(admin_url('plugins.php#timber')) . '">' . esc_url(admin_url('plugins.php')) . '</a></p></div>';
    }
  );

  add_filter(
    'template_include',
    function ($template) {
      return get_stylesheet_directory() . '/static/no-timber.html';
    }
  );
  return;
}

/**
 * Sets the directories (inside your theme) to find .twig files
 */
Timber::$dirname = array('templates', 'views');

/**
 * By default, Timber does NOT autoescape values. Want to enable Twig's autoescape?
 * No prob! Just set this value to true
 */
Timber::$autoescape = false;


/**
 * We're going to configure our theme inside of a subclass of Timber\Site
 * You can move this to its own file and include here via php's include("MySite.php")
 */
class StarterSite extends Timber\Site
{
  /** Add timber support. */
  public function __construct()
  {
    add_action('after_setup_theme', array($this, 'theme_supports'));
    add_filter('timber/context', array($this, 'add_to_context'));
    add_filter('timber/twig', array($this, 'add_to_twig'));
    add_action('init', array($this, 'register_post_types'));
    add_action('init', array($this, 'register_taxonomies'));
    parent::__construct();
  }
  /** This is where you can register custom post types. */
  public function register_post_types()
  {
  }
  /** This is where you can register custom taxonomies. */
  public function register_taxonomies()
  {
  }

  /** This is where you add some context
   *
   * @param string $context context['this'] Being the Twig's {{ this }}.
   */
  public function add_to_context($context)
  {
    $context['home_url'] = get_home_url();
    $context['menu']  = new Timber\Menu('primary');
    $context['menu_secondary']  = new Timber\Menu('secondary');
    $context['site']  = $this;
    $context['options'] = get_fields('options');
    return $context;
  }

  public function theme_supports()
  {
    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    /*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
    add_theme_support('title-tag');

    /*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
    add_theme_support('post-thumbnails');

    /*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
    add_theme_support(
      'html5',
      array(
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
      )
    );

    /*
		 * Enable support for Post Formats.
		 *
		 * See: https://codex.wordpress.org/Post_Formats
		 */
    add_theme_support(
      'post-formats',
      array(
        'aside',
        'image',
        'video',
        'quote',
        'link',
        'gallery',
        'audio',
      )
    );

    add_theme_support('menus');
  }

  // /**
  //  *
  //  * @param string $text being 'foo', then returned 'foo bar!'.
  //  */
  // public function prefetch($url)
  // {
  //   add_action(
  //     'wp_head',
  //     function () use ($url) {
  //       echo '<link rel="preload" href="' . $url . '" as="image" />';
  //     }
  //   );
  //   return null;
  // }

  /** This is where you can add your own functions to twig.
   *
   * @param string $twig get extension.
   */
  public function add_to_twig($twig)
  {
    $twig->addExtension(new Twig\Extension\StringLoaderExtension());
    // $twig->addFilter(new Twig\TwigFilter('prefetch', array($this, 'prefetch')));

    $twig->addFunction(new \Twig_SimpleFunction('isAgenda', function ($label) {
      $link = Timber\URLHelper::get_current_url();
      return strtolower($label) === 'agenda' && strpos($link, 'agenda');
    }));

    return $twig;
  }
}

new StarterSite();



/** test */

/** BG lazy load */
// if (!function_exists('file_get_html')) {
//   require_once(dirname(__FILE__) . '/helpers/simplehtmldom/simple_html_dom.php');
// }


// function bgImageLazy($content)
// {
//   $hasWebP = (strpos($_SERVER['HTTP_ACCEPT'], 'image/webp') !== false || strpos($_SERVER['HTTP_USER_AGENT'], ' Chrome/') !== false);
//   $html = new \simple_html_dom();
//   $html->load($content);
//   // find container
//   $container = $html->find('.wp-block-media-text__media');
//   foreach ($container as $key => $value) {
//     // get styles
//     $styles = $value->getAttribute('style');
//     if ($styles) {
//       // first explode with ;
//       $arrStyles = explode(';', $styles);
//       $keyValueStyles = [];
//       // second explode with :
//       foreach ($arrStyles as $style) {
//         $s = explode(':', $style, 2);
//         if (count($s) >= 1) {
//           $keyValueStyles[$s[0]] = $s[1];
//         }
//       }
//       $urlImage = null;
//       $newStyles = '';
//       // search img value
//       foreach ($keyValueStyles as $k => $v) {
//         if ($k === 'background-image') {
//           preg_match('/url\("?(.+)"?\)/', $v, $matches);
//           $urlImage = $matches[1];
//           // delete
//           unset($keyValueStyles['background-image']);
//         } else {
//           $newStyles .= $k . ':' . $v . ';';
//         }
//       }
//       // if url
//       if ($urlImage) {
//         // process image
//         // explode path of image
//         $path = explode('/', $urlImage);
//         // remove domain url
//         $relativePath = preg_replace('#^(://|[^/])+#', '', $urlImage);
//         // name of image
//         $nameComplete = $path[count($path) - 1];
//         // the path without name of image
//         $imagePath = str_replace($nameComplete, '', $relativePath);
//         // server path for process image
//         $serverPath = dirname(__FILE__) . '/../../..' . $imagePath;
//         // get image name and extension
//         $split = explode('.', $nameComplete);
//         $name = $split[0];
//         $extension = $split[1];
//         $op = new \Timber\Image\Operation\Resize(768, 768, 'default');
//         // create image name
//         $imageName = $op->filename($name, $extension);
//         // process image
//         $b = $op->run($serverPath . $nameComplete,  $imagePath . $imageName);
//         $imageName = \Timber\ImageHelper::img_to_jpg($imagePath . $imageName);

//         if ($hasWebP) {
//           $imageName = \Timber\ImageHelper::img_to_webp($imageName);
//         }
//         // end of process
//         // set style
//         $value->setAttribute('style', $newStyles);
//         // set img for lazy load
//         $value->setAttribute('data-bg', $imageName);
//         $actualClass = $value->getAttribute('class');
//         // add class lazy
//         $value->setAttribute('class', $actualClass . ' lazy');
//       }
//     }
//   }
//   return $html->save();
// }

// // search
// add_filter('the_content', function ($content) {
//   return bgImageLazy($content);
// });
