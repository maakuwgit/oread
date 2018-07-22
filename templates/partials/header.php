<header class="navbar top" role="banner">
  <div class="container">

    <div class="navbar-header">

      <?php $logo = get_field( 'global_logo', 'option' ); ?>
      <?php if ( $logo ) : ?>
        <a href="<?php echo esc_url(home_url('/')); ?>">
          <img class="logo logo--header" src="<?php echo $logo['url']; ?>" alt="<?php bloginfo('name'); ?>">
        </a>
      <?php else : ?>
        <a class="logo__brand" href="<?php echo esc_url(home_url('/')); ?>">
          <?php echo ll_get_logo(); ?>
        </a>
        <!--<?php //bloginfo('name'); ?><span class="logo__brand_tagline"><?php //bloginfo('description'); ?></span>-->
      <?php endif; ?>

      <nav class="primary-nav" id="primary-nav" role="navigation">
        <?php
        if (has_nav_menu('primary_navigation')) :
          wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav'));
        endif;
        ?>
      </nav><!-- .primary-nav -->
      <?php if (has_nav_menu('secondary_navigation')) : ?>
      <div class="overlay-navigation">
        <nav class="secondary-nav" id="secondary-nav" role="navigation">
          <?php wp_nav_menu(array('theme_location' => 'secondary_navigation', 'menu_class' => 'nav navbar-nav'));?>
        </nav><!-- .secondary-nav -->
        <div class="header__social">
          <h6 class="header__social__heading">FOLLOW US</h6>
          <?php ll_get_social_list(); ?>
        </div><!-- .header__social -->
        <a class="logo__brand" href="<?php echo esc_url(home_url('/')); ?>">
          <?php echo ll_get_logo('centered'); ?>
        </a><!-- .logo__brand -->
      </div>
      <button type="button" class="navbar-toggle navbar-toggle--stand">
        <span class="sr-only">Toggle navigation</span>
        <span class="navbar-toggle__box">
          <span class="navbar-toggle__inner"></span>
        </span><!-- .navbar-toggle__box -->
      </button><!-- .navbar-toggle -->
      <?php endif; ?>
    </div>
  </div>
</header>
