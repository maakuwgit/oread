<?php
/**
* comparison-table
* -----------------------------------------------------------------------------
*
* comparison-table component
*/

$defaults = [
  'title_left' => false,
  'title_right' => false,
  'items_left' => false,
  'items_right' => false
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
$l_title        = $component_data['title_left'];
$l_rows         = $component_data['items_left'];
$r_title        = $component_data['title_right'];
$r_rows         = $component_data['items_right'];

?>

<?php if ( ll_empty( $component_data ) ) return; ?>

<div class="ll-comparison-table dark-bg<?php echo implode( " ", $classes ); ?>" <?php echo ( $component_id ? 'id="'.$component_id.'"' : '' ) ?> data-component="comparison_table">

  <div class="container text-center">

  <?php if( $l_rows || $r_rows ) : ?>

    <table class="ll-comparison-table__table">

    <?php if( $l_title ) : ?>
      <tr class="ll-comparison-table__title__row">
        <th class="ll-comparison-table__title__cell">
          <?php echo $l_title; ?>
        </th>
      </tr>
      <!-- .ll-comparison-table__title -->
    <?php endif; ?>

    <?php foreach( $l_rows as $row ) : ?>

      <tr class="ll-comparison-table__table__row">

      <?php if( $row['text']) : ?>
        <td class="ll-comparison-table__table__cell">
          <?php echo $row['text']; ?>
        </td>
        <!-- .ll-comparison-table__table__title -->
      <?php endif; ?>

      </tr>
      <!-- .ll-comparison-table__table -->

    <?php endforeach; ?>

    </table>
    <!-- .ll-comparison-table__table -->
    <div class="ll-comparison-table__vs">VS.</div>
    <table class="ll-comparison-table__table">

    <?php if( $r_title ) : ?>
      <tr class="ll-comparison-table__title__row">
        <th class="ll-comparison-table__title__cell">
          <?php echo $r_title; ?>
        </th>
      </tr>
      <!-- .ll-comparison-table__title -->
    <?php endif; ?>

    <?php foreach( $r_rows as $row ) : ?>

      <tr class="ll-comparison-table__table__row">

      <?php if( $row['text']) : ?>
        <td class="ll-comparison-table__table__cell">
          <?php echo $row['text']; ?>
        </td>
        <!-- .ll-comparison-table__table__title -->
      <?php endif; ?>

      </tr>
      <!-- .ll-comparison-table__table -->

    <?php endforeach; ?>


    </table>
    <!-- .ll-comparison-table__table -->
  <?php endif; ?>

  </div>
  <!-- .container.text-center -->

</div>