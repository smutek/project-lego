<?php

namespace Roots\Sage\Controllers\Jumbotron;

use Roots\Sage\Wrapper\SageWrapping;

class Jumbotron {

  public function __construct( $postID ) {

    $this->postID = $postID;

    add_action( 'after_header', [ $this, 'outputJumbotron' ] );

  }

  public function jumbotronContent() {

    $postID = $this->postID;

    $jumbotron = [];

    $jumbotron['heading'] = get_field( 'jumbotron_heading', $postID );
    $jumbotron['lead']    = get_field( 'jumbotron_lead', $postID );
    $jumbotron['copy']    = get_field( 'jumbotron_copy', $postID );
    $jumbotron['button']  = $this->jumbotronButton();

    $background = false;

    if( get_field( 'jumbotron_background_image', $postID )) {
      $url = get_field( 'jumbotron_background_image', $postID);

      $background = " style=\"background: url({$url});\"";

    }

    $jumbotron['background'] = $background;

    return $jumbotron;

  }

  public function jumbotronButton() {

    $postID    = $this->postID;

    $button = false;


    if ( get_field( 'jumbotron_show_button', $postID ) === false ) {
      return $button;
    }

    $button_text   = get_field( 'jumbotron_button_text', $postID );
    $target = get_field( 'jumbotron_link_target', $postID );

    if ( get_field( 'jumbotron_link_type', $postID ) === 'internal' ) {
      $link = get_field( 'jumbotron_internal_link', $postID );
    } else {
      $link = get_field( 'jumbotron_custom_link', $postID );
    }

    $button = sprintf( '<a href="%1$s" class="btn btn-primary btn-lg" target="%2$s">%3$s</a>', $link, $target, $button_text );

    return $button;

  }


  public function filePath() {
    $path     = 'templates/modules/jumbotron-base.php';
    $template = new SageWrapping( $path );

    return $template;
  }

  public function renderJumbotron() {
    ob_start();
    include $this->filePath();
    $output = ob_get_clean();

    return $output;
  }

  public function outputJumbotron() {
    $jumbotron = $this->renderJumbotron();
    echo $jumbotron;
  }


}
