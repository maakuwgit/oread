<?php
/**
* interactive-image
* -----------------------------------------------------------------------------
*
* interactive-image component
*/

$defaults = [
  'image_1' => false,
  'image_2' => false,
  'content' => false
];

$component_data = ll_parse_args( $component_data, $defaults );
?>

<?php
/**
 * Any additional classes to apply to the main component container.
 *
 * @var array
 * @see args['classes']
 */
$classes        = $component_args['classes'] ?: array();

/**
 * ID to apply to the main component container.
 *
 * @var array
 * @see args['id']
 */
$component_id   = $component_args['id'];
$main_img       = $component_data['image_1'];
$overlay_img    = $component_data['image_2'];
$content        = $component_data['content'];

if( $main_img ) {
  $main_img = wp_get_attachment_image_url( $main_img, 'large' );
}

if( $overlay_img ) {
  $overlay_img = wp_get_attachment_image_url( $overlay_img, 'large' );
}

?>

<?php if ( ll_empty( $component_data ) ) return; ?>
<div class="ll-interactive-image <?php echo implode( " ", $classes ); ?>" <?php echo ( $component_id ? 'id="'.$component_id.'"' : '' ) ?> data-component="interactive-image">

  <div class="container">

    <figure class="interactive-image__images">

      <div class="interactive-image__images__before">
        <img class="interactive-image__images__main" alt="" src="<?php echo $main_img; ?>">
        <!-- .interactive-image__images__main -->
      </div>
      <!-- .interactive-image__images__before -->

      <div class="interactive-image__images__after">
        <img class="interactive-image__images__overlay" alt="" src="<?php echo $overlay_img; ?>">
        <!-- .interactive-image__images__overlay -->
      </div>
      <!-- .interactive-image__images__after -->

      <div class="interactive-image__track"></div>
      <!-- .interactive-image__track -->

      <div class="interactive-image__handle"></div>
      <!-- .interactive-image__handle -->

    </figure>
    <!-- .interactive-image__images -->

  <?php if( $content ): ?>
    <div class="interactive-image__caption">
      <?php echo $content; ?>
    </div>
  <?php endif; ?>

  </div>
  <!-- .container -->

</div>
