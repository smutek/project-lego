<?php
use Roots\Sage\Controllers\Branding;
$social_args = Branding\social_nav('stack circle brand');
$copyright = Branding\copyright();
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

      <div class="col business-info">
        <?php include(locate_template('templates/modules/business-info.php')); ?>
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

  <?php if($copyright) : ?>
    <div class="lower-footer">
      <div class="container">
        <p><small><?= $copyright; ?></small></p>
      </div>
    </div>
  <?php endif; ?>

</footer>
