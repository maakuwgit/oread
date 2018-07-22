<?php
/**
 * Add Options Pages for ACF
 */
if( function_exists('acf_add_options_page') ) {
  acf_add_options_page(array(
    'page_title'  => 'Site Options',
    'menu_title'  => 'Site Options',
    'menu_slug'   => 'site-options',
    'position'    => 2,
    'icon_url'    => 'dashicons-images-alt2',
    'redirect'   => false
  ));
}
