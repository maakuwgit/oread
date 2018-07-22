<?php
/**
* hero-banner
* -----------------------------------------------------------------------------
*
* hero-banner component
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
$page_title         = $component_data['heading']['text'];
$page_title_style   = $component_data['heading']['style'];
$page_title_tag     = $component_data['heading']['tag'];
$main_heading       = $component_data['subheading']['text'];
$main_heading_tag   = $component_data['subheading']['tag'];
$content            = $component_data['content'];
$video              = $component_data['video'];
$spotlight_strength = $component_data['spotlight_strength'];
$bg                 = $component_data['background'];

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

<?php if ( ll_empty( $component_data ) ) return; ?>

<div class="ll-hero-banner hdg<?php echo implode( " ", $classes ); ?>"<?php echo ' id="'.$id.'"'; ?> data-component="hero-banner"<?php echo $bg; ?>>

  <?php if( $bg ) : ?>
  <style>
    #<?php echo $id; ?>:before {
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
<?php endif; ?>

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

  <?php if( $section_title ) : ?>

  <div class="hero__section_title__container container">

    <<?php echo $section_title_tag; ?> class="hero__section_title hdg__title">
      <?php echo $section_title; ?>
    </<?php echo $section_title_tag; ?>>
    <!-- .hero__section_title -->

  </div>

  <?php endif; ?>

  <div class="container text-center">

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

</div>