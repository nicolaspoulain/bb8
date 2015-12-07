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
    $form['id'] = array(
      '#type' => 'textfield',
      '#title' => t('id'),
    );
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

    // Logging Framework. loggeur : Database Logging (dblog) [table watchdog]
    \Drupal::logger('BB')->info(
      '%username (id=%id) is programming a new module',
      array('%username' => $account->getUsername(), '%id' => $account->id())
    );

    $DBWriteStatus = db_merge('gbb_aaa')
      ->key(array('id'  => $form_state->getValue('id')))
      ->insertFields(array(
        'id' => NULL,
        'name'  => $form_state->getValue('name'),
        'email' => $form_state->getValue('email'),
        'created' => '2001-01-01',
      ))
      ->updateFields(array(
        'name'  => $form_state->getValue('name'),
        'email' => $form_state->getValue('email'),
        'created' => '2000-01-01',
      ))
      ->execute();
  
    drupal_set_message(
      $this->t('Your email address is @email- @DBWriteStatus', 
        array('@email' => $form_state->getValue('email'),
        '@DBWriteStatus' => $DBWriteStatus)
      )
    );

  
  }

}
