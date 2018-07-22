<?php
  //Locations
  $hero = array(
    'title' => get_field('hero_title'),
    'heading' => get_field('hero_heading'),
    'subheading' => get_field('hero_subheading'),
    'content' => get_field('hero_content'),
    'background' => get_field('hero_background')
  );

  ll_include_component(
    'location-hero',
    $hero,
    array(
      'classes' => array('location__header')
    )
  );
?>