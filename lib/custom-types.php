<?php
/**
 * Load CPT's and taxonomies
 *
 * Please note that missing files will produce a fatal error.
 */
$custom_types = [
  'lib/post-types/slide.php', // Slide CPT
  'lib/taxonomies/slide-type.php', // Slide taxonomy
];

foreach ( $custom_types as $custom_type ) {
  if ( ! $filepath = locate_template( $custom_type ) ) {
    trigger_error( sprintf( __( 'Error locating controller %s for inclusion', 'sage' ), $custom_type ), E_USER_ERROR );
  }

  require_once $filepath;
}
unset( $custom_type, $filepath );
