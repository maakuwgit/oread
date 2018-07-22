<?php
  $form_id = ( get_field('form_id', 'option') ? get_field('form_id', 'option') : 3 );
?>
<footer class="footer" role="contentinfo">
  <div class="footer__logo">
    <div class="container">
      <a class="logo__brand" href="<?php echo esc_url(home_url('/')); ?>">
        <?php echo ll_get_logo(); ?>
      </a>
    </div>
  </div>
  <div class="footer__top">
    <div class="container">
      <div class="col-3of12">
        <div class="footer__footer-nav">
        <?php if (has_nav_menu('footer_navigation')) : ?>
          <h6 class="footer__headline">General</h6>
          <?php wp_nav_menu(array('theme_location' => 'footer_navigation', 'menu_class' => 'nav navbar-nav')); ?>
        <?php endif;?>
        </div>
      </div>
      <div class="col-3of12">
        <div class="footer__services">
        <?php
          $sargs    = array(
                'post_type'     => 'service',
                'post_status'   => 'publish',
                'order'         => 'ASC'
              );

          $services = new WP_Query( $sargs );

          if ( $services->have_posts() ) : ?>
            <h6 class="footer__headline">Services</h6>
            <ul id="menu-footer-services" class="nav navbar-nav">
            <?php while( $services->have_posts() ) : $services->the_post(); ?>
              <li class="menu-item menu-<?php echo get_post_field('post_name'); ?>">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
              </li>
          <?php endwhile; ?>
              <li class="menu-item menu-request-a-consulation">
                <a href="http://oread.local/request-a-consultation/">Request a Consultation</a>
              </li>
            </ul>
        <?php endif; ?>
        </div><!-- .footer__services -->
      </div>
      <div class="col-3of12">
        <div class="footer__locations">
        <?php
          $largs    = array(
                'post_type'     => 'location',
                'post_status'   => 'publish',
                'order'         => 'ASC'
              );

          $locations = new WP_Query( $largs );

          if ( $locations->have_posts() ) : ?>
            <h6 class="footer__headline">Locations</h6>
            <ul id="menu-footer-locations" class="nav navbar-nav">
            <?php while( $locations->have_posts() ) : $locations->the_post(); ?>
              <li class="menu-item menu-<?php echo get_post_field('post_name'); ?>">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
              </li>
          <?php endwhile; ?>
            </ul>
        <?php endif; ?>
        </div><!-- .footer__locations -->
      </div>
      <div class="col-3of12">
        <div class="footer__newsletter">
          <?php gravity_form( $form_id, true, true ); ?>
        </div><!-- .footer__newsletter -->
        <div class="footer__social">
          <?php ll_get_social_list(); ?>
        </div><!-- .footer__social -->

      </div>
    </div>
  </div>
  <div class="footer__bottom">
    <div class="container">
      <div class="row">
        <div class="footer__copyright">
          <?php bloginfo('name'); ?>. All Rights Reserved <?php echo date('Y'); ?>.
        </div><!-- .footer__copyright -->

        <div class="footer__credits">
          <a href="https://liftedlogic.com/" target="_blank">Web Design in Kansas City</a> by <a href="https://liftedlogic.com/" target="_blank">Lifted Logic</a>
        </div><!-- .footer__credits -->

        <div class="footer__ll_logo">
          <a href="https://liftedlogic.com/" target="_blank">
            <svg class="icon icon-LiftedLogic">
              <use xlink:href="#icon-LiftedLogic"></use>
            </svg>
          </a>
        </div><!-- .footer__ll_logo -->

      </div>
    </div>
  </div><!-- .footer__bottom -->
</footer>
