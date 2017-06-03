<?php

// check if the flexible content field has rows of data
if ( have_rows( 'content_sections' ) ):

  // loop through the rows of data
  while ( have_rows( 'content_sections' ) ) : the_row();

    if ( get_row_layout() == 'layout_post_types' ):

      $type = get_sub_field( 'layout_post_type' );

      echo $type['label'];
      echo $type['value'];

    elseif ( get_row_layout() == 'foo' ):

    endif;

  endwhile;

else :

  // no layouts found

endif;


?>

<?php the_content(); ?>
<?php wp_link_pages( [ 'before' => '<nav class="page-nav"><p>' . __( 'Pages:', 'sage' ), 'after' => '</p></nav>' ] ); ?>
