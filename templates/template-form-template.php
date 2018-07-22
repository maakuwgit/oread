<?php
/*
Template Name: Form Template
*/
?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/contents/content', 'form'); ?>
<?php endwhile; ?>
