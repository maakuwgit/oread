<?php
  $form_id = ( get_field('form_id') ? get_field('form_id') : 1 );
?>
<article <?php post_class('form-skin'); ?>>
  <?php gravity_form( $form_id, true, true ); ?>
</article>
<!-- .entry -->