<?php
  //Home Page
  $hero = array(
    'title'               => get_field('hero_title'),
    'headings'            => get_field('hero_heading'),
    'subheading'          => get_field('hero_subheading'),
    'content'             => get_field('hero_content'),
    'background'          => get_field('hero_background'),
    'looping_video'       => get_field('hero_video'),
    'spotlight_strength'  => get_field('spotlight_strength'),
    'popup_video'         => get_field('hero_popup_video')
  );

  ll_include_component(
    'home-hero',
    $hero
  );
?>
