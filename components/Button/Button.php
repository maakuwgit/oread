<?php
/**
* Button
* -----------------------------------------------------------------------------
*
* Button component
* @since 1.0.0
* @author First Last
*/

/**
 * Default component data.
 *
 * @var array
 * @see data[]
 */
$default_data = [
  'text' => 'Learn More',
  'link' => array(
    'title' => 'Learn More',
    'href'  => '/'
  )
];

$default_args = [
  'classes' => array()
];

$data = ll_parse_args( $component_data, $default_data );
$args = ll_parse_args( $component_args, $default_args );

/**
 * component_name_before_display hook
 * Type: Action
 */
do_action( "component_name_before_display", $component_data, $component_args );
?>

<?php if ( ll_empty( $data ) ) return; ?>

<a
  class="ll-Button <?php echo implode( " ", $args['classes'] ); ?>"
  title="<?php echo $data['link']['title']; ?>"
  href="<?php echo $data['link']['href'] ?>"
  <?php echo $args['id'] ? 'id="' . $args['id'] . '"' : ''; ?>
  data-component="Button"
>
  <?php echo $args['text']; ?>
</a>

<?php
/**
 * component_name_after_display hook
 * Type: Action
 */
do_action( "component_name_after_display", $component_data, $component_args ); ?>
