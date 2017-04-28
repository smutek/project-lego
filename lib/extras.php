<?php

namespace Roots\Sage\Extras;

use Roots\Sage\Setup;

/**
 * Add <body> classes
 */
function body_class($classes) {
  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }
  }

  // Add class if sidebar is active
  if (Setup\display_sidebar()) {
    $classes[] = 'sidebar-primary';
  }

  return $classes;
}
add_filter('body_class', __NAMESPACE__ . '\\body_class');

/**
 * Clean up the_excerpt()
 */
function excerpt_more() {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');

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
