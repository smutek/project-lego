<?php

namespace Roots\Sage\Controllers\Branding;

/**
 * Site Brand
 *
 * Use native WordPress site logo with custom (bootstrap friendly) markup
 * Falls back to text title if logo is not set.
 *
 * @param $html
 *
 * @return string
 */
/**
 * @param $html
 *
 * @return string
 */
/**
 * @param $html
 *
 * @return string
 */
function site_brand( $html ) {
  // grab the site name as set in customizer options
  $site = get_bloginfo( 'name' );
  // Wrap the site name in an H1 if on home, in a paragraph tag if not.
  is_front_page() ? $title = '<h1>' . $site . '</h1>' : $title = '<p>' . $site . '</p>';
  // Grab the home URL
  $home = esc_url( home_url( '/' ) );
  // Class for the link
  $class = 'navbar-brand';
  // Set anchor content to $title
  $content = $title;
  // Check if there is a custom logo set in customizer options...
  if ( has_custom_logo() ) {
    // get the URL to the logo
    $logo    = wp_get_attachment_image( get_theme_mod( 'custom_logo' ), 'full', false, array(
      'class'    => 'brand-logo img-responsive',
      'itemprop' => 'logo',
    ) );
    $content = $logo;
    $content .= '<span class="sr-only">' . $title . '</span>';
  }
  // setup the markup
  $html = sprintf( '<a href="%1$s" class="%2$s" rel="home" itemprop="url">%3$s</a>', $home, $class, $content );

  // return the result to WordPress
  return $html;
}

add_filter( 'get_custom_logo', __NAMESPACE__ . '\\site_brand' );


/**
 * @param null $classes
 *
 * @return string
 */
function footer_logo( $classes = null ) {

  if ( ! is_array( $classes ) ) {
    $classes = [ $classes ];
  }

  $classes[] = 'footer-logo';

  $site = get_bloginfo( 'name' );

  get_theme_mod( 'secondary_logo' ) ? $logo = 'secondary_logo' : $logo = 'custom_logo';

  $html = '<p>' . $site . '</p>';

  if ( ! empty( $logo ) ) {

    $logo_url = get_theme_mod( $logo );

    $html = sprintf( '<img src="%1$s" class="%2$s" alt="%3$s">', $logo_url, implode( " ", $classes ), $site );
  }

  // setup the markup

  return $html;
}


/**
 * Social navigation args
 *
 * Tidy up front end markup.
 * Use the arg to pass classes to the nav UL
 *
 * @param null $classes  // array or strong of class names
 *
 * @return array
 */
function social_nav( $classes = null ) {

  if ( ! is_array( $classes ) ) {
    $classes = [ $classes ];
  }

  $classes[] = 'nav nav-social';

  $menu_class = implode( " ", $classes );

  $args = [
    'theme_location' => 'social_navigation',
    'menu_class'     => $menu_class,
    'link_before'    => '<span class="sr-only">',
    'link_after'     => '</span>'
  ];

  return $args;

}


/**
 * Site copyright notice
 *
 * @return string
 */
function copyright() {
  $businessName = get_theme_mod( 'business_name' );
  ! empty( $businessName ) ? $name = $businessName : $name = get_bloginfo( 'name' );
  $output = '&copy; ' . date( 'Y' ) . ' ' . $name;

  return $output;
}
