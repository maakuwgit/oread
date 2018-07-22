<article <?php post_class(); ?>>
  <div class="post">
    <?php

    $hero = array(
      'heading'     => get_field('single-post-banner_hero_heading'),
      'background'  => get_the_post_thumbnail_url( get_the_ID(), 'large' )
    );

      ll_include_component(
        'single-post-hero',
        $hero
      );
    ?>
    <div class="post__content">
     <?php ll_get_breadcrumb(); ?>
      <?php the_content(); ?>
    </div>
    <footer class="post__footer">
      <?php wp_link_pages(array('before' => '<nav class="post__footer__nav"><p>' . __('Pages:', 'roots'), 'after' => '</p></nav>')); ?>
    </footer>
    <?php // get_template_part('templates/partials/comments'); ?>
  </div><!-- /.post -->
</article>
