<?php
/**
* blog-hero
* -----------------------------------------------------------------------------
*
* blog-hero component
*/

$defaults = [
  'heading'   => 'Welcome to the blog',
  'spotlight' => 0.6
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
$spotlight  = $component_data['spotlight'];

if( $bg ) {
  $bg = ' style="background-image:url(' . $bg . ');"';
}else{
  $bg = '';
}

?>

<?php if ( ll_empty( $component_data ) ) return; ?>

<div class="ll-blog-hero hdg<?php echo implode( " ", $classes ); ?>"<?php echo ' id="'.$id.'"' ?> data-component="blog-hero"<?php echo $bg; ?>>

  <?php if( $bg ) : ?>
  <style>
    #<?php echo $id; ?>:before {
      position: absolute;
      content: '';
      top: 0;
      right: 0;
      bottom: 0;
      left: 0;
      opacity: <?php echo $spotlight; ?>;
      background: linear-gradient(0deg, black 0%, rgba(0,0,0, 0) 100%),
                  radial-gradient(circle, rgba(0,0,0, 0) 0%, black 100%);
    }
  </style>
  <?php endif; ?>

  <h1 class="hdg__heading"><?php echo $title; ?></h1>
  <div class="hdg__nav">
   <?php
    $links = [];
    $categories = get_categories( array(
      'orderby' => 'id',
      'order'   => 'ASC'
    ) );

    $curr_cat = get_queried_object();

    if ($categories) {
      $curr_class = ' class="active"';

      foreach($categories as $category) {

        $link_class = '';

        if($category->name == $curr_cat->cat_name ) {

          $link_class = $curr_class;
          $links[] = '<a' . $link_class . ' href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . $category->name . '</a>';

        }elseif($category->term_id == 1) {

          if( !$curr_cat->cat_name ) {
            $link_class = $curr_class;
          }

          $links[] = '<a' . $link_class . ' href="' . get_bloginfo('url') . '/welcome-to-the-blog">Show All</a>';

        }else{

          $links[] = '<a' . $link_class . ' href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . $category->name . '</a>';

        }
      }
      echo implode('', $links);
    }
  ?>
  </div>
</div>
