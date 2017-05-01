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
