<?php
/**
* lr-w-hover
* -----------------------------------------------------------------------------
*
* lr-w-hover component
*/

$defaults = [
  'layout'  => 'image',
  'content' => false,
  'image'   => false,
  'hover'   => false
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
$hover      = $component_data['hover'];

if( $image ) {
  $image = wp_get_attachment_url($image);
}

if( $hover ) {
  $hover = wp_get_attachment_url($hover);
}

if( $hover ){
  $bg = ' style="background-image:url(' . $hover . ');"';
}else{
  $bg = '';
}
?>

<?php if ( ll_empty( $component_data ) ) return; ?>
<div class="ll-lr-w-hover <?php echo $layout . implode( " ", $classes ); ?>" <?php echo ( $component_id ? 'id="'.$component_id.'"' : '' ) ?> data-component="lr-w-hover">

  <div class="container">

    <div class="ll-lr-w-hover__image"<?php echo $bg; ?>>
      <div class="ll-lr-w-hover__image__wrapper">
        <img alt="" src="<?php echo $image; ?>">
      </div>
    </div>
    <!-- .ll-lr-w-hover__image -->

    <div class="ll-lr-w-hover__content">
      <?php echo $content; ?>
    </div>
    <!-- .ll-lr-w-hover__content -->

  </div>

</div>
