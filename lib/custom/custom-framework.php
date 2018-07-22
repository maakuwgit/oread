<?php
/**
* Custom Framework
* -----------------------------------------------------------------------------
*
* Any functionality related to how the theme operates
*/


/**
 * Include a component file.
 *
 * @param  string $component_name The name of the component file (minus the extension)
 * @param  array  $component_data All data being passed to the component
 * @param  array  $component_args Any arguments used to alter the display of the component
 * @return void
 */
function ll_include_component( $component_name, $component_data = array(), $component_args = array(), $buffer = false ) {

  if ( empty( $component_name ) )
    return false;

  /**
   * A full list of template files to check for when looking to include the component.
   * {$component_name}_files hook (Filter)
   *
   * @var array
   */
  $files = apply_filters(
    "{$component_name}_files",
    array(
      "components/{$component_name}/{$component_name}.php",
      "templates/partials/{$component_name}.php",
      "templates/modules/{$component_name}.php",
      "templates/components/{$component_name}.php"
    ),
    $component_data,
    $component_args
  );

  /**
   * {$component_name}_pre_load hook
   * Type: Action
   */
  do_action( "{$component_name}_pre_load", $component_data, $component_args );

  $template = locate_template( $files );

  if ( $template ) {

    if ( $buffer )
      ob_start();

    include( $template );

    if ( $buffer )
      return ob_get_clean();
  }
  else {
    wp_die( "Couldn't find the component {$component_name}. Make sure a template file exists." );
  }
}

/**
 * Runs get_template_part but returns the content rather than outputting it, so that
 * it can be saved as a variable.
 * @param  string $slug first part of the file path
 * @param  string $name last part of the file path
 * @return string  html output of the requested template part
 */
function return_get_template_part($slug, $name=null) {

   ob_start();
   get_template_part($slug, $name);
   $content = ob_get_contents();
   ob_end_clean();

   return $content;
}
