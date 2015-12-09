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
   * {@inheritdoc}.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    // Tableselect Form constructor
    $options = array();
    foreach ($entries = SessionCrudController::load() as $entry) {
      $options[$entry->sessid] = array(
        'name' => $entry->name,
        'email' => $entry->email,
      );
    }
    $header = array(
      'name' => array('data' => t('Type'), 'field' => 'n.type'),
      'email' => t('Author'),
    );
    $form['list']['#method'] = 'get';
    $form['list']['table'] = array(
      '#type' => 'tableselect',
      '#header' => $header,
      '#options' => $options,
      '#empty' => t('No entries available.'),
    );
    $form['list']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    );

    // get sessid from URL
    $current_uri = \Drupal::request()->getRequestUri();
    $options = UrlHelper::parse($current_uri);
    $sessid = $options['query']['query']['sessid'];

    // Field edit Form constructor if sessid provided
    if (is_numeric($sessid)) {

      // load values for current sessid
      $entries = SessionCrudController::load(array('sessid' => $sessid));

      $form['modif']['sessid'] = array(
        '#type' => 'textfield',
        '#title' => t('sessid'),
        '#default_value' => $sessid,
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
      $form['modif']['show'] = array(
        '#type' => 'submit',
        '#value' => $this->t('Submit'),
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
  
 /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $id = -1;
    foreach (array_filter($form_state->getValue('table')) as $i) { if ($i != 0) $id = $i; };

    if ( $id == -1 ) {
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
    } else {
      $form_state->setRedirect('bb.sessionstableform',
        array(
          'query' => array(
            'sessid' => $id,
          ),
        )
      );
    }
  }

}
