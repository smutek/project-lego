<?php

namespace Roots\Sage\Setup;

use Roots\Sage\Assets;

/**
 * Theme setup
 */
function setup() {
  // Enable features from Soil when plugin is activated
  // https://roots.io/plugins/soil/
  add_theme_support('soil-clean-up');
  add_theme_support('soil-nav-walker');
  add_theme_support('soil-nice-search');
  add_theme_support('soil-jquery-cdn');
  add_theme_support('soil-relative-urls');

  // Make theme available for translation
  // Community translations can be found at https://github.com/roots/sage-translations
  load_theme_textdomain('sage', get_template_directory() . '/lang');

  // Enable plugins to manage the document title
  // http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
  add_theme_support('title-tag');

  // Register wp_nav_menu() menus
  // http://codex.wordpress.org/Function_Reference/register_nav_menus
  register_nav_menus([
    'primary_navigation' => __('Primary Navigation', 'sage')
  ]);

  // Enable post thumbnails
  // http://codex.wordpress.org/Post_Thumbnails
  // http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
  // http://codex.wordpress.org/Function_Reference/add_image_size
  add_theme_support('post-thumbnails');

  // custom logo support
  // https://codex.wordpress.org/Theme_Logo
  add_theme_support( 'custom-logo' );

  // Enable post formats
  // http://codex.wordpress.org/Post_Formats
  add_theme_support('post-formats', ['aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio']);

  // Enable HTML5 markup support
  // http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
  add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

  // Use main stylesheet for visual editor
  // To add custom styles edit /assets/styles/layouts/_tinymce.scss
  add_editor_style(Assets\asset_path('styles/main.css'));
}
add_action('after_setup_theme', __NAMESPACE__ . '\\setup');

/**
 * Register sidebars
 */
function widgets_init() {
  register_sidebar([
    'name'          => __('Primary', 'sage'),
    'id'            => 'sidebar-primary',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>'
  ]);

  register_sidebar([
    'name'          => __('Footer', 'sage'),
    'id'            => 'sidebar-footer',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>'
  ]);
}
add_action('widgets_init', __NAMESPACE__ . '\\widgets_init');

/**
 * Determine which pages should NOT display the sidebar
 */
function display_sidebar() {
  static $display;

  isset($display) || $display = in_array(true, [
    // The sidebar WILL be displayed if ANY of the following return true.
    // @link https://codex.wordpress.org/Conditional_Tags
    is_page_template('template-sidebar.php'),
  ]);

  return apply_filters('sage/display_sidebar', $display);
}

/**
 * Theme assets
 */
function assets() {
  wp_enqueue_style('sage/css', Assets\asset_path('styles/main.css'), false, null);

  if (is_single() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }

  wp_enqueue_script('sage/js', Assets\asset_path('scripts/main.js'), ['jquery'], null, true);
}
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\assets', 100);

/**
 * Add the SVG Mime type to the uploader
 * @author Alain Schlesser (alain.schlesser@gmail.com)
 * @link https://gist.github.com/schlessera/1eed8503110fb3076e73
 *
 * @param  array $mimes list of mime types that are allowed by the
 * WordPress uploader
 *
 * @return array modified version of the $mimes array
 *
 * @see https://codex.wordpress.org/Plugin_API/Filter_Reference/upload_mimes
 * @see http://www.w3.org/TR/SVG/mimereg.html
 */
function add_svg_mime_type( $mimes ) {
  // add official SVG mime type definition to the array of allowed mime types
  $mimes['svg'] = 'image/svg+xml';
  // return the modified array
  return $mimes;
}
add_filter( 'upload_mimes', __NAMESPACE__ . '\\add_svg_mime_type' );


/**
 * Admin Styles
 *
 * Add styles to the admin area. Helps with visual clutter on ACF fields,
 * viewing SVG in media loader, etc.
 */
function admin_styles() {
  ob_start();
  include(locate_template('templates/modules/admin-styles.php'));
  $output = ob_get_clean();
  echo $output;
}
add_action('admin_head', __NAMESPACE__ . '\\admin_styles');
add_action( 'customize_controls_print_styles', __NAMESPACE__ . '\\admin_styles' );

/**
 * ACF Admin Access Control
 *
 * Hide / Show the ACF menu.
 *
 * Hides the ACF menu via a radio button tucked away in customizer.
 * Out of sight, out of mind.
 *
 * @return bool
 */
function acf_admin_control() {
  get_theme_mod('acf_visibility') === 'show' ? $return = true : $return = false;
  return $return;
}
add_filter('acf/settings/show_admin', __NAMESPACE__ . '\\acf_admin_control');
