<?php
/**
 * @file
 * globaledge template.php file.
 */

/**
 * Implements template_preprocess_html().
 */
function globaledge_preprocess_html(&$variables) {
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
    $variables['parent_page'] = 'globaledge';
    $variables['current_page'] = 'globaledge';
  }
}


/**
 * Implements template_preprocess_page().
 */
function globaledge_preprocess_page(&$variables) {
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
    //   array(url('node/19', array('absolute' => TRUE)), $base_url . "/sites/default/files/" . "globaledge-dashboard-img.jpg"),
    //   array(url('node/47', array('absolute' => TRUE)), $base_url . "/sites/default/files/" . "globaledge-presentation-img.jpg")
    // );
  }

  $variables['selections'] = array(
    array(url('node/19', array('absolute' => TRUE)), $base_url . "/sites/default/files/" . "globaledge-dashboard-img.jpg"),
    array(url('node/47', array('absolute' => TRUE)), $base_url . "/sites/default/files/" . "globaledge-presentation-img.jpg")
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
      drupal_add_js(drupal_get_path('theme', 'globaledge') . '/js/accounting.js', array('scope' => 'footer'));
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
function globaledge_preprocess_node(&$variables) {
  global $base_url;

  $variables['base_url_default_files'] = $base_url . "/sites/default/files/";
}
