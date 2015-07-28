<?php
/**
 * @file
 * gamecrate_core.admin.inc
 */


/**
 * Build the form for About Page Settings.
 */
function _taxonomy_alter_set_form($form_state) {

  $form = array();

  $about_text = variable_get('about_text', array('value' => '', 'format' => 'filtered_html'));

  $form['about_text'] = array(
    '#type' => 'text_format',
    '#title' => t(''),
    '#default_value' => $about_text['value'],
    '#format' => $about_text['format'],
  );

  $form['submit'] = array(
    '#type' => 'submit',
    '#value' => t('Save Configuration'),
  );

  return $form;

}


/**
 * Save the values.
 */
function _taxonomy_alter_set_form_submit($form, &$form_state) {
  global $base_url;
  $form_state['redirect'] = $base_url . '/about';
  variable_set('about_text', $form_state['values']['about_text']);
  drupal_set_message(t('Your changes has been saved.'));
}
