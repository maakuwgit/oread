<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <meta name="format-detection" content="telephone=no">

  <?php
  $environment = get_field( 'global_environment', 'option' );
  $google_analytics = get_field( 'global_google_analytics', 'option' );
  $bugherd_project_key = get_field( 'global_bugherd_project_key', 'option' );
  ?>

  <?php if ( $environment == 'production' && isset( $google_analytics ) ) { // Google Analytics
    echo $google_analytics;
  } ?>

  <?php if ( $environment == 'development' && isset( $bugherd_project_key ) ) : ?>
    <script>
    (function (d, t) {
      var bh = d.createElement(t), s = d.getElementsByTagName(t)[0];
      bh.type = 'text/javascript';
      bh.src = 'https://www.bugherd.com/sidebarv2.js?apikey=<?php echo $bugherd_project_key; ?>';
      s.parentNode.insertBefore(bh, s);
      })(document, 'script');
    </script>
  <?php endif; ?>

  <?php wp_head(); ?>
</head>
