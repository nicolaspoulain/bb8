<?php

/**
 * @file
 * Contains \Drupal\bb\MyForm.
 */

namespace Drupal\bb;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class MyForm extends FormBase {
  
  /**
   * {@inheritdoc}.
   */
  public function getFormId() {
    return 'my_form';
  }
  
 /**
   * {@inheritdoc}.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    
    // Form constructor
    $form['name'] = array(
      '#type' => 'textfield',
      '#title' => t('Name'),
    );
    $form['email'] = array(
      '#type' => 'email',
      '#title' => $this->t('Email address.')
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
    \Drupal::logger('BB')->info(
      '%username (id=%id) is programming a new module',
      array('%username' => $account->getUsername(), '%id' => $account->id())
    );  
    drupal_set_message(
      $this->t('Your email address is @email', 
      array('@email' => $form_state->getValue('email')))
    );
  }
  
}
