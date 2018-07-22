<?php
/*
Template Name: Home
*/
?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/contents/hero', 'home'); ?>
  <?php get_template_part('templates/contents/content', 'page'); ?>
<?php endwhile; ?>
