<?php
  $style = '';
  $form_id = ( get_field('form_id') ? get_field('form_id') : 2 );

  if( get_the_post_thumbnail() ) {
    $style = ' style="background-image: url(' . get_the_post_thumbnail_url() . ');"';
  }else{
    $style = ' style="background-image: url(http://via.placeholder.com/2184x1456);"';
  }
?>
<article <?php post_class('form-skin'); ?>>
  <div class="form-skin__feature"<?php echo $style; ?>>
  <?php if( get_the_post_thumbnail() ) : ?>
    <?php the_post_thumbnail(); ?>
  <?php else : ?>
    <img width="4368" height="2912" src="http://via.placeholder.com/2184x1456" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="" srcset="http://via.placeholder.com/2184x1456 4368w, http://via.placeholder.com/300x200.jpg 300w, http://via.placeholder.com/768x512.jpg 768w, http://via.placeholder.com/1024x683.jpg 1024w" sizes="(max-width: 4368px) 100vw, 4368px">
  <?php endif; ?>
  </div>
  <?php gravity_form( $form_id, true, true ); ?>
</article>
<!-- .entry -->