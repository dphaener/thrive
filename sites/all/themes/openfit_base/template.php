<?php

function openfit_base_preprocess_html(&$vars) {

  // Load the media queries styles
  // If you change the names of these files they must match here - these files are
  // in the /css/ directory of your subtheme - the names must be identical!
  $media_queries_css = array(
    'openfit_base.responsive.style.css',
    'openfit_base.responsive.gpanels.css'
  );
  load_subtheme_media_queries($media_queries_css, 'openfit_base');

 /**
  * Load IE specific stylesheets
  * AT automates adding IE stylesheets, simply add to the array using
  * the conditional comment as the key and the stylesheet name as the value.
  *
  * See our online help: http://adaptivethemes.com/documentation/working-with-internet-explorer
  *
  * For example to add a stylesheet for IE8 only use:
  *
  *  'IE 8' => 'ie-8.css',
  *
  * Your IE CSS file must be in the /css/ directory in your subtheme.
  */
  
  $ie_files = array(
    'lte IE 7' => 'ie-lte-7.css',
  );
  load_subtheme_ie_styles($ie_files, 'openfit_base');
}

/**
 * Returns HTML for a sort icon.
 *
 * @param $vars
 *   An associative array containing:
 *   - style: Set to either 'asc' or 'desc', this determines which icon to show.
 */
function openfit_base_tablesort_indicator($vars) {
  // Use custom arrow images.
  if ($vars['style'] == 'asc') {
    return theme('image', array('path' => path_to_theme() . '/images/tablesort-ascending.png', 'alt' => t('sort ascending'), 'title' => t('sort ascending')));
  }
  else {
    return theme('image', array('path' => path_to_theme() . '/images/tablesort-descending.png', 'alt' => t('sort descending'), 'title' => t('sort descending')));
  }
}

/**
 * Add the view mode template to theme hook suggestions for our types
 */
function openfit_base_preprocess_node(&$variables) {
  $openfit_node_types = array(
    'activity' => TRUE,
  );
  if (isset($openfit_node_types[$variables['type']])) {
    $variables['theme_hook_suggestions'][] = 'node__' . $variables['type'] . '__' . $variables['view_mode'];
  }
}