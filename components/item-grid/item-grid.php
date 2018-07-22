<?php
/**
* item-grid
* -----------------------------------------------------------------------------
*
* item-grid component
*/
$defaults = [
  'title' => false,
  'items'   => false,
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
$items     = $component_data['items'];
?>

<?php if ( ll_empty( $component_data ) ) return; ?>
<div class="ll-item-grid <?php echo $layout . implode( " ", $classes ); ?>" <?php echo ( $component_id ? 'id="'.$component_id.'"' : '' ) ?> data-component="item-grid">

  <div class="container text-center">

<?php if( $title ) : ?>

    <<?php echo $title_tag; ?> class="ll-item-grid__title">
      <?php echo $title; ?>
    </<?php echo $title_tag; ?>>
    <!-- .ll-item-grid__title -->

<?php endif; ?>

<?php if( $items ) : ?>
  <ul class="ll-item-grid-items">
  <?php
    foreach( $items as $item ) :
      $image    = $item['item_grid_image'];
      $hover    = $item['item_grid_hover'];
      $caption  = $item['item_grid_caption'];

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
    <li class="ll-item-grid-item">

      <div class="ll-item-grid__image"<?php echo $bg; ?>>
        <div class="ll-item-grid__image__wrapper">
          <img alt="" src="<?php echo $image; ?>">
        </div>
      </div>
      <!-- .ll-item-grid__image -->

    <?php if( $caption ) : ?>
      <div class="ll-item-grid__content">
        <h3 class="ll-item-grid__content__main_caption"><?php echo $caption['main_caption']; ?></h3>
        <h4 class="ll-item-grid__content__sub_caption"><?php echo $caption['sub_caption']; ?></h4>
      </div>
      <!-- .ll-item-grid__content -->
    <?php endif; ?>

    </li>
    <!-- .ll-item-grid-item -->

  <?php endforeach; ?>
  </ul>
<?php endif; ?>
  </div>

</div>