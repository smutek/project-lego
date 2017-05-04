<?php $slider = $this->sliderContent(); ?>
<div class="jumbotron">
  <div class="container slider-inner">

    <?php if ( $slider['heading'] ) : ?>
      <h2 class="display-3 text-center"><?= $slider['heading']; ?></h2>
    <?php endif; ?>

    <div id="<?= $slider['ID']; ?>" class="carousel slide" data-ride="carousel">

      <ol class="carousel-indicators">
        <?php foreach ($slider['indicators'] as $indicator) : ?>
          <?= $indicator; ?>
        <?php endforeach; ?>
      </ol>

      <div class="carousel-inner" role="listbox">
        <?php foreach ($slider['slides'] as $slide) : ?>
        <div class="<?= $slide['classes']; ?>">
          <img class="d-block img-fluid" src="<?= $slide['url']; ?>" alt="<?= $slide['alt']; ?>">


          <div class="carousel-caption d-none d-md-block">

            <?php if ( $slide['title'] ) : ?>
              <p class="lead"><?= $slide['title']; ?></p>
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


        </div>
        <?php endforeach; ?>
      </div>

      <a class="carousel-control-prev" href="#<?= $slider['ID']; ?>" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#<?=$slider['ID']; ?>" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>

    </div>
  </div>
</div>
