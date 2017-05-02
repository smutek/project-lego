<?php

namespace Roots\Sage\Utils;

/*
 * Utility functions, from Soil
 * @url https://github.com/roots/soil
 */

/**
 * Make a URL relative
 */
function root_relative_url( $input ) {
  if ( is_feed() ) {
    return $input;
  }
  $url = parse_url( $input );
  if ( ! isset( $url['host'] ) || ! isset( $url['path'] ) ) {
    return $input;
  }
  $site_url = parse_url( network_home_url() );  // falls back to home_url
  if ( ! isset( $url['scheme'] ) ) {
    $url['scheme'] = $site_url['scheme'];
  }
  $hosts_match   = $site_url['host'] === $url['host'];
  $schemes_match = $site_url['scheme'] === $url['scheme'];
  $ports_exist   = isset( $site_url['port'] ) && isset( $url['port'] );
  $ports_match   = ( $ports_exist ) ? $site_url['port'] === $url['port'] : true;
  if ( $hosts_match && $schemes_match && $ports_match ) {
    return wp_make_link_relative( $input );
  }

  return $input;
}

/**
 * Compare URL against relative URL
 */
function url_compare( $url, $rel ) {
  $url = trailingslashit( $url );
  $rel = trailingslashit( $rel );

  return ( ( strcasecmp( $url, $rel ) === 0 ) || root_relative_url( $url ) == $rel );
}

/**
 * Hooks a single callback to multiple tags
 */
function add_filters( $tags, $function, $priority = 10, $accepted_args = 1 ) {
  foreach ( (array) $tags as $tag ) {
    add_filter( $tag, $function, $priority, $accepted_args );
  }
}

/**
 * Display error alerts in admin panel
 */
function alerts( $errors, $capability = 'activate_plugins' ) {
  if ( ! did_action( 'init' ) ) {
    return add_action( 'init', function () use ( $errors, $capability ) {
      alerts( $errors, $capability );
    } );
  }
  $alert = function ( $message ) {
    echo '<div class="error"><p>' . $message . '</p></div>';
  };
  if ( call_user_func_array( 'current_user_can', (array) $capability ) ) {
    add_action( 'admin_notices', function () use ( $alert, $errors ) {
      array_map( $alert, (array) $errors );
    } );
  }
}

/**
 * oEmbed Attributes
 *
 * Add parameters to oEmbed query string. Useful for
 * turning off related videos and such.
 *
 * Basic field use: $video = videoLink('your_field_name');
 * Add second param if in a repeater: $video - videoLink('your_subfield_name', true);
 *
 * @see https://www.advancedcustomfields.com/resources/oembed/
 *
 * @param $field
 * @param bool $repeater defaults to false / true if repeater
 * @param array $params / array of query string parameters as key value pairs
 *
 * @return mixed  embed HTML
 */
function videoLink( $field, $repeater = false, array $params = [] ) {
  global $post;
  // get current post ID
  $id = $post->ID;

  $defaults = array(
    'rel'      => 0,
    'title'    => 0,
    'byline'   => 0,
    'portrait' => 0,
    'autoplay' => 'true'
  );

  foreach ( $defaults as $key => $value ) {

    $params[$key] = $value;

  }

  if ( ! $repeater ) {
    // get the field
    $videoFrame = get_field( $field, $id );
  } else {
    // if we are in a repeater
    $videoFrame = get_sub_field( $field, $id );
  }
  // use preg_match to find iframe src
  preg_match( '/src="(.+?)"/', $videoFrame, $matches );
  $src = $matches[1];
  // add extra params to iframe src

  $new_src   = add_query_arg( $params, $src );
  $videoLink = str_replace( $src, $new_src, $videoFrame );
  return $videoLink;
}


/**
 * Probably a phone
 *
 * Uses Mobile_Detect class to check user agent. Checks to
 * see if the sniffed device is a mobile device, but not a tablet.
 * If it is a mobile device, but not a tablet, it's probably
 * a phone.
 *
 * Returns true or false.
 *
 * Use sparingly because user agent sniffing is sketchy.
 *
 * @return bool
 */
function probablyAPhone() {

  if(!class_exists(\Mobile_Detect::class))
    return false;

  // initiate the class
  $detect = new \Mobile_Detect();
  // catch all. Includes phones and tablets.
  $detect->isMobile() ? $mobile = true : $mobile = false;
  $detect->isTablet() ? $tablet = true : $tablet = false;
  $mobile && ! $tablet ? $probPhone = true : $probPhone = false;
  return $probPhone;
}
