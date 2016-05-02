<?php

/**
 * @file
 * Contains \Drupal\bb\Form\SessionsHorairesForm.
 */

namespace Drupal\bb\Form;

use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\CssCommand;
use Drupal\Core\Ajax\HtmlCommand;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class SessionHorairesForm extends FormBase {

  /**
   * {@inheritdoc}.
   */
  public function getFormId() {
    return 'session_date_form';
  }

  /**
   * Create form
   */
  public function buildForm(array $form, FormStateInterface $form_state,
    $sess_id=1, $def_val=NULL) {

    // On applique le theme session
    // voir HOOK_theme bb_theme dans module/custom/bb/bb.module
    $form['#theme'] = 'session';

    $form['new'][$sess_id]['horaires'] = array(
      '#type' => 'textfield',
      '#required' => TRUE,
      '#default_value' => $def_val,
      '#ajax' => array(
        'callback' => 'Drupal\bb\Form\SessionHorairesForm::updateTestCallback',
      ),
      '#suffix' => '<span class="horaire"></span>'

    );
    // Don't cache this page.
    $content['#cache']['max-age'] = 0;

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function updateTestCallback(array $form, FormStateInterface $form_state) {
    $triggering_element = $form_state->getTriggeringElement();
    $ajax_response = new AjaxResponse();
    $ajax_response->addCommand(new AlertCommand($triggering_element['#name']." = ".$triggering_element['#value']));
    return $ajax_response;
  }



  public function validateForm(array &$form, FormStateInterface $form_state) {
    return FALSE;
  }
  public function validateFormAjax(array &$form, FormStateInterface $form_state) {
    $valid = $this->validateForm($form, $form_state);
    $response = new AjaxResponse();
    if ($valid) {
      $message = $this->t('Email ok.');
    }
    else {
      $message = $this->t('Email not valid.');
    }
    $response->addCommand(new HtmlCommand('.horaire', $message));
    return $response;
  } 
  public function submitForm(array &$form, FormStateInterface $form_state) {

    $crud = new SessionCrudController;
    $crud->load();
       foreach ($form_state->getValues() as $key => $value) {
              dsm($key . ': ' . $value);
       } 

/*
    $acceunt = \Drupal::currentUser();

    $entry = array(
      'uid'           => $account->id(),
      'date'          => $form_state->getValue('date'),
      'horaires'      => $form_state->getValue('horaires'),
      'co_lieu'       => $form_state->getValue('lieu'),
      'co_resp'       => $form_state->getValue('formateur'),
      'duree_a_payer' => $form_state->getValue('duree_a_payer'),
      'duree_prevue'  => $form_state->getValue('duree_prevue'),
      'type_paiement' => $form_state->getValue('type_paiement'),
      'groupe'        => $form_state->getValue('groupe'),
    );

    if ( $form_state->getValue('sess_id') ==-1) {
      // Insert
      $DBWriteStatus = SessionCrudController::insert($entry);
    } else {
      // Update
      $entry['sess_id']  = $form_state->getValue('sess_id');
      $DBWriteStatus = SessionCrudController::update($entry);
    };
     */
  sleep(1);
  }

}
