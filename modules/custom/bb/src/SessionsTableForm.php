<?php

/**
 * @file
 * Contains \Drupal\bb\SessionsTableForm.
 */

namespace Drupal\bb;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class SessionsTableForm extends FormBase {
  
  /**
   * {@inheritdoc}.
   */
  public function getFormId() {
    return 'session_form';
  }
  
 /**
   * {@inheritdoc}.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    
    // Form constructor
    $rows = array();
    $header = array(
     'name' => array('data' => t('Type'), 'field' => 'n.type'),
     'email' => t('Author'),
    );

    foreach ($entries = SessionCrudController::load() as $entry) {
      // Sanitize each entry.
      // $rows[] = array_map('Drupal\Component\Utility\SafeMarkup::checkPlain', (array) $entry);
      $rows[] = $entry;
    }
    //Build the rows.
    $options = array();
    foreach ($rows as $row) {
     // drupal_set_message('<pre>'. print_r($row->sessid, TRUE) .'</pre>');
     $options[$row->sessid] = array(
         'name' => $row->name,
         'email' => $row->email,
       );
    };
    // drupal_set_message('<pre>'. print_r($options, TRUE) .'</pre>');

    // print_r($options,TRUE);
    $form['table'] = array(
      '#type' => 'tableselect',
      '#header' => $header,
      '#options' => $options,
      '#empty' => t('No entries available.'),
    );
    // Don't cache this page.
    $content['#cache']['max-age'] = 0;
    
    $form['edit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Edit'),
    );
    
    return $form;
  }
  
  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
  }
  
 /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // drupal_set_message('<pre>'. print_r(array_filter($form_state->getValue('table')), TRUE) .'</pre>');

    foreach (array_filter($form_state->getValue('table')) as $i) { if ($i != 0) $id = $i; };

    $form_state->setRedirect('bb.sessionform',
      array(
        'query' => array(
          'sessid' => $id,
        ),
      )
    );

  }

}
