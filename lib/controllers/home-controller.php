<?php

namespace Roots\Sage\Controllers\HomePage;


function home_sections() {

  $sections = [];

  // check if the flexible content field has rows of data
  if ( have_rows( 'content_sections' ) ):

    // loop through the rows of data
    while ( have_rows( 'content_sections' ) ) : the_row();

      $section = $posts = [];

      // post types
      if ( get_row_layout() === 'layout_post_types' ):

        $selection = get_sub_field( 'layout_post_type' );

        // Option to hide the title
        if(get_sub_field('post_type_hide_section_title')) {
          $section['title'] = false;
        } else {
          // if showing title, but no title entered
          if(get_sub_field('post_type_section_title') === "") {
            // show the post type name
            $section['title']  = $selection['label'];
          } else {
            // otherwise show the entered title
            $section['title'] = get_sub_field('post_type_section_title');
          }
        }

        $post_type_name = $selection['value'];
        $num_posts       = get_sub_field( 'layout_number_of_posts' );
        $num_columns     = get_sub_field( 'layout_number_of_columns' );

        switch ( $num_columns ) {
          case '1':
            $col = '12';
            break;
          case '2':
            $col = '6';
            break;
          case '3':
            $col = '4';
            break;
          case '4':
            $col = '3';
            break;
          default:
            $col = '12';
        }

        $section['col'] = $col;

        $args = [
          'post_type'      => $post_type_name,
          'posts_per_page' => $num_posts
        ];

        $query = new \WP_Query( $args );

        $posts = [];

        if ( $query->have_posts() ) :
          while ( $query->have_posts() ) : $query->the_post();
            $post = [];

            $post['title']     = get_the_title();
            $post['excerpt']   = get_the_excerpt();
            $post['thumbnail'] = get_the_post_thumbnail('', 'full', ['class' => 'card-img-top']);
            $post['permalink'] = get_the_permalink();

            $posts[] = $post;
          endwhile;
          wp_reset_postdata();
        endif;
      $section['posts'] = $posts;

      // More....
      elseif ( get_row_layout() == 'foo' ):
        // more more more
      endif;

      $sections[] = $section;

    endwhile;
  else :
    // no sections
    $sections = false;
  endif;

  return $sections;
}

