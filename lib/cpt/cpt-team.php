<?php
/**
 * Register the custom post type
 */
if ( ! function_exists('register_team_custom_post_type') ) {

  // Register Custom Post Type
  function register_team_custom_post_type() {

    $labels = array(
      'name'                => 'Team',
      'singular_name'       => 'Team',
      'menu_name'           => 'Team',
      'parent_item_colon'   => 'Parent Team',
      'all_items'           => 'All Team Members',
      'view_item'           => 'View Team Member',
      'add_new_item'        => 'Add New Team Member',
      'add_new'             => 'New Team Member',
      'edit_item'           => 'Edit Team Member',
      'update_item'         => 'Update Team Member',
      'search_items'        => 'Search Team Member',
      'not_found'           => 'No team member found',
      'not_found_in_trash'  => 'No team member found in Trash',
    );
    $args = array(
      'label'               => 'team',
      'description'         => 'Team description',
      'labels'              => $labels,
      'supports'            => array( 'title', 'page-attributes' ),
      // 'taxonomies'          => array( 'category', 'post_tag' ),
      'hierarchical'        => true,
      'public'              => true,
      'show_ui'             => true,
      'show_in_menu'        => true,
      'show_in_nav_menus'   => false,
      'show_in_admin_bar'   => true,
      'menu_position'       => 20,
      'menu_icon'           => 'dashicons-groups',
      'can_export'          => true,
      'has_archive'         => true,
      'exclude_from_search' => true,
      'publicly_queryable'  => true,
      'capability_type'     => 'post',
    );
    register_post_type( 'team', $args );

  }

  // Hook into the 'init' action
  add_action( 'init', 'register_team_custom_post_type', 0 );

}

/**
 * Custom taxonomies
 */
if ( ! function_exists('register_team_taxonomies') ) {

  function register_team_taxonomies() {

    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
      'name'                => _x( 'Team Position', 'taxonomy general name' ),
      'singular_name'       => _x( 'Team Position', 'taxonomy singular name' ),
      'search_items'        => __( 'Search Team Positions' ),
      'all_items'           => __( 'All Team Positions' ),
      'parent_item'         => __( 'Parent Team Position' ),
      'parent_item_colon'   => __( 'Parent Team Position:' ),
      'edit_item'           => __( 'Edit Team Position' ),
      'update_item'         => __( 'Update Team Position' ),
      'add_new_item'        => __( 'Add New Team Position' ),
      'new_item_name'       => __( 'New Team Position Name' ),
      'menu_name'           => __( 'Team Positions' )
    );

    $args = array(
      'hierarchical'        => true,
      'labels'              => $labels,
      'show_ui'             => true,
      'show_admin_column'   => true,
      'query_var'           => true,
      'rewrite'             => array( 'slug' => 'position' )
    );

    register_taxonomy( 'team_position', array( 'team' ), $args ); // Must include custom post type name

    // Add new taxonomy, NOT hierarchical (like tags)
    $labels = array(
      'name'                         => _x( 'Team Tags', 'taxonomy general name' ),
      'singular_name'                => _x( 'Team Tag', 'taxonomy singular name' ),
      'search_items'                 => __( 'Search Team' ),
      'popular_items'                => __( 'Popular Team' ),
      'all_items'                    => __( 'All Team' ),
      'parent_item'                  => null,
      'parent_item_colon'            => null,
      'edit_item'                    => __( 'Edit Team' ),
      'update_item'                  => __( 'Update Team' ),
      'add_new_item'                 => __( 'Add New Team' ),
      'new_item_name'                => __( 'New Team Name' ),
      'separate_items_with_commas'   => __( 'Separate Team with commas' ),
      'add_or_remove_items'          => __( 'Add or remove Team' ),
      'choose_from_most_used'        => __( 'Choose from the most used Team' ),
      'not_found'                    => __( 'No Team found.' ),
      'menu_name'                    => __( 'Team Tags' )
    );

    $args = array(
      'hierarchical'            => false,
      'labels'                  => $labels,
      'show_ui'                 => true,
      'show_admin_column'       => true,
      'update_count_callback'   => '_update_post_term_count',
      'query_var'               => true,
      'rewrite'                 => array( 'slug' => 'team_tag' )
    );

    register_taxonomy( 'team_tag', 'team', $args ); // Must include custom post type name

  }

  add_action( 'init', 'register_team_taxonomies', 0 );

}

/**
 * Create ACF setting page under CPT menu
 */

// if ( function_exists( 'acf_add_options_sub_page' ) ){
//   acf_add_options_sub_page(array(
//     'title'      => 'Team Settings',
//     'parent'     => 'edit.php?post_type=team',
//     'capability' => 'manage_options'
//   ));
// }
