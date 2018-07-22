<?php
/**
 * Register the custom post type
 */
if ( ! function_exists('register_location_custom_post_type') ) {

  // Register Custom Post Type
  function register_location_custom_post_type() {

    $labels = array(
      'name'                => 'Location',
      'singular_name'       => 'Location',
      'menu_name'           => 'Location',
      'parent_item_colon'   => 'Parent Location',
      'all_items'           => 'All Locations',
      'view_item'           => 'View Location',
      'add_new_item'        => 'Add New Location',
      'add_new'             => 'New Location',
      'edit_item'           => 'Edit Location',
      'update_item'         => 'Update Location',
      'search_items'        => 'Search Location',
      'not_found'           => 'No location found',
      'not_found_in_trash'  => 'No location found in Trash',
    );
    $args = array(
      'label'               => 'location',
      'description'         => 'Location description',
      'labels'              => $labels,
      'supports'            => array( 'title', 'page-attributes' ),
      'hierarchical'        => true,
      'public'              => true,
      'show_ui'             => true,
      'show_in_menu'        => true,
      'show_in_nav_menus'   => true,
      'show_in_admin_bar'   => true,
      'menu_position'       => 20,
      'menu_icon'           => 'dashicons-groups',
      'can_export'          => true,
      'has_archive'         => true,
      'exclude_from_search' => true,
      'publicly_queryable'  => true,
      'capability_type'     => 'post',
    );
    register_post_type( 'location', $args );

  }

  // Hook into the 'init' action
  add_action( 'init', 'register_location_custom_post_type', 0 );

}