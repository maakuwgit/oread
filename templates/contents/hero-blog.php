<?php
/* Dev Note: Unfinished */
  //Blog
  $hero = array(
    'title' => get_field('blog_hero_title'),
    'heading' => get_field('blog_hero_heading'),
    'subheading' => get_field('blog_hero_subheading'),
    'content' => get_field('blog_hero_content'),
    'background' => get_field('blog_hero_background')
  );

  ll_include_component(
    'blog-hero',
    $hero,
    array(
      'classes' => array('blog__header')
    )
  );
?>