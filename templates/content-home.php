<?php
use Roots\Sage\Controllers\HomePage;

$sections = HomePage\home_sections();

foreach ( $sections as $section ):

  ?>

  <section class="home-section">
    <h2><?= $section['title']; ?></h2>
    <div class="row">
      <?php foreach ( $section['posts'] as $post ): ?>
        <div class="col-sm-<?= $section['col']; ?>">
          <div class="thumbnail">
            <?php if ( $post['thumbnail'] ): ?>
              <?= $post['thumbnail']; ?>
            <?php endif; ?>
            <div class="caption">
              <h3 class="card-title"><?= $post['title']; ?></h3>
              <p class="card-text"><?= $post['excerpt']; ?></p>
              <a href="<?= $post['permalink']; ?>" class="btn btn-example">Read More</a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </section>

<?php endforeach; // end sections


