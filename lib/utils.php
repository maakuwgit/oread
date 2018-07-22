<?php
/**
 * Utility functions
 */
function is_element_empty($element) {
  $element = trim($element);
  return !empty($element);
}

// Tell WordPress to use form-search.php from the templates/ directory
function roots_get_search_form($form) {
  $form = '';
  locate_template('/templates/partials/form-search.php', true, false);
  return $form;
}
add_filter('get_search_form', 'roots_get_search_form');
