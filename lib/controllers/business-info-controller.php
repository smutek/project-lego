<?php

namespace Roots\Sage\Controllers\BusinessInfo;

/**
 * Returns an array with business info.
 *
 * @return array
 */

function business_info() {

  $address1 = get_theme_mod( 'address_line_1' );
  $address2 = get_theme_mod( 'address_line_2' );
  $address3 = get_theme_mod( 'address_line_3' );
  $phone    = get_theme_mod( 'phone_setting' );
  $fax      = get_theme_mod( 'fax_setting' );
  $email    = get_theme_mod( 'email_setting' );

  $info = [
    'address1' => $address1,
    'address2' => $address2,
    'address3' => $address3,
    'phone'    => $phone,
    'fax'      => $fax,
    'email'    => $email,
  ];

  return $info;
}


/**
 * Site copyright notice
 *
 * @return string
 */
function copyright($classes = "") {

  if ( ! is_array( $classes ) ) {
    $classes = [ $classes ];
  }

  $classes = implode(' ', $classes);

  $businessName = get_theme_mod( 'business_name' );

  ! empty( $businessName ) ? $name = $businessName : $name = get_bloginfo( 'name' );

  $year = date('Y');

  $output = sprintf('<p class="%1$s">&copy; %2$s %3$s</p>', $classes, $year, $businessName);

  return $output;
}

function privacy_policy( $classes = "", $target = "_self" ) {

  $privacy = get_theme_mod( 'privacy_policy_page' );

  if ( ! $privacy ) {
    return false;
  }

  if ( ! is_array( $classes ) ) {
    $classes = [ $classes ];
  }

  $classes = implode( ' ', $classes );

  $title = get_the_title( $privacy );
  $link  = get_the_permalink( $privacy );

  $output = sprintf( '<a href="%1$s" class="%2$s" target="%3$s">%4$s</a>', $link, $classes, $target, $title );

  return $output;

}

function terms_page( $classes = "", $target = "_self" ) {

  $privacy = get_theme_mod( 'terms_page' );

  if ( ! $privacy ) {
    return false;
  }

  if ( ! is_array( $classes ) ) {
    $classes = [ $classes ];
  }

  $classes = implode( ' ', $classes );

  $title = get_the_title( $privacy );
  $link  = get_the_permalink( $privacy );

  $output = sprintf( '<a href="%1$s" class="%2$s" target="%3$s">%4$s</a>', $link, $classes, $target, $title );

  return $output;

}
