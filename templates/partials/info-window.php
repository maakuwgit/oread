<?php
  $lat = ( $key ? $locations[$key]['lat'] : $locations['lat'] );
  $lng = ( $key ? $locations[$key]['lng'] : $locations['lng'] );
?>
<div class="google-map__infowindow-content dark-bg" data-map-lat="<?php echo $lat; ?>" data-map-lng="<?php echo $lng; ?>">

  <h2 class="google-map__infowindow-content__title"><?php echo $address['title']; ?></h2>
  <h3 class="google-map__infowindow-content__supertitle">Find Us</h3>

  <address class="google-map__infowindow-content__address">
    <?php echo $address['address']; ?>
  </address>

  <a class="google-map__infowindow-content__phone" href="tel:+1<?php echo strip_phone( $address['phone'] ); ?>"><?php echo format_phone($address['phone'],false,'.'); ?></a>

<?php if ( $address['hours'] ) : ?>
  <div class="google-map__infowindow-content__hours">
    <?php echo format_text( $address['hours'] ) ?>
  </div>
<?php endif; ?>

<a class="btn" href="https://www.google.com/maps/place/<?php echo $address['address']; ?>" target="_blank">Directions</a>

</div> <!-- /.google-map__infowindow-content -->