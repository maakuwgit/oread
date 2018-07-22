<?php
/**
* single-post-hero
* -----------------------------------------------------------------------------
*
* single-post-hero component
*/

$defaults = [
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

$id     = ( $component_args['id'] ? $component_args['id'] : uniqid('blog-hero-') );

$title      = $component_data['heading'];
$bg         = $component_data['background'];

if( $bg ) {
  $bg = ' style="background-image:url(' . $bg . ');"';
}else{
  $bg = '';
}

?>

<?php if ( ll_empty( $component_data ) ) return; ?>
<div class="ll-single-post-hero post__header hdg<?php echo implode( " ", $classes ); ?>" <?php echo ( $component_id ? 'id="'.$component_id.'"' : '' ) ?> data-component="single-post-hero"<?php echo $bg; ?>>

  <?php if( $bg ) : ?>
  <style>
    #<?php echo $id; ?>:before {
      position: absolute;
      content: '';
      top: 0;
      right: 0;
      bottom: 0;
      left: 0;
      opacity: 0.6;
      background: linear-gradient(0deg, black 0%, rgba(0,0,0, 0) 100%),
                  radial-gradient(circle, rgba(0,0,0, 0) 0%, black 100%);
    }
  </style>
  <?php endif; ?>

  <h1 class="post__header__title hdg__title"><?php the_title(); ?></h1>
  <?php get_template_part('templates/partials/post-meta'); ?>
</div>
