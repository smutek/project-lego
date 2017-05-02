<?php
use Roots\Sage\Controllers\Branding;
use Roots\Sage\Controllers\BusinessInfo;
use Roots\Sage\Controllers\Navigation;
$social_args = Navigation\social_nav( 'stack circle brand' );
$footer_args = Navigation\footer_nav('nav-pills flex-column flex-sm-row justify-content-center');
?>

<footer class="content-info">
  <div class="container">
    <div class="row">

      <?php if ( is_active_sidebar( 'sidebar-footer' ) ): ?>
        <div class="col footer-widgets">
          <?php dynamic_sidebar( 'sidebar-footer' ); ?>
        </div>
      <?php endif; ?>

      <div class="col footer-brand">
        <?= Branding\footer_logo( 'img-responsive' ); ?>
      </div>

      <div class="col business-info">
        <?php include( locate_template( 'templates/modules/business-info.php' ) ); ?>
      </div>

      <?php if ( has_nav_menu( 'social_navigation' ) ) : ?>
        <div class="col social-nav-wrap">
          <h3>Follow Us</h3>
          <nav class="social-nav" role="navigation">
            <?php wp_nav_menu( $social_args ); ?>
          </nav>
        </div>
      <?php endif; ?>

    </div>
  </div>

  <div class="lower-footer">
    <div class="container">

      <?php if ( has_nav_menu( 'footer_navigation' ) ) : ?>
        <div class="footer-nav-wrap mt-3 mb-3">
          <nav class="footer-nav" role="navigation">
            <?php wp_nav_menu( $footer_args ); ?>
          </nav>
        </div>
      <?php endif; ?>

      <div class="legal d-flex justify-content-center flex-column flex-sm-row">
        <?= BusinessInfo\privacy_policy('small p-2'); ?>
        <?= BusinessInfo\terms_page('small p-2'); ?>
        <?= BusinessInfo\copyright('small p-2'); ?>
      </div>
    </div>
  </div>

</footer>
