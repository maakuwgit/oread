<?php
/*
Template Name: Contact
*/
?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/contents/content', 'contact'); ?>
  <?php get_template_part('templates/contents/content', 'page'); ?>
<?php endwhile; ?>
