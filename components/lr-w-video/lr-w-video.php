<?php
/**
* lr-w-video
* -----------------------------------------------------------------------------
*
* lr-w-video component
*/

$defaults = [
  'layout'  => 'image',
  'content' => false,
  'image'   => false,
  'video'   => false
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

$layout     = $component_data['layout'];
$content    = $component_data['content'];
$image      = $component_data['image'];
$video      = $component_data['video'];

if( $image ) {
  $image = wp_get_attachment_url($image);
}

if( $image ){
  $bg = ' style="background-image:url(' . $image . ');"';
}else{
  $bg = '';
}
?>

<?php if ( ll_empty( $component_data ) ) return; ?>
<div class="ll-lr-w-video <?php echo $layout . implode( " ", $classes ); ?>" <?php echo ( $component_id ? 'id="'.$component_id.'"' : '' ) ?> data-component="lr-w-video">

  <div class="container">

    <div class="ll-lr-w-video__content">
      <?php echo $content; ?>
    </div>
    <!-- .ll-lr-w-video__content -->

    <div class="ll-lr-w-video__image"<?php echo $bg; ?>>

      <a class="ll-lr-w-video__image__cta js-init-video play-video-button" href="<?php echo $video; ?>" data-component="modal">
        <svg class="icon icon-play"><use xlink:href="#icon-play"></use></svg>Watch Video</span>
      </a>

      <img alt="" src="<?php echo $image; ?>">

    </div>
    <!-- .ll-lr-w-video__image -->

  </div>

</div>
