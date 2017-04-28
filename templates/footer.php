<?php
use Roots\Sage\Controllers\Branding;
$social_args = Branding\social_nav('flex-column');
?>
<footer class="content-info">
  <div class="container">
    <div class="row">

      <?php if(is_active_sidebar('sidebar-footer')): ?>
        <div class="col footer-widgets">
          <?php dynamic_sidebar( 'sidebar-footer' ); ?>
        </div>
      <?php endif; ?>

      <div class="col footer-brand">
        <?= Branding\footer_logo( 'img-responsive' ); ?>
      </div>

      <?php if ( has_nav_menu( 'social_navigation' ) ) : ?>
        <div class="col footer-social">
          <h3>Follow Us</h3>
          <nav class="social-nav" role="navigation">
            <?php wp_nav_menu( $social_args ); ?>
          </nav>
        </div>
      <?php endif; ?>

    </div>

  </div>
</footer>
