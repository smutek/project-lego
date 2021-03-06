<article <?php post_class('col-sm-4'); ?>>
  <div class="card">
    <?php if(has_post_thumbnail()) : ?>
      <?php the_post_thumbnail(); ?>
    <?php else : ?>
      <img class="card-img-top" src="holder.js/600x200">
    <?php endif; ?>
    <div class="card-block">
      <header>
        <h2 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <?php get_template_part('templates/entry-meta'); ?>
      </header>
      <div class="card-summary card-text">
        <?php the_excerpt(); ?>
      </div>
      <footer>
        <a href="<?php the_permalink(); ?>" class="btn btn-primary">Read More</a>
      </footer>
    </div>
  </div>
</article>

