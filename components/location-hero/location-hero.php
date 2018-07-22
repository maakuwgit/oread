<?php
/**
* location_hero
* -----------------------------------------------------------------------------
*
* location_hero component
*/

$defaults = [
  'title' => 'Lorem Ipsum',
  'heading' => 'Oread Orthodontics',
  'subheading' => false,
  'content' => false,
  'background' => false
];

$component_data = ll_parse_args( $component_data, $defaults );
?>

<?php
/**
 * Any additional classes to apply to the main component container.
 *
 * @var array
 * @see args['classes']
 */
$classes        = $component_args['classes'] ?: array();

/**
 * ID to apply to the main component container.
 *
 * @var array
 * @see args['id']
 */
$id   = $component_args['id'];

$section_title      = $component_data['title']['text'];
$section_title_tag  = $component_data['title']['tag'];
$page_title         = $component_data['heading']['text'];
$page_title_tag     = $component_data['heading']['tag'];
$main_heading       = $component_data['subheading']['text'];
$main_heading_tag   = $component_data['subheading']['tag'];
$content            = $component_data['content'];

$address  = get_field('location_address');
$phone    = get_field('location_phone');
$hours    = get_field('location_hours');

/*
 * --COMMENT__
 * I'd avoid setting the markup here this way. I do see how
 * it make sense, but I'd prefer to keep logic and markup as separate as
 * possible.So I'd just set $address, then below in the component markup
 * I'd do
 * <?php if ( $address ) : ?>
 *  <address><?php echo $address; ?></address>
 * <?php endif; ?>
 *
 * And i'd do that for address, phone, and hours.
 *
 * Also see comments in home-hero.php about the background image and
 * markup spacing.
 */

$bg = $component_data['background'];

if( $bg ) {
  $bg = wp_get_attachment_url($bg);
}else{
  $bg = 'http://via.placeholder.com/2184x1456';
}

$bg = ' style="background-image:url(' . $bg . ');"';

?>

<?php if ( ll_empty( $component_data ) ) return; ?>
<header class="ll-location-hero hdg <?php echo implode( " ", $classes ); ?>" <?php echo ( $component_id ? 'id="'.$component_id.'"' : '' ) ?> data-component="location-hero"<?php echo $bg; ?>>

  <?php if( $section_title ) : ?>

  <div class="location__section_title__container container">

    <<?php echo $section_title_tag; ?> class="location__section_title hdg__title">
      <?php echo $section_title; ?>
    </<?php echo $section_title_tag; ?>>
    <!-- .location__section_title -->
  </div>

  <?php endif; ?>

  <div class="container text-center">

    <<?php echo $page_title_tag; ?> class="location__page_title hdg__title">
      <?php
        if( !$page_title ) {
          the_title();
        }else{
          echo $page_title;
        }
      ?> Location</<?php echo $page_title_tag; ?>>
    <!-- .location__page_title -->
    <<?php echo $main_heading_tag; ?> class="location__main_heading hdg__heading">
    <?php
        if( !$main_heading ) {
          echo get_bloginfo('title') . ' ' . get_bloginfo('description');
        }else{
          echo $main_heading;
        }
    ?></<?php echo $main_heading_tag; ?>>
    <!-- .location__main_heading -->
    <?php if ( $sub_heading ) : ?>
      <<?php echo $sub_heading_tag; ?> class="location__sub_heading hdg__subheading">
        <?php echo $sub_heading; ?>
      </<?php echo $sub_heading; ?>>
    <?php endif; ?>
    <?php
        if( $content ) {
          echo '<div class="hdg__content">';
          echo format_text($main_heading);
          echo '</div>';
        }
    ?>
    <div class="location__nav">
      <?php
        /*
         * --COMMENT--
         * Never hard set links. Often times the slugs to pages change once it get's into content.
         * So /contact might become /contact-us. Make this dynamic so that the link and link text can
         * be flexible for both contact and Request a consultation
         */
      ?>
      <a class="btn" href="../contact">Contact</a>
      <a class="btn btn--secondary" href="../request-a-consultation">Request a Consultation</a>
    </div>
    <?php if( $address || $hours ) : ?>
    <div class="location__details">

      <div class="location__details_column">
        <h3 class="location__details__header">ADDRESS</h3>

        <?php if( $address ) : ?>
          <address><?php echo $address; ?></address>
        <?php endif; ?>

        <?php if( $phone ) : ?>
        <a href="tel:+1<?php echo strip_phone($phone); ?>"><?php echo format_phone($phone,false,'.'); ?></a>
        <?php endif; ?>

      </div>
      <!-- .location__details_column -->

      <div class="location__details_column">
        <h3 class="location__details__header">HOURS</h3>

        <?php if( $hours ) : ?>
          <?php echo format_text($hours); ?>
        <?php endif; ?>

      </div>
      <!-- .location__details_column -->

    </div>
    <?php endif; ?>
  </div>
</header>
