<?php
/**
* call-to-action
* -----------------------------------------------------------------------------
*
* call-to-action component
*/

$defaults = [
  'title'     => false,
  'show_logo' => true,
  'content'   => ''
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
$show_logo      = $component_data['show_logo'];
$title          = $component_data['title'];
$content        = $component_data['content'];
?>

<?php if ( ll_empty( $component_data ) ) return; ?>
<div class="ll-call-to-action<?php echo implode( " ", $classes ); ?>" <?php echo ( $component_id ? 'id="'.$component_id.'"' : '' ) ?> data-component="call-to-action">
  <div class="container">
  <?php if( $show_logo ) : ?>
    <?php echo ll_get_logo('centered'); ?>
  <?php endif; ?>

  <?php if( $title ) : ?>

    <<?php echo $title['tag']; ?> class="cta__section_title">
      <?php echo $title['text']; ?>
    </<?php echo $title['tag']; ?>>
    <!-- .cta__section_title -->

  <?php endif; ?>

  <?php if( $content ) : ?>
    <div class="cta__content">
      <?php echo format_text($content); ?>
    </div>
    <!-- .cta__content -->
  <?php endif; ?>

  </div>
</div>
