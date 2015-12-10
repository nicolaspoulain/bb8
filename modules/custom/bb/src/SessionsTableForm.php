<?php

/**
 * @file
 * Contains \Drupal\bb\SessionsTableForm.
 */

namespace Drupal\bb;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Component\Utility\UrlHelper;

class SessionsTableForm extends FormBase {
  
  /**
   * {@inheritdoc}.
   */
  public function getFormId() {
    return 'session_form';
  }
  
 /**
   * Create form to list and edit sessions
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    // get sessid from URL
    $current_uri = \Drupal::request()->getRequestUri();
    $options = UrlHelper::parse($current_uri);
    $sessid = $options['query']['query']['sessid'];
    if ($options['query']['query']['action'] == 'add') $sessid = -1;

    // Tableselect Form constructor
    $options = array();
    foreach ($entries = SessionCrudController::load() as $entry) {
      $options[$entry->sessid] = array(
        'name' => $entry->name,
        'email' => $entry->email,
      );
    }
    $header = array(
      'name' =>  t('Name'),
      'email' => t('Email'),
    );

    $form['list']['table'] = array(
      '#type' => 'tableselect',
      '#header' => $header,
      '#options' => $options,
      '#empty' => t('No entries available.'),
      '#default_value' => array($sessid => TRUE),

    );
    $form['list']['edit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Edit'),
      '#submit' =>   array(  '::submitEditListForm'),
      '#validate' => array('::validateEditListForm'),
    );
    $form['list']['add'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Add'),
      '#submit' =>   array(  '::submitAddListForm'),
      '#validate' => array(''),
    );

    // Field edit Form constructor if sessid provided
    if (is_numeric($sessid)) {

      // load values for current sessid
      $entries = SessionCrudController::load(array('sessid' => $sessid));

      $form['modif']['sessid'] = array(
        '#type' => 'hidden',
        '#value' => $sessid,
      );
      $form['modif']['name'] = array(
        '#type' => 'textfield',
        '#title' => t('Name'),
        '#default_value' => $entries[0]->name,
      );
      $form['modif']['email'] = array(
        '#type' => 'email',
        '#title' => $this->t('Email'),
        '#default_value' => $entries[0]->email,
      );
      $form['modif']['save'] = array(
        '#type' => 'submit',
        '#value' => $this->t('Save'),
        '#submit' => array('::submitSaveModifForm'),
        '#validate' => array(),
      );
    }

    // Don't cache this page.
    $content['#cache']['max-age'] = 0;

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
  }
  public function submitForm(array &$form, FormStateInterface $form_state) {
  }

 /**
   * Verification du formulaire tableselect 
   */
  public function validateEditListForm(array &$form, FormStateInterface $form_state) {
    if (count(array_filter($form_state->getValue('table'))) != 1) {
      $form_state->setErrorByName('' ,
        $this->t('Une et une seule session doit être cochée.'));
    }
  }
 /**
   * {@inheritdoc}
   */
  public function submitEditListForm(array &$form, FormStateInterface $form_state) {
      foreach (array_filter($form_state->getValue('table')) as $i) { if ($i != 0) $id = $i; };
    $form_state->setRedirect('bb.sessionstableform',
      array(
        'query' => array(
          'sessid' => $id,
          'action' => $form_state->getValue('add'),
        ),
      )
    );
  }
 /**
   * {@inheritdoc}
   */
  public function submitAddListForm(array &$form, FormStateInterface $form_state) {
    $form_state->setRedirect('bb.sessionstableform',
      array(
        'query' => array(
          'action' => 'add',
        ),
      )
    );
  }
 /**
   * {@inheritdoc}
   */
  public function submitSaveModifForm(array &$form, FormStateInterface $form_state) {

    $account = \Drupal::currentUser();

    $entry = array(
      'uid' => $account->id(),
      'name'  => $form_state->getValue('name'),
      'email' => $form_state->getValue('email'),
      'created' => '2000-01-01',
    );

    if ( $form_state->getValue('sessid') ==-1) {
      // Insert
      $DBWriteStatus = SessionCrudController::insert($entry);
    } else {
      // Update
      $entry['sessid']  = $form_state->getValue('sessid');
      $DBWriteStatus = SessionCrudController::update($entry);
    };
  }

}
