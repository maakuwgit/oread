<?php
/**
 *
 * Lifted Logic custom utilities
 * Utilities, filters, etc.
 *
 */

/**
 * Because browser sync changes the HTTP host, we need to add
 * the new one (generally localhost:3000) to the list of allowed
 * http hosts so that any ajax calls work, e.g. WooCommerce.
 *
 * @param  array  $allowed_origins List of allowed origins
 * @return array                   The edited list of allowed origins
 */
function ll_allow_browser_sync_ajax( $allowed_origins ) {

  $environment = get_field( 'global_environment', 'option' );

  if ( isset( $environment ) && $environment == 'development' ) {

    $http_host = $_SERVER['HTTP_HOST'];

    $allowed_origins[] = 'http://' . $http_host;
    $allowed_origins[] = 'https://' . $http_host;
  }

  return $allowed_origins;
}
add_filter( 'allowed_http_origins', 'll_allow_browser_sync_ajax' );

/**
 * Magnific Popup - automatically add magnific rel attributes to embedded images
 */
function ll_insert_magnific_rel( $content ) {
  $pattern = '/<a(.*?)href="(.*?).(bmp|gif|jpeg|jpg|png)"(.*?)>/i';
  $replacement = '<a$1href="$2.$3" rel=\'magnific\'$4>';
  $content = preg_replace( $pattern, $replacement, $content );
  return $content;
}
add_filter( 'the_content', 'll_insert_magnific_rel' );

/**
 * Fix Gravity Form Tabindex Conflicts
 * http://gravitywiz.com/fix-gravity-form-tabindex-conflicts/
 */
function ll_gform_tabindexer( $tab_index, $form = false ) {
  $starting_index = 1000; // if you need a higher tabindex, update this number
  if( $form )
    add_filter( 'gform_tabindex_' . $form['id'], 'll_gform_tabindexer' );
  return GFCommon::$tab_index >= $starting_index ? GFCommon::$tab_index : $starting_index;
}
add_filter( 'gform_tabindex', 'll_gform_tabindexer', 10, 2 );

/**
 * Add page slug to body class
 * [post-type]-[post-name]
 */
function ll_add_slug_body_class( $classes ) {
  global $post;
  if ( isset( $post ) ) {
    $classes[] = $post->post_type . '-' . $post->post_name;
  }
  return $classes;
}
add_filter( 'body_class', 'll_add_slug_body_class' );

/**
 * Remove classes from post_class
 */
function ll_post_class($classes) {
  $classes = array_diff($classes, array('post'));
  return $classes;
}
add_filter('post_class','ll_post_class');

/**
 * Remove version info from head and feeds
 */
function ll_remove_wp_version() {
  return '';
}
add_filter('the_generator', 'll_remove_wp_version');

/**
 * Remove Emoji styles/scripts that were Introduced In WordPress 4.2
 * Comment out function to enable them
 */
function ll_remove_wp_emoji()  {
  // Remove from comment feed and RSS
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

  // Remove from emails
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

  // Remove from head tag
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );

  // Remove from print related styling
  remove_action( 'wp_print_styles', 'print_emoji_styles' );

  // Remove from admin area
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
}
add_action( 'init', 'll_remove_wp_emoji' );

/**
 * Add wistia to whitelist of available oembed providers
 */
wp_oembed_add_provider( '/https?:\/\/(.+)?(wistia.com|wi.st)\/(medias|embed)\/.*/', 'http://fast.wistia.com/oembed', true);


/**
 * Custom wp_parse_args function
 * - Allows for recursive parsing
 *
 * @param  array $a arguments array
 * i.e:
 * array(
 *   'example' => 'foo',
 *   'example-array' => array(
 *     'nested' => 'bar'
 *   )
 * )
 *
 * @param  array $b default value array i.e array( 'example' => null )
 * i.e:
 * array(
 *   'example' => null,
 *   'example-array' => array(
 *     'nested' => null
 *   )
 * )
 *
 * @return array
 */
function ll_parse_args( &$a, $b ) {
  $a = (array) $a;
  $b = (array) $b;
  $result = $b;

  foreach ( $a as $k => &$v ) {
    if ( is_array( $v ) && isset( $result[ $k ] ) ) {
      $result[ $k ] = ll_parse_args( $v, $result[ $k ] );
    } else {
      $result[ $k ] = $v;
    }
  }

  return $result;
}

/**
 * Takes in a multideminsional array and removes null values recursively
 *
 * @param  [array]
 * @return [array]
 */
function ll_filter_array( $component_data ) {

  foreach ( $component_data as $key => $value ) {
    if ( is_array( $value ) ) {
      $component_data[$key] = ll_filter_array( $component_data[$key] );
    }

    if ( empty( $component_data[$key] ) ) {
      unset( $component_data[$key] );
    }
  }

  return $component_data;
}


/**
 * Checks if an array is empty after recursively removing null values
 *
 * @param  [array]
 * @return [boolean]
 */
function ll_empty( $array ) {

  $filter = ll_filter_array( $array );

  if( empty( $filter ) ) {
    return  true;
  }

  else {
    return false;
  }
}

function ll_get_the_slug( $id=null ){
  if( empty($id) ):
    global $post;
    if( empty($post) )
      return ''; // No global $post var available.
    $id = $post->ID;
  endif;

  $slug = basename( get_permalink($id) );
  return $slug;
}

// Update Select2 in ACF
function my_acf_init()
{
  acf_update_setting( 'select2_version', 4 );
}
add_action('acf/init', 'my_acf_init');
