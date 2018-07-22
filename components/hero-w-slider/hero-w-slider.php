<?php
/**
* hero-w-slider
* -----------------------------------------------------------------------------
*
* hero-w-slider component
*/

$defaults = [
  'title' => false,
  'heading' => false,
  'subheading' => false,
  'content' => false,
  'background' => false,
  'looping_video' => false,
  'spotlight_strength' => 0.6
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
$id = ( $component_args['id'] ? $component_args['id'] : uniqid('hero-banner-') );

$section_title      = $component_data['title']['text'];
$section_title_tag  = $component_data['title']['tag'];
$spotlight_strength = $component_data['spotlight_strength'];
$slides             = $component_data['slides'];
?>

<?php if ( ll_empty( $component_data ) ) return; ?>

<div class="ll-hero-w-slider hdg<?php echo implode( " ", $classes ); ?>"<?php echo ' id="'.$id.'"'; ?> data-component="hero-w-slider">

  <?php if( $section_title ) : ?>

  <div class="hero__section_title__container container">

    <<?php echo $section_title_tag; ?> class="hero__section_title hdg__title">
      <?php echo $section_title; ?>
    </<?php echo $section_title_tag; ?>>
    <!-- .hero__section_title -->

  </div>

  <?php endif; ?>

  <div class="hero__slides">

  <?php foreach( $slides as $slide ) : ?>

    <?php

      $css                = uniqid('hero-slide-');
      $page_title         = $slide['hero_w_slider_heading']['text'];
      $page_title_style   = $slide['hero_w_slider_heading']['style'];
      $page_title_tag     = $slide['hero_w_slider_heading']['tag'];
      $main_heading       = $slide['hero_w_slider_subheading']['text'];
      $main_heading_tag   = $slide['hero_w_slider_subheading']['tag'];
      $content            = $slide['hero_w_slider_content'];
      $video              = $slide['hero_w_slider_video'];
      $bg                 = $slide['hero_w_slider_background'];

      if( $bg ) {
        $bg = wp_get_attachment_url($bg);
      }

      if( $bg ) {
        $bg = ' style="background-image:url(' . $bg . ');"';
      }else{
        $bg = '';
      }

      if( $page_title_style ) {
        $ps = ' ' . $page_title_style;
      }else{
        $ps = '';
      }

      ?>
    <div class="hero__slides__slide<?php echo ( $css ? ' ' . $css : '' ); ?>"<?php echo $bg; ?>>

      <div class="container text-center">
      <style>
        .<?php echo $css; ?>:before {
          position: absolute;
          content: '';
          top: 0;
          right: 0;
          bottom: 0;
          left: 0;
          opacity: <?php echo $spotlight_strength; ?>;
          background: linear-gradient(0deg, black 0%, rgba(0,0,0, 0) 100%),
                      radial-gradient(circle, rgba(0,0,0, 0) 0%, black 100%);
        }
      </style>

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

      <?php if( $page_title ) : ?>

        <<?php echo $page_title_tag; ?> class="hero__page_title hdg__title<?php echo $ps; ?>">
          <?php echo $page_title; ?>
        </<?php echo $page_title_tag; ?>>
        <!-- .hero__page_title -->

      <?php endif; ?>

      <?php if( $main_heading ) : ?>

        <<?php echo $main_heading_tag; ?> class="hero__main_heading hdg__heading">
          <?php echo $main_heading; ?>
        </<?php echo $main_heading_tag; ?>>

        <!-- .hero__main_heading -->

      <?php endif; ?>

      <?php if ( $sub_heading ) : ?>

          <<?php echo $sub_heading_tag; ?> class="hero__sub_heading hdg__subheading">
            <?php echo $sub_heading; ?>
          </<?php echo $sub_heading; ?>>
          <!-- .hero__sub_heading -->

      <?php endif; ?>

      <?php if( $content ) : ?>
          <div class="hero__content hdg__content">
            <?php echo format_text($content); ?>
          </div>
          <!-- .hero__content -->

      <?php endif; ?>

      </div>
      <!-- .container -->

    </div>
    <!-- .slide -->
  <?php endforeach; ?>

  </div>
  <!-- .hero__slides -->

</div>
<!-- .ll-hero-w-slider -->