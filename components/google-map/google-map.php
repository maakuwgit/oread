<?php
/**
* Google Map
* -----------------------------------------------------------------------------
*
* Google Map component
*/

$defaults = [
  'address'   => false,
  'addresses' => false,
  'locations' => false
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
$component_id   = ( $component_args['id'] ? $component_args['id'] : uniqid('google-map-') );

$address    = $component_data['address'];
$addresses  = $component_data['addresses'];
$locations  = $component_data['locations'];
$css = '';

if( $addresses ) {
  $css = " google-map__addresses";
}
?>

<?php if ( ll_empty( $component_data ) ) return; ?>
<div class="ll-google-map <?php echo implode( " ", $classes ); ?>" data-component="google-map">
  <div class="container">
    <div class="google-map__wrapper"<?php echo ( $component_id ? ' id="'.$component_id.'"' : '' ) ?> data-locations='<?php echo json_encode( $locations ); ?>'></div>
    <div class="google-map__infowindow container<?php echo $css; ?>">

      <?php if ( $address ) : ?>

          <?php include( locate_template('templates/partials/info-window.php') ); ?>

      <?php elseif ( $addresses ) : ?>

        <?php foreach ( $addresses as $key => $address ) : ?>

          <?php include( locate_template('templates/partials/info-window.php') ); ?>

        <?php endforeach; ?>

      <?php endif; ?>

    </div>
    <!-- .google-map__infowindow -->

  </div>
  <!-- .container -->

</div>
