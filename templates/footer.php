<?php
use Roots\Sage\Controllers\Branding;
?>
<footer class="content-info">
  <div class="container">
    <div class="footer-widgets">
      <?php dynamic_sidebar('sidebar-footer'); ?>
    </div>
    <div class="footer-brand">
      <?= Branding\footer_logo('img-responsive'); ?>
    </div>
  </div>
</footer>
