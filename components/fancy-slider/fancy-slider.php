<?php
/**
* fancy-slider
* -----------------------------------------------------------------------------
*
* fancy-slider component
*/

$defaults = [
  'slides' => false
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

$slides = $component_data['slides'];
?>

<?php if ( ll_empty( $component_data ) ) return; ?>
<div class="ll-fancy-slider hdg<?php echo implode( " ", $classes ); ?>" <?php echo ( $component_id ? 'id="'.$component_id.'"' : '' ) ?> data-component="fancy-slider">


  <div class="fancy-slider__slides">

  <?php foreach( $slides as $slide ) : ?>

    <?php

      $big_text           = $slide['fancy_slider_heading'];
      $content            = $slide['fancy_slider_content'];
      $video              = $slide['fancy_slider_video'];
      $bg                 = $slide['fancy_slider_background_image'];

      if( $bg ) {
        $bg = wp_get_attachment_url($bg);
      }

      if( $bg ) {
        $bg = ' style="background-image:url(' . $bg . ');"';
      }else{
        $bg = '';
      }

      ?>
    <div class="fancy-slider__slides__slide"<?php echo $bg; ?>>

      <div class="container">

      <?php

        if( $video ) {

          $loop_video = array(
            'video' => $video,
            'fallback' => wp_get_attachment_url($bg)
          );

          ll_include_component(
            'loop-video',
            $loop_video
          );
        }

      ?>

      <?php if( $big_text ) : ?>

        <h3 class="fancy-slider__big_text hdg__title<?php echo $ps; ?>">
          <?php echo $big_text; ?>
        </h3>
        <!-- .fancy-slider__big_text -->

      <?php endif; ?>

      <?php if( $content ) : ?>
          <div class="fancy-slider__content hdg__content">
            <?php echo format_text($content); ?>
          </div>
          <!-- .fancy-slider__content -->

      <?php endif; ?>

      </div>
      <!-- .container -->

    </div>
    <!-- .slide -->
  <?php endforeach; ?>

  </div>
  <!-- .fancy-slider__slides -->

</div>
