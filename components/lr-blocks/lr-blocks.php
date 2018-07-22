<?php
/**
* lr-blocks
* -----------------------------------------------------------------------------
*
* lr-blocks component
*/

$defaults = [
  'show_steps' => false,
  'content'    => false,
  'background' => false,
  'video'      => false
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

$show_steps = $component_data['show_steps'];
$content    = $component_data['content'];
$bg         = $component_data['background'];
$video      = $component_data['video'];

if( $bg ) {
  $bg = wp_get_attachment_url($bg);
}

if( $bg ){
  $bg = ' style="background-image:url(' . $bg . ');"';
}else{
  $bg = '';
}

$num = '';
if( $show_steps ) {
  $num = '<span class="ll-lr-block__index"></span>';
}

?>

<?php if ( ll_empty( $component_data ) ) return; ?>
<div class="ll-lr-blocks<?php echo implode( " ", $classes ); ?>" <?php echo ( $component_id ? 'id="'.$component_id.'"' : '' ) ?> data-component="lr-blocks"<?php echo $bg; ?>>

 <?php if( $video ) : ?>
  <a class="ll-lr-blocks__image__cta js-init-video play-video-button" href="<?php echo $video; ?>" data-component="modal">
    <svg class="icon icon-play"><use xlink:href="#icon-play"></use></svg>Watch Video</span>
  </a>
<?php endif; ?>

  <div class="container">

    <div class="ll-lr-blocks__block">
      <?php echo $num . $content; ?>
    </div>

  </div>

</div>
