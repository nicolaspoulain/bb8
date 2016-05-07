<?php
/**
 * @file
 * Contains Drupal\bb\Form\ModalForm.
 */

namespace Drupal\bb\Form;


use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\CloseModalDialogCommand;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\bb\Controller\SessionCrudController;

/**
 * Implements the ModalForm form controller.
 */
class ModalForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface
    $form_state,$sess_id = 1) {

    $entries = SessionCrudController::load( [ 'sess_id' => $sess_id ] );
    $form['sess_id'] = array(
      '#type' => 'hidden',
      '#value' => $sess_id,
    );
    $form['date'] = array(
      '#type' => 'date',
      '#title' => t('Date'),
      // '#required' => TRUE,
      '#default_value' => $entries[0]->date,
    );
    $form['horaires'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Horaires'),
      '#default_value' => $entries[0]->horaires,
    );
    $form['lieu'] = array(
      '#type' => 'search',
      '#title' => $this->t('Lieu'),
      // '#required' => TRUE,
      '#default_value' => $entries[0]->sigle . " " . $entries[0]->denom_comp .
      " (" . $entries[0]->co_lieu . ")",
      '#autocomplete_route_name' => 'bb.autocomplete.lieu',
    );
    $form['formateur'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Formateur'),
      // '#required' => TRUE,
      '#default_value' => $entries[0]->nomu,
      '#default_value' => $entries[0]->nomu . " " . $entries[0]->prenom .
      " (" . $entries[0]->co_resp . ")",
      '#autocomplete_route_name' => 'bb.autocomplete.formateur',
    );
    $form['duree_a_payer'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Duree_a_payer'),
      '#size' => 10, 
      '#default_value' => $entries[0]->duree_a_payer,
    );
    $form['duree_prevue'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('duree_prevue'),
      '#size' => 10, 
      '#default_value' => $entries[0]->duree_prevue,
    );
    $form['type_paiement'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Type pmt'),
      '#default_value' => $entries[0]->type_paiement,
    );
    $form['groupe'] = array(
      '#type' => 'number',
      '#title' => $this->t('Groupe'),
      '#default_value' => $entries[0]->groupe,
      '#attributes' => array(
        'min'  => 1,
        'max'  => 99,
        'step' => 1,
      ),
    );

    // Group submit handlers in an actions element with a key of "actions" so
    // that it gets styled correctly, and so that other modules may add actions
    // to the form.
    $form['actions'] = [
      '#type' => 'actions',
    ];

    // Add a submit button that handles the submission of the form.
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
      '#submit'   => array('::submitForm'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'fapi_example_modal_form';
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    preg_match('#\((.*?)\)#', $form_state->getValue('formateur'), $co_resp);
    $form_state->setValue('formateur', $co_resp[1]);
    if ( !is_numeric($co_resp[1]) )
      $form_state->setErrorByName('formateur', $this->t('Problème !'));

    preg_match('#\((.*?)\)#', $form_state->getValue('lieu'), $co_lieu);
    $form_state->setValue('lieu', $co_lieu[1]);
    if ( FALSE )
      $form_state->setErrorByName('lieu', $this->t('Problème !'));
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    $account = \Drupal::currentUser();

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

    $form_state->setRedirect('bb.moduleng',array());
  }

}
