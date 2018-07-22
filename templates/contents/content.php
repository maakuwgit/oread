<article <?php post_class('entry'); ?>>
  <?php if( get_the_post_thumbnail() ) : ?>
    <?php the_post_thumbnail(); ?>
  <?php endif; ?>

  <header class="entry__header">

    <?php get_template_part('templates/partials/post-meta'); ?>

    <h2 class="entry__header__title">
      <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
    </h2>
    <!-- .entry__header__title -->

  </header>
  <!-- .entry__header -->

  <div class="entry__summary">
    <?php the_excerpt(); ?>
  </div>
  <!-- .entry__summary -->

  <div class="entry__meta">
    <?php
      $tags       = get_the_tags();
      $categories = get_the_category();

      if ($tags) :
        foreach($tags as $tag) : ?>

          <a class="entry__meta_tag" href="<?php echo get_tag_link($tag->term_id); ?>"><?php echo $tag->name; ?></a>
          <!-- .entry__meta_tag -->

      <?php
        endforeach;

      endif;

      if ($categories) :

        foreach($categories as $category) :

          if( $category->term_id > 1 ) : ?>

          <a class="entry__meta_category" href="<?php echo get_tag_link($category->term_id); ?>"><?php echo $category->name; ?></a>
          <!-- .entry__meta_category -->

          <?php endif;

        endforeach;

      endif;
    ?>
  </div>
  <!-- .entry__meta -->

</article>
<!-- .entry -->