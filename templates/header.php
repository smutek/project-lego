<header class="banner navbar navbar-inverse navbar-static-top" role="banner">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only"><?= __( 'Toggle navigation', 'sage' ); ?></span>
        <i class="fa fa-bars" aria-hidden="true"></i>
      </button>
      <?php the_custom_logo(); ?>
    </div>


    <nav class="collapse navbar-collapse" role="navigation">
      <?php
      if ( has_nav_menu( 'primary_navigation' ) ) :
        wp_nav_menu( [ 'theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav' ] );
      endif;
      ?>
      <?php get_search_form(); ?>
    </nav>
  </div>
</header>
