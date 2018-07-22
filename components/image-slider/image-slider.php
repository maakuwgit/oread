<?php
/**
* image-slider
* -----------------------------------------------------------------------------
*
* image-slider component
*/

$defaults = [
  'title_left'  => false,
  'title_right' => false,
  'slides'      => false,
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

$slides      = $component_data['slides'];
$title_right = $component_data['title_right'];
$title_left  = $component_data['title_left'];

?>

<?php if ( ll_empty( $component_data ) ) return; ?>
<div class="ll-image-slider<?php echo implode( " ", $classes ); ?>" <?php echo ( $component_id ? 'id="'.$component_id.'"' : '' ) ?> data-component="image-slider">

  <div class="image-slider__header container">
    <h3 class="image-slider__header__text"><?php echo $title_left; ?></h3>
    <h3 class="image-slider__header__text"><?php echo $title_right; ?></h3>
  </div>

  <div class="image-slider__slides">
 <?php if( $slides ) : ?>

    <?php foreach( $slides as $slide ) : ?>

      <?php

        $img1               = $slide['image_slider_image_one'];
        $img2               = $slide['image_slider_image_two'];

        if( $img1 || $img2 ) {

          if( $img1 ) {
            $img1 = wp_get_attachment_url($img1);
          }

          if( $img2 ) {
            $img2 = wp_get_attachment_url($img2);
          }

        }

        ?>
      <div class="image-slider__slides__slide">

        <div class="image-slider__slides__container container">

        <?php if( $img1 ) : ?>

          <div class="image-slider__image-left" style="background-image:url(<?php echo $img1; ?>">
            <img alt="" src="<?php echo $img1; ?>">
          </div>
          <!-- .image-slider__image-left -->

        <?php endif; ?>

        <?php if( $img2 ) : ?>

          <div class="image-slider__image-right" style="background-image:url(<?php echo $img2; ?>">
            <img alt="" src="<?php echo $img2; ?>">
          </div>
          <!-- .image-slider__image-right -->

        <?php endif; ?>

        </div>
        <!-- .container -->

      </div>
      <!-- .slide -->
    <?php endforeach; ?>

  <?php endif; ?>

  </div>
  <!-- .image-slider__slides -->

  <div class="image-slider__footer container"></div>
  <!-- .image-slider__footer -->

</div>
