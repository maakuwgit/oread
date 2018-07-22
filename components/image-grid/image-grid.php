<?php
/**
* image-grid
* -----------------------------------------------------------------------------
*
* image-grid component
*/

$defaults = [
  'title'    => false,
  'images'   => false,
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
$title      = $component_data['title']['text'];
$title_tag  = $component_data['title']['tag'];
$images     = $component_data['images'];
?>

<?php if ( ll_empty( $component_data ) ) return; ?>
<div class="ll-image-grid <?php echo $layout . implode( " ", $classes ); ?>" <?php echo ( $component_id ? 'id="'.$component_id.'"' : '' ) ?> data-component="image-grid">

  <div class="container text-center">

<?php if( $title ) : ?>

    <<?php echo $title_tag; ?> class="ll-image-grid__title">
      <?php echo $title; ?>
    </<?php echo $title_tag; ?>>
    <!-- .ll-item-grid__title -->

<?php endif; ?>

<?php if( $images ) : ?>

  <ul class="ll-image-grid__items">

  <?php
    foreach( $images as $image ) :

      $img      = $image['image_grid_image'];
      $caption  = $image['image_grid_caption'];

      if( $img ) :
        $bg = '';
        $img = wp_get_attachment_url($img);

        if( $img ) {
          $bg = ' style="background-image:url(' . $img . ');"';
        }
  ?>
    <li class="ll-image-grid__item">

      <div class="ll-image-grid__image"<?php echo $bg; ?>>
        <img alt="" src="<?php echo $img; ?>">
      </div>
      <!-- .ll-image-grid__image -->

    <?php if( $caption ) : ?>
      <div class="ll-image-grid__content">
        <h3 class="ll-image-grid__content__caption"><?php echo $caption; ?></h3>
      </div>
      <!-- .ll-image-grid__content -->
    <?php endif; ?>

    </li>
    <!-- .ll-image-grid-item -->

    <?php endif; ?>

  <?php endforeach; ?>

  </ul>

<?php endif; ?>

  </div>

</div>