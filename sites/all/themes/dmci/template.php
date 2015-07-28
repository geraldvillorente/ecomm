<?php
/**
 * @file
 * DMCI template.php file.
 */

/**
 * Implements template_preprocess_html().
 */
function dmci_preprocess_html(&$variables) {
  global $base_url;
  global $user;

  // Get the user profile.
  $uid = user_load($user->uid);
  $profile_main = profile2_load_by_user($uid, 'main');
  $variables['name'] = $profile_main->field_name[LANGUAGE_NONE][0]['value'];
  $variables['position'] = $profile_main->field_position[LANGUAGE_NONE][0]['value'];
  $image = $profile_main->field_image_profile[LANGUAGE_NONE][0]['uri'];
  $variables['image'] = image_style_url('60x62', $image);

  $variables['base_url_default_files'] = $base_url . "/sites/default/files/";

  $menu_trail = menu_get_active_trail();
  if (isset($menu_trail[1])) {
    if ($menu_trail[1]['link_title'] == "My account") {
      $variables['parent_page'] = "Dashboard";
    } else {
     $parent_page = menu_link_load($menu_trail[1]['mlid']);
     $variables['parent_page'] = $parent_page['link_title'];
    }
    $variables['current_page'] = $variables['head_title_array']['title'];
  }
  else {
    $variables['parent_page'] = 'DMCI';
    $variables['current_page'] = 'DMCI';
  }
}


/**
 * Implements template_preprocess_page().
 */
function dmci_preprocess_page(&$variables) {
  global $base_url;
  global $user;

  $variables['base_url_default_files'] = $base_url . "/sites/default/files/";

  // This condition is very important to avoid redirect loop.
  if (user_is_anonymous()) {
    // Get the login form.
    $form = drupal_get_form("user_login");
    $variables['login_form'] = drupal_render($form);
  } else if ($variables['page']['content']['system_main']['#entity_type'] == "user") {
  } else {
    // $variables['theme_hook_suggestions'][] = "page__selection";
    // $variables['selections'] = array(
    //   array(url('node/19', array('absolute' => TRUE)), $base_url . "/sites/default/files/" . "dmci-dashboard-img.jpg"),
    //   array(url('node/47', array('absolute' => TRUE)), $base_url . "/sites/default/files/" . "dmci-presentation-img.jpg")
    // );
  }

  $variables['selections'] = array(
    array(url('node/19', array('absolute' => TRUE)), $base_url . "/sites/default/files/" . "dmci-dashboard-img.jpg"),
    array(url('node/47', array('absolute' => TRUE)), $base_url . "/sites/default/files/" . "dmci-presentation-img.jpg")
  );

  if (isset($variables['node'])) {
    $nid = $variables['node']->nid;

    if ($nid == 47) {
      $variables['theme_hook_suggestions'][] = "page__company";
      $url = $base_url . '/data/history';
      $content = file_get_contents($url);
      $variables['slideContent'] = json_decode($content);

      $url2 = $base_url . '/data/history2';
      $content2 = file_get_contents($url2);
      $variables['slideContent2'] = json_decode($content2, TRUE);

      $url3 = $base_url . '/data/history3';
      $content3 = file_get_contents($url3);
      $variables['slideContent3'] = json_decode($content3, TRUE);
    }
    else if ($nid == 6) {
      $variables['theme_hook_suggestions'][] = "page__property";
    }
    else if ($nid == 12) {
      $variables['theme_hook_suggestions'][] = "page__bpc";
    }
    else if ($nid == 113) {
      $block_reservationform = module_invoke('webform', 'block_view', 'client-block-113');
      $variables['theme_hook_suggestions'][] = "page__reservation";
      $variables['reservation_form'] = $block_reservationform['content'];
    }
    else if ($nid == 16) {
      $variables['theme_hook_suggestions'][] = "page__bpc";
      drupal_add_js(drupal_get_path('theme', 'dmci') . '/js/accounting.js', array('scope' => 'footer'));
    }
    else if ($nid == 17) {
      $variables['theme_hook_suggestions'][] = "page__thankyou";
    }
    else if ($nid == 19) {
      $variables['theme_hook_suggestions'][] = "page__dashboard_news";
    }
    else if ($nid == 20) {
      $variables['theme_hook_suggestions'][] = "page__dashboard_home";
    }
    else if ($nid == 21) {
      $variables['theme_hook_suggestions'][] = "page__dashboard_contacts";
    }
    else if ($nid == 22) {
      $variables['theme_hook_suggestions'][] = "page__dashboard_single_contact";
    }
    else if ($nid == 23) {
      $variables['theme_hook_suggestions'][] = "page__dashboard_reservation";
    }
    else if ($nid == 24) {
      $variables['theme_hook_suggestions'][] = "page__dashboard_profile";
    }
    else if ($nid == 25) {
      $variables['theme_hook_suggestions'][] = "page__dashboard_availability_room";
    }
    else if ($nid == 26) {
      $variables['theme_hook_suggestions'][] = "page__dashboard_availability";
      $json = file_get_contents($base_url . '/data/project-availability');
      $obj = json_decode($json, true);
      $variables['projects'] = $obj;
    }
    else if ($nid == 123) {
      $variables['theme_hook_suggestions'][] = "page__dashboard_single_reservation";

      $url = $base_url . '/data/single-reservation/' . $_GET['id'];
      $content = file_get_contents($url);
      $variables['reservation'] = json_decode($content);
    }
    else {
      // Do nothing.
    }
  }

  // Get the path of active theme.
  $theme = path_to_theme();

  drupal_add_js($theme . '/js/swiper.min.js', array('scope' => 'footer'));
  drupal_add_js($theme . '/js/lightbox.js', array('scope' => 'footer'));
  drupal_add_js($theme . '/js/index.js', array('scope' => 'footer'));
  drupal_add_js('(function($){ $(document).foundation(); })(jQuery)', array('type' => 'inline', 'scope' => 'footer'));

  // Add required javascript files.
  drupal_add_js($theme . '/js/classie.js', array('scope' => 'footer'));
  drupal_add_js($theme . '/js/modernizr.custom.js', array('scope' => 'footer'));
  drupal_add_js($theme . '/js/sidebarEffects.js', array('scope' => 'footer'));

  // Bootstrap Angular driven pages.
  drupal_add_js($theme . '/js/angular/angular.js', array('scope' => 'header'));
}

/**
 * Implements template_preprocess_node().
 */
function dmci_preprocess_node(&$variables) {
  global $base_url;
  $variables['base_url_default_files'] = $base_url . "/sites/default/files/";
  // $variables['theme_hook_suggestions'][] = "node__project";
}

/**
 * Implements hook_preprocess_block()
 */
//function dmci_preprocess_block(&$variables) {
//  // Add wrapping div with global class to all block content sections.
//  $variables['content_attributes_array']['class'][] = 'block-content';
//
//  // Convenience variable for classes based on block ID
//  $block_id = $variables['block']->module . '-' . $variables['block']->delta;
//
//  // Add classes based on a specific block
//  switch ($block_id) {
//    // System Navigation block
//    case 'system-navigation':
//      // Custom class for entire block
//      $variables['classes_array'][] = 'system-nav';
//      // Custom class for block title
//      $variables['title_attributes_array']['class'][] = 'system-nav-title';
//      // Wrapping div with custom class for block content
//      $variables['content_attributes_array']['class'] = 'system-nav-content';
//      break;
//
//    // User Login block
//    case 'user-login':
//      // Hide title
//      $variables['title_attributes_array']['class'][] = 'element-invisible';
//      break;
//
//    // Example of adding Foundation classes
//    case 'block-foo': // Target the block ID
//      // Set grid column or mobile classes or anything else you want.
//      $variables['classes_array'][] = 'six columns';
//      break;
//  }
//
//  // Add template suggestions for blocks from specific modules.
//  switch($variables['elements']['#block']->module) {
//    case 'menu':
//      $variables['theme_hook_suggestions'][] = 'block__nav';
//    break;
//  }
//}

//function dmci_preprocess_views_view(&$variables) {
//}

/**
 * Implements template_preprocess_panels_pane().
 *
 */
//function dmci_preprocess_panels_pane(&$variables) {
//}

/**
 * Implements template_preprocess_views_views_fields().
 *
 */
//function dmci_preprocess_views_view_fields(&$variables) {
//}

/**
 * Implements theme_form_element_label()
 * Use foundation tooltips
 */
//function dmci_form_element_label($variables) {
//  if (!empty($variables['element']['#title'])) {
//    $variables['element']['#title'] = '<span class="secondary label">' . $variables['element']['#title'] . '</span>';
//  }
//  if (!empty($variables['element']['#description'])) {
//    $variables['element']['#description'] = ' <span data-tooltip="top" class="has-tip tip-top" data-width="250" title="' . $variables['element']['#description'] . '">' . t('More information?') . '</span>';
//  }
//  return theme_form_element_label($variables);
//}

/**
 * Implements hook_preprocess_button().
 */
//function dmci_preprocess_button(&$variables) {
//  $variables['element']['#attributes']['class'][] = 'button';
//  if (isset($variables['element']['#parents'][0]) && $variables['element']['#parents'][0] == 'submit') {
//    $variables['element']['#attributes']['class'][] = 'secondary';
//  }
//}

/**
 * Implements hook_form_alter()
 * Example of using foundation sexy buttons
 */
//function dmci_form_alter(&$form, &$form_state, $form_id) {
//  // Sexy submit buttons
//  if (!empty($form['actions']) && !empty($form['actions']['submit'])) {
//    $classes = (is_array($form['actions']['submit']['#attributes']['class']))
//      ? $form['actions']['submit']['#attributes']['class']
//      : array();
//    $classes = array_merge($classes, array('secondary', 'button', 'radius'));
//    $form['actions']['submit']['#attributes']['class'] = $classes;
//  }
//}

/**
 * Implements hook_form_FORM_ID_alter()
 * Example of using foundation sexy buttons on comment form
 */
//function dmci_form_comment_form_alter(&$form, &$form_state) {
  // Sexy preview buttons
//  $classes = (is_array($form['actions']['preview']['#attributes']['class']))
//    ? $form['actions']['preview']['#attributes']['class']
//    : array();
//  $classes = array_merge($classes, array('secondary', 'button', 'radius'));
//  $form['actions']['preview']['#attributes']['class'] = $classes;
//}


/**
 * Implements template_preprocess_panels_pane().
 */
// function zurb_foundation_preprocess_panels_pane(&$variables) {
// }

/**
* Implements template_preprocess_views_views_fields().
*/
/* Delete me to enable
function THEMENAME_preprocess_views_view_fields(&$variables) {
 if ($variables['view']->name == 'nodequeue_1') {

   // Check if we have both an image and a summary
   if (isset($variables['fields']['field_image'])) {

     // If a combined field has been created, unset it and just show image
     if (isset($variables['fields']['nothing'])) {
       unset($variables['fields']['nothing']);
     }

   } elseif (isset($variables['fields']['title'])) {
     unset ($variables['fields']['title']);
   }

   // Always unset the separate summary if set
   if (isset($variables['fields']['field_summary'])) {
     unset($variables['fields']['field_summary']);
   }
 }
}

// */

/**
 * Implements hook_css_alter().
 */
//function dmci_css_alter(&$css) {
//  // Always remove base theme CSS.
//  $theme_path = drupal_get_path('theme', 'zurb_foundation');
//
//  foreach($css as $path => $values) {
//    if(strpos($path, $theme_path) === 0) {
//      unset($css[$path]);
//    }
//  }
//}

/**
 * Implements hook_js_alter().
 */
//function dmci_js_alter(&$js) {
//  // Always remove base theme JS.
//  $theme_path = drupal_get_path('theme', 'zurb_foundation');
//
//  foreach($js as $path => $values) {
//    if(strpos($path, $theme_path) === 0) {
//      unset($js[$path]);
//    }
//  }
//}
