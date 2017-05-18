<nav class="navbar navbar-toggleable-md navbar-inverse bg-inverse">
  <div class="container">

    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <?php the_custom_logo(); ?>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <?php
      if (has_nav_menu('primary_navigation')) :
        wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'navbar-nav mr-auto']);
      endif;
      ?>
      <?php get_search_form(); ?>
    </div>

  </div>
</nav>
