<?php
/**
 * Load controllers
 *
 * Please note that missing files will produce a fatal error.
 */
$controllers = [
  'lib/controllers/branding-controller.php', // Logos and business info
  'lib/controllers/business-info-controller.php', // Site info
  'lib/controllers/navigation-controller.php', // Navigation controllers
  'lib/controllers/Jumbotron.php', // Jumbotron class
  'lib/controllers/Modal.php', // Base modal class
  'lib/controllers/VideoModal.php', // Base modal class
];

foreach ( $controllers as $controller ) {
  if ( ! $filepath = locate_template( $controller ) ) {
    trigger_error( sprintf( __( 'Error locating controller %s for inclusion', 'sage' ), $controller ), E_USER_ERROR );
  }

  require_once $filepath;
}
unset( $controller, $filepath );
