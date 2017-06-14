<?php
use Roots\Sage\Controllers\Branding;
use Roots\Sage\Controllers\BusinessInfo;
use Roots\Sage\Controllers\Navigation;
$social_args = Navigation\social_nav( 'stack circle brand' );
$footer_args = Navigation\footer_nav('nav-pills');
?>

<footer class="content-info">
  <div class="container">
    <div class="row">

      <div class="col-sm-4 footer-brand">
        <?= Branding\footer_logo( 'img-responsive' ); ?>
      </div>

      <div class="col-sm-4 business-info">
        <?php include( locate_template( 'templates/modules/business-info.php' ) ); ?>
      </div>

      <?php if ( has_nav_menu( 'social_navigation' ) ) : ?>
        <div class="col-sm-4 social-nav-wrap">
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
      <div class="row">
        <?php if ( has_nav_menu( 'footer_navigation' ) ) : ?>
          <div class="footer-nav-wrap col-sm-6">
            <nav class="footer-nav" role="navigation">
              <?php wp_nav_menu( $footer_args ); ?>
            </nav>
          </div>
        <?php endif; ?>

        <div class="legal col-sm-6">
          <?= BusinessInfo\privacy_policy('small p-2'); ?>
          <?= BusinessInfo\terms_page('small p-2'); ?>
          <?= BusinessInfo\copyright('small p-2'); ?>
        </div>
      </div>
    </div>
  </div>

</footer>
