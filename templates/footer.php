<?php
use Roots\Sage\Controllers\Branding;
use Roots\Sage\Controllers\BusinessInfo;
$social_args = Branding\social_nav( 'stack circle brand' );
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
        <div class="col footer-social">
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
      <div class="legal d-flex flex-column flex-sm-row">
        <?= BusinessInfo\privacy_policy('small p-l-0 p-2'); ?>
        <?= BusinessInfo\terms_page('small p-2'); ?>
        <?= BusinessInfo\copyright('small ml-sm-auto p-2'); ?>
      </div>
    </div>
  </div>

</footer>
