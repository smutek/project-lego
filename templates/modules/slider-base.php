<?php $slider = $this->sliderContent(); ?>
<div class="jumbotron">
  <div class="container">

    <?php if ( $slider['heading'] ) : ?>
      <h2 class="display-3 text-center"><?= $slider['heading']; ?></h2>
    <?php endif; ?>

    <div id="<?= $slider['ID']; ?>" class="slider-wrap">

      <ul class="slider list-unstyled" role="listbox">
        <?php foreach ( $slider['slides'] as $slide ) : ?>
          <li class="carousel-item">

            <img class="d-block img-fluid" src="<?= $slide['url']; ?>" alt="<?= $slide['alt']; ?>">

            <div class="carousel-caption d-none d-md-block">
              <?php if ( $slide['title'] ) : ?>
                <h3 class="lead"><?= $slide['title']; ?></h3>
              <?php endif; ?>

              <?php if ( $slide['lead'] ) : ?>
                <p class="lead"><?= $slide['lead']; ?></p>
              <?php endif; ?>

              <?php if ( $slide['content'] ): ?>
                <hr class="my-4">
                <div class="slide-content">
                  <?= $slide['content']; ?>
                </div>
              <?php endif; ?>

              <?php if ( $slide['button'] ) : ?>
                <p class="lead">
                  <?= $slide['button']; ?>
                </p>
              <?php endif; ?>
            </div>

          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</div>
