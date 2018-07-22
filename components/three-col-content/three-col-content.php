<?php
/**
* three-col-content
* -----------------------------------------------------------------------------
*
* three-col-content component
*/

$defaults = [
  'title' => false,
  'columns'   => false,
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

$title     = $component_data['title']['text'];
$title_tag = $component_data['title']['tag'];
$columns   = $component_data['columns'];
?>

<?php if ( ll_empty( $component_data ) ) return; ?>
<div class="ll-three-col-content <?php echo implode( " ", $classes ); ?>" <?php echo ( $component_id ? 'id="'.$component_id.'"' : '' ) ?> data-component="three-col-content">

  <div class="ll-three-col-content__title__wrapper container">

  <?php if( $title ) : ?>

    <<?php echo $title_tag; ?> class="ll-three-col-content__title">
      <?php echo $title; ?>
    </<?php echo $title_tag; ?>>
    <!-- .ll-item-grid__title -->

  <?php endif; ?>

  </div>

  <div class="ll-three-col-content__column__container container">

  <?php
    foreach( $columns as $column ) :
      $ctitle   = $column['three_column_content_title'];
      $ccontent = $column['three_column_content_content'];
  ?>
    <div class="ll-three-col-content__column">
      <h3 class="ll-three-col-content__column__header"><?php echo $ctitle; ?></h3>
      <?php echo format_text($ccontent); ?>
    </div>
  <?php endforeach; ?>

  </div>
</div>
