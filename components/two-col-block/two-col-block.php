<?php
/**
* two-col-block
* -----------------------------------------------------------------------------
*
* two-col-block component
*/

$defaults = [
  'l_title'     => false,
  'l_intro' => false,
  'l_content' => false,
  'r_title'     => false,
  'r_intro' => false,
  'r_content' => false
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

$l_title      = $component_data['l_title'];
$l_intro      = $component_data['l_intro'];
$l_content    = $component_data['l_content'];

$r_title      = $component_data['r_title'];
$r_intro      = $component_data['r_intro'];
$r_content    = $component_data['r_content'];
?>

<?php if ( ll_empty( $component_data ) ) return; ?>
<div class="ll-two-col-block <?php echo implode( " ", $classes ); ?>" <?php echo ( $component_id ? 'id="'.$component_id.'"' : '' ) ?> data-component="two-col-block">

  <div class="container">

    <div class="ll-two-col-block__block">
      <h2 class="ll-two-col-block__block__header"><?php echo $l_title; ?></h2>
      <p class="ll-two-col-block__block__subheader large"><?php echo $l_intro; ?></p>
      <?php echo $l_content; ?>
    </div>
    <!-- .ll-two-col-block__block -->

    <div class="ll-two-col-block__block">
      <h2 class="ll-two-col-block__block__header"><?php echo $r_title; ?></h2>
      <p class="ll-two-col-block__block__subheader large"><?php echo $r_intro; ?></p>
      <?php echo $r_content; ?>
    </div>
    <!-- .ll-two-col-block__block -->

  </div>
</div>
