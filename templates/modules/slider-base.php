<?php $slider = $this->sliderContent(); ?>
<div class="jumbotron">
  <div class="container">

    <?php if ( $slider['heading'] ) : ?>
      <h2 class="text-center"><?= $slider['heading']; ?></h2>
    <?php endif; ?>

    <div id="<?= $slider['ID']; ?>" class="slider-wrap">

      <ul class="slider" role="listbox">
        <?php foreach ( $slider['slides'] as $slide ) : ?>
          <li class="slide-item">

            <img class="img-responsive" src="<?= $slide['url']; ?>" alt="<?= $slide['alt']; ?>">

            <div class="carousel-caption">
              <?php if ( $slide['title'] ) : ?>
                <h3 class="slide-lead"><?= $slide['title']; ?></h3>
              <?php endif; ?>

              <?php if ( $slide['lead'] ) : ?>
                <p class="lead"><?= $slide['lead']; ?></p>
              <?php endif; ?>

              <?php if ( $slide['content'] ): ?>
                <hr>
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
