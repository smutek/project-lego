<?php $jumbotron = $this->jumbotronContent(); ?>
<div class="jumbotron"<?= $jumbotron['background']; ?>>
  <div class="container">

    <?php if ( $jumbotron['heading'] ) : ?>
      <h1 class="display-3"><?= $jumbotron['heading']; ?></h1>
    <?php endif; ?>

    <?php if ( $jumbotron['lead'] ) : ?>
      <p class="lead"><?= $jumbotron['lead']; ?></p>
    <?php endif; ?>

    <?php if ( $jumbotron['copy'] ): ?>
      <hr class="my-4">
      <div class="jumbotron-content">
        <?= $jumbotron['copy']; ?>
      </div>
    <?php endif; ?>

    <?php if ( $jumbotron['button'] ) : ?>
      <p class="lead">
        <?= $jumbotron['button']; ?>
      </p>
    <?php endif; ?>

  </div>
</div>
