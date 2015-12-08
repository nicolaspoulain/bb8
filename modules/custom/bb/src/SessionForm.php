<?php

/**
 * @file
 * Contains \Drupal\bb\SessionForm.
 */

namespace Drupal\bb;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Component\Utility\UrlHelper;


class SessionForm extends FormBase {
  
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

    $current_uri = \Drupal::request()->getRequestUri();
    $options = UrlHelper::parse($current_uri);

    // drupal_set_message('<pre>'. print_r($options['query']['query']['sessid'], TRUE) .'</pre>');
    $sessid = $options['query']['query']['sessid'];
    foreach ($entries = SessionCrudController::load(array('sessid' => $sessid)) as $entry) {
      // Sanitize each entry.
      $rows[] = array_map('Drupal\Component\Utility\SafeMarkup::checkPlain', (array) $entry);
    }
    drupal_set_message('<pre>'. print_r($entries, TRUE) .'</pre>');
    

    // Form constructor
    $form['sessid'] = array(
      '#type' => 'textfield',
      '#title' => t('sessid'),
      '#default_value' => $sessid,
    );
    $form['name'] = array(
      '#type' => 'textfield',
      '#title' => t('Name'),
      '#default_value' => $entries[0]->name,
    );
    $form['email'] = array(
      '#type' => 'email',
      '#title' => $this->t('Email address.'),
      '#default_value' => $entries[0]->email,
    );
    $form['show'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
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
    $account = \Drupal::currentUser();

      $entry = array(
        'uid' => $account->id(),
        'name'  => $form_state->getValue('name'),
        'email' => $form_state->getValue('email'),
        'created' => '2000-01-01',
      );

    if ( $form_state->isValueEmpty('sessid')) {
      // Insert
      $DBWriteStatus = SessionCrudController::insert($entry);
    } else {
      // Update
      $entry['sessid']  = $form_state->getValue('sessid');
      $DBWriteStatus = SessionCrudController::update($entry);
    };


  }

}
