<div class="entry__meta__wrapper">
  <time class="published entry__header__time" datetime="<?php echo get_the_time('c'); ?>">
    <?php echo get_the_date(); ?>
  </time>

  <p class="entry__header__categories">
   <?php
    $tags       = get_the_tags();
    $categories = get_the_category();
    if ($tags) {
      foreach($tags as $tag) {
        echo $tag->name;
      }
    }
    if ($categories) {
      foreach($categories as $category) {
        if( $category->term_id > 1 ) {
          echo $category->name;
        }
      }
    }
  ?></p>

  <p class="entry__header__author byline author vcard"><?php echo __('by ', 'roots'); ?><?php echo get_the_author(); ?></p>

</div>