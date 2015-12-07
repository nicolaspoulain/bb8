<?php

/**
 * @file
 * Contains \Drupal\bb\SessionForm.
 */

namespace Drupal\bb;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

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
    
    // Form constructor
    $form['sessid'] = array(
      '#type' => 'textfield',
      '#title' => t('sessid'),
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


    if ( $form_state->hasValue('sessid')) {
      $entry = array(
        'uid' => $account->id(),
        'name'  => $form_state->getValue('name'),
        'email' => $form_state->getValue('email'),
        'created' => '2000-01-01',
      );
      $DBWriteStatus = SessionCrudController::insert($entry);
    } else {
      $entry = array(
        'sessid'  => $form_state->getValue('sessid'),
        'uid' => $account->id(),
        'name'  => $form_state->getValue('name'),
        'email' => $form_state->getValue('email'),
        'created' => '2001-01-01',
      );
    \Drupal::logger('BB')->info(
      'UrrrUU -%query - %username (id=%id) is programming a new module',
      array('%username' => $account->getUsername(), 
      '%id' => $account->id(),
      '%query' => $entry['sessid'],
    )
    );
      $DBWriteStatus = SessionCrudController::update($entry);
    };


  }

}
