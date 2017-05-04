<?php

namespace Roots\Sage\Controllers\Slider;

use Roots\Sage\Wrapper\SageWrapping;

/**
 * Class Slider
 * @package Roots\Sage\Controllers\Slider
 */
class Slider {

  /**
   * Slider constructor.
   *
   * @param $postID
   */
  public function __construct( $postID ) {

    $this->postID = $postID;

    add_action( 'after_header', [ $this, 'outputSlider' ], 11 );

  }

  /**
   * Slider Content
   *
   * Generates content for the slider
   *
   * @return array of string values
   */
  public function sliderContent() {

    $postID = $this->postID;

    $slider = $slides = $indicators = [];

    $slider['heading'] = get_field( 'slider_slider_title', $postID );
    $slider['ID'] = 'carousel-' . $postID;
    $count = 0;

    if ( have_rows( 'slider_add_slides', $postID ) ) : while ( have_rows( 'slider_add_slides', $postID ) ): the_row();

      $post_object = get_sub_field( 'slider_selected_slide', $postID );

      if ( $post_object ):

        // override $post
        $post = $post_object;
        setup_postdata( $post );

        $slideID = $post->ID;

        $slide = $indicator = [];

        get_field( 'slide_show_title', $slideID ) ? $slide['title'] = get_field( 'slide_heading', $slideID ) : $slide['title'] = false;
        get_field( 'slide_show_lead', $slideID ) ? $slide['lead'] = get_field( 'slide_lead', $slideID ) : $slide['lead'] = false;
        get_field( 'slide_show_content', $slideID ) ? $slide['content'] = get_field( 'slide_copy', $slideID ) : $slide['content'] = false;
        get_field( 'slide_show_button', $slideID ) ? $slide['button'] = $this->slideButton($slideID) : $slide['button'] = false;

        // If all of the following are false, we do not have a caption
        if(!$slide['title'] && !$slide['lead'] && !$slide['content']) {
          $slide['caption'] = false;
        } else {
          $slide['caption'] = true;
        }

        if(get_field('slide_image', $slideID)) {
          $imageObject = get_field( 'slide_image', $slideID );
          $slide['url'] = $imageObject['url'];
          $slide['alt'] = $imageObject['alt'];
        } else {
          $slide['url'] = 'holder.js/1200x400?bg=0D8FDB&fg=0D8FDB';
          $slide['alt'] = 'Slide ' . strval($count + 1);
        }

        wp_reset_postdata(); // reset $post object

        $slideClasses = 'carousel-item';
        $indicatorClasses = 'carousel-indicator';

        if( $count === 0) {
          $slideClasses .= " active";
          $indicatorClasses .= " active";
        }

        $slide['classes'] = $slideClasses;

        $indicator = sprintf('<li data-target="#%1$s" data-slide-to="%2$s" class="%3$s"></li>', $slider['ID'], $count, $indicatorClasses);

        $indicators[] = $indicator;
        $slides[] = $slide;

      endif; // end post object
      $count ++;

    endwhile;
    $slider['indicators'] = $indicators;
    $slider['slides'] = $slides;

    endif;

    return $slider;

  }

  /**
   * Generates button markup, or returns false if no button.
   *
   * @param $slideID
   *
   * @return string
   */
  public function slideButton($slideID) {

    $button_text = get_field( 'slide_button_text', $slideID );
    $link_type   = get_field( 'slide_link_type', $slideID );
    $target      = get_field( 'slide_link_target', $slideID );

    if ( $link_type === 'internal' ) {
      $link = get_field( 'slide_internal_link', $slideID );
    } else {
      $link = get_field( 'slide_custom_link', $slideID );
    }


    $button = sprintf( '<a href="%1$s" class="btn btn-primary btn-lg" target="%2$s">%3$s</a>', $link, $target, $button_text );

    return $button;

  }

  /**
   * File path to the hero template
   *
   * @return SageWrapping
   */
  public function filePath() {
    $path     = 'templates/modules/slider-base.php';
    $template = new SageWrapping( $path );

    return $template;
  }

  /**
   * Render Slider
   *
   * Assembles the slider, sends the content to the template
   *
   * @return string a jumbotron
   */
  public function renderSlider() {
    ob_start();
    include $this->filePath();
    $output = ob_get_clean();

    return $output;
  }

  /**
   * Output slider
   *
   * Outputs the slider to the front end, using the after_header action hook
   * Hook order (in constructor) is set to 11 so sldier loads after jumbotron
   * if both are present.
   */
  public function outputSlider() {
    $slider = $this->renderSlider();
    echo $slider;
  }

}
