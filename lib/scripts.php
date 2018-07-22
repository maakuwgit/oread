<?php
/**
 * Scripts and stylesheets
 *
 * Enqueue stylesheets in the following order:
 * 1. /theme/assets/css/main.css
 *
 * Enqueue scripts in the following order:
 * 1. jquery-2.1.4.min.js via Google CDN
 * 2. /theme/assets/js/vendor/modernizr.min.js
 * 3. /theme/assets/js/scripts.js (in footer)
 *
 * Google Analytics is loaded after enqueued scripts if:
 * - An ID has been defined in config.php
 * - You're not logged in as an administrator
 */
function roots_scripts() {

  $maps_api = get_field( 'global_google_maps_api_key', 'option' );
  $street_address = get_field( 'contact_street_address', 'option' );
  $city = get_field( 'contact_city', 'option' );
  $state = get_field( 'contact_state', 'option' );
  $zip = get_field( 'contact_zip', 'option' );

  /**
   * The build task in Grunt renames production assets with a hash
   * Read the asset names from assets-manifest.json
   */
  if ( WP_ENV === 'development' ) {
    $assets = array(
      'css'       => '/assets/css/main.min.css',
      'js'        => '/assets/js/scripts.min.js',
      'jquery'    => '//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.js'
    );
  } else {
    $get_assets = file_get_contents(get_template_directory() . '/assets/manifest.json');
    $assets     = json_decode($get_assets, true);
    $assets     = array(
      'css'       => '/assets/css/main.min.css?' . $assets['assets/css/main.min.css']['hash'],
      'js'        => '/assets/js/scripts.min.js?' . $assets['assets/js/scripts.min.js']['hash'],
      'jquery'    => '//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js'
    );
  }

  wp_enqueue_style('roots_css', get_template_directory_uri() . $assets['css'], false, null);

  /**
   * jQuery is loaded using the same method from HTML5 Boilerplate:
   * Grab Google CDN's latest jQuery with a protocol relative URL; fallback to local if offline
   * It's kept in the header instead of footer to avoid conflicts with plugins.
   */
  if (!is_admin() && current_theme_supports('jquery-cdn')) {
    wp_deregister_script('jquery');
    wp_register_script('jquery', $assets['jquery'], array(), null, false);
    add_filter('script_loader_src', 'roots_jquery_local_fallback', 10, 2);
  }

  if ( is_front_page() ) {
    wp_enqueue_script('typeit', get_template_directory_uri() . '/resources/js/plugins/typeit.min.js', array('jquery'), '4.9.6');
  }

  if (is_single() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }

  wp_enqueue_script('jquery');
  if ( $maps_api ) {
    wp_enqueue_script( 'google-maps', '//maps.googleapis.com/maps/api/js?key=' . $maps_api . '&libraries=places' );
  }

  //ScrollMagic Requirements
  wp_enqueue_script('TweenMax', '//cdnjs.cloudflare.com/ajax/libs/gsap/1.20.3/TweenMax.min.js', array('jquery'), '1.20.3', true);
  wp_enqueue_script('ScrollMagic', '//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/ScrollMagic.min.js', array('TweenMax'), '2.0.5', true);
  wp_enqueue_script('animation.gsap', '//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/plugins/animation.gsap.min.js', array('jquery'), '2.0.5', true);
  wp_enqueue_script('indicators', '//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/plugins/debug.addIndicators.js', array('jquery'), '2.0.5', true);
  //EOF

  wp_enqueue_script('roots_js', get_template_directory_uri() . $assets['js'], array(), null, true);

  wp_enqueue_script('slick', '//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick.min.js', array('jquery'), '1.8.1', true);

  wp_enqueue_script('velocity_js', '//cdn.jsdelivr.net/velocity/1.2.1/velocity.min.js', array('jquery'), null, true);
  wp_enqueue_script('velocity_ui_js', '//cdn.jsdelivr.net/velocity/1.2.1/velocity.ui.min.js', array('jquery', 'velocity_js'), null, true);

  wp_localize_script( 'roots_js', 'site_info', array( 'url' => home_url(), 'name' => get_bloginfo('name'), 'address' => array( 'street' => $street_address, 'city' => $city, 'state' => $state, 'zip' => $zip ) ) );
}
add_action('wp_enqueue_scripts', 'roots_scripts', 100);

// http://wordpress.stackexchange.com/a/12450
function roots_jquery_local_fallback($src, $handle = null) {
  static $add_jquery_fallback = false;

  if ($add_jquery_fallback) {
    echo '<script>window.jQuery || document.write(\'<script src="' . get_template_directory_uri() . '/assets/vendor/jquery/dist/jquery.min.js?2.1.4"><\/script>\')</script>' . "\n";
    $add_jquery_fallback = false;
  }

  if ($handle === 'jquery') {
    $add_jquery_fallback = true;
  }

  return $src;
}
add_action('wp_head', 'roots_jquery_local_fallback');
