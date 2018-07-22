<?php
  $cat = get_queried_object();

  if( is_archive() ){
    $heading   = $cat->name;
    $spotlight = 0.6;
    $feature   = get_the_post_thumbnail_url( get_option( 'page_for_posts' ), 'large' );
  }else{
    $heading   = get_field('blog_hero_heading', $cat);
    $spotlight = get_field('blog_spotlight_strength', $cat);
    $feature   = get_the_post_thumbnail_url( $cat->ID, 'large' );
  }

  $hero = array(
    'heading'     => $heading,
    'background'  => $feature,
    'spotlight'   => $spotlight
  );

  ll_include_component(
    'blog-hero',
    $hero
  );

?>