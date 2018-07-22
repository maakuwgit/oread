<?php get_template_part('templates/partials/head'); ?>
<body <?php body_class(); ?>>
  <?php include_once( 'assets/img/symbol-defs.svg' ); ?>
  <!--[if lt IE 8]>
  <div class="alert alert-warning">
  <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'roots'); ?>
  </div>
  <![endif]-->

  <?php
  do_action('get_header');
  get_template_part('templates/partials/header');
  ?>

  <div class="wrap" role="document">
    <div class="content">

      <main class="main" role="main">
        <?php include roots_template_path(); ?>
      </main><!-- /.main -->

    </div><!-- /.content -->
  </div><!-- /.wrap -->

  <?php get_template_part('templates/partials/footer'); ?>

  <?php wp_footer(); ?>

</body>
</html>
