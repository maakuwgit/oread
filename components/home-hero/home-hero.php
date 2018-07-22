<?php
/**
* hero-banner
* -----------------------------------------------------------------------------
*
* hero-banner component
*/

$defaults = [
  'title' => 'Lorem Ipsum',
  'headings' => false,
  'subheading' => false,
  'content' => false,
  'background' => false,
  'looping_video' => false,
  'popup_video' => false,
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
$page_titles        = $component_data['headings'];
$main_heading       = $component_data['subheading']['text'];
$main_heading_tag   = $component_data['subheading']['tag'];
$content            = $component_data['content'];
$looping_video      = $component_data['looping_video'];
$popup              = $component_data['popup_video'];
$spotlight_strength = $component_data['spotlight_strength'];
$bg                 = $component_data['background'];

$page_title = [];
if( $page_titles[0]['text'] ) {
  $page_title = $page_titles;
}else{
  foreach( $page_titles as $title ){
    $page_title[]['text'] = $title['text'];
    $page_title[]['tag'] = $title['tag'];
  }
}

if( $bg ) {
  $bg = wp_get_attachment_url($bg);
}

if( $looping_video ){
  $video = array(
    'video'    => $looping_video,
    'fallback' => $bg
  );

  $bg = '';
}elseif( $bg ){
  $bg = ' style="background-image:url(' . $bg . ');"';
}else{
  $bg = '';
}

?>

<?php if ( ll_empty( $component_data ) ) return; ?>

<div class="ll-home-hero hdg typing-banner<?php echo implode( " ", $classes ); ?>"<?php echo ' id="'.$id.'"'; ?> data-component="home-hero"<?php echo $bg; ?>>

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

  <?php if( $video ) : ?>
    <?php
    ll_include_component(
        'loop-video',
        $video
    );
    ?>
  <?php endif; ?>

  <div class="container text-center">

    <<?php echo $section_title_tag; ?> class="hero__section_title hdg__title">
      <?php echo $section_title; ?>
    </<?php echo $section_title_tag; ?>>
    <!-- .hero__section_title -->

  <?php if( $page_titles ) : ?>
    <div class="hero__page_title__wrapper">
    <?php
    $data = [];

    foreach( $page_title as $title ) {
      $data[] = $title['text'];
    }
    ?>
      <<?php echo $title['tag']; ?> class="hero__page_title hdg__title" data-type-it="<?php echo implode(', ', $data); ?>"><span class="type-it"></span>
      </<?php echo $title['tag']; ?>>
      <!-- .hero__page_title -->
    </div>
    <!-- .hero__page_title__wrapper -->
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
    <div class="hero__content hdg__content">';
      <?php echo format_text($content);?>
    </div>
    <!-- .hero__content-->
  <?php endif; ?>

  <?php if ( $popup_video ) : ?>
    <a href="<?php echo $popup_video; ?>" target="_self" class="play-video-button js-init-video">Play</a>
  <?php elseif ( $looping_video ) : ?>
    <button  class="play-video-button js-play-video">Play</button>
  <?php endif; ?>

  </div>
</div>