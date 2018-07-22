<?php
/**
* location-grid
* -----------------------------------------------------------------------------
*
* location-grid component
*/

$defaults = [
  'title'     => false,
  'sub_title' => false,
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
$subtitle   = $component_data['sub_title'];
?>

<?php if ( ll_empty( $component_data ) ) return; ?>
<div class="ll-location-grid <?php echo implode( " ", $classes ); ?>" <?php echo ( $component_id ? 'id="'.$component_id.'"' : '' ) ?> data-component="location-grid">

  <div class="container text-center">

<?php if( $title ) : ?>

    <<?php echo $title_tag; ?> class="ll-location-grid__title">
      <?php echo $title; ?>
    </<?php echo $title_tag; ?>>
    <!-- .ll-location-grid__title -->

<?php endif; ?>

<?php if( $subtitle ) : ?>

    <h3 class="ll-location-grid__sub_title text-uppercase">
      <?php echo $subtitle; ?>
    </h3>
    <!-- .ll-location-grid__sub_title -->

<?php endif; ?>

<?php
  $args = array(
            'post_type'     => 'location',
            'post_status'   => 'publish',
            'order'         => 'ASC',
            'showposts'     => -1
          );

  $locations = new WP_Query( $args );

  if ( $locations->have_posts() ) :
?>
    <div class="ll-location-grid__locations">
      <?php while( $locations->have_posts() ) : ?>
        <?php
          $locations->the_post();
          $address = get_field('location_address');
          $phone   = get_field('location_phone');
        ?>
        <div class="ll-location-grid__location">
          <h4 class="ll-location-grid__location__title"><?php echo the_title(); ?></h4>

          <?php if( $address ) : ?>
            <address class="ll-location-grid__location__address"><?php echo $address; ?></address>
          <?php endif; ?>

          <?php if( $phone ) : ?>
            <a class="ll-location-grid__location__phone" href="tel:+1<?php echo $phone; ?>"><?php echo format_phone($phone, false, '.'); ?></a>
          <?php endif; ?>

          <a class="btn btn--secondary" href="<?php the_permalink(); ?>">Learn More</a>
        </div>
      <?php endwhile; ?>
    </div>

  <?php wp_reset_postdata(); ?>
<?php endif; ?>
</div>