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
use Drupal\bb\Controller\BbCrudController;

/**
 * Implements the ModalForm form controller.
 */
class ModalForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getTitle($sess_id) {
    return 'Modification de la session n°'.$sess_id;
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
  public function buildForm(array $form, FormStateInterface $form_state, $options = NULL) {

    $current_uri = \Drupal::request()->getRequestUri();
    $path_args = array_slice(explode('/',$current_uri),-3,1);
    $sess_id = $path_args[0];
    // get informations on session
    $entries = BbCrudController::load('gbb_session', [ 'sess_id' => $sess_id ] );
    $lieu = BbCrudController::load('gbb_netab_dafor', [ 'co_lieu' => $entries[0]->co_lieu ] );
    $entries[0]->denom_comp = $lieu[0]->denom_comp;
    $entries[0]->sigle = $lieu[0]->sigle;
    $resp = BbCrudController::load('gbb_gresp_dafor', [ 'co_resp' => $entries[0]->co_resp ] );
    $entries[0]->nomu = $resp[0]->nomu;
    $entries[0]->prenom = $resp[0]->prenom;

    $form['#theme'] = 'modal';
    $form['#attributes'] = array('class' => array('pure-form','pure-form-stacked'));

    $form['sess_id'] = array(
      '#type' => 'hidden',
      // '#type' => 'textfield',
      '#value' => $sess_id,
    );
    $form['co_modu'] = array(
      '#type' => 'hidden',
      // '#type' => 'textfield',
      '#default_value' => $entries[0]->co_modu,
    );
    if ($sess_id==1) $form['co_modu']['#default_value']=$co_modu;
    $form['co_degre'] = array(
      '#type' => 'hidden',
      // '#type' => 'textfield',
      '#default_value' => $entries[0]->co_degre,
    );
    if ($sess_id==1) $form['co_degre']['#default_value']=$co_degre;
    $form['date'] = array(
      '#type' => 'date',
      '#title' => t('Date'),
      // '#required' => TRUE,
      '#default_value' => $entries[0]->date,
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-10-24')),
    );
    $form['lieu'] = array(
      '#type' => 'search',
      '#title' => $this->t('Lieu'),
      // '#required' => TRUE,
      '#default_value' => $entries[0]->sigle . " " . $entries[0]->denom_comp .
      " (" . $entries[0]->co_lieu . ")",
      '#autocomplete_route_name' => 'bb.autocomplete.lieu',
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-14-24')),
    );
    $form['horaires'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Horaires'),
      '#size'          => 20,
      '#default_value' => $entries[0]->horaires,
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-10-24')),
    );
    $form['formateur'] = array(
      '#type'          => 'textfield',
      '#title'         => $this->t('Formateur'),
      // '#required'   => TRUE,
      '#default_value' => $entries[0]->nomu,
      '#default_value' => $entries[0]->nomu . " "  . $entries[0]->prenom
                                            . " (" . $entries[0]->co_resp . ")",
      '#autocomplete_route_name' => 'bb.autocomplete.formateur',
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-14-24')),
    );


    $form['groupe'] = array(
      '#type'          => 'number',
      '#title'         => $this->t('Groupe'),
      '#default_value' => $entries[0]->groupe,
      '#attributes'    => array(
        'min'  => 1,
        'max'  => 99,
        'step' => 1,
      ),
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-10-24')),
    );
    $form['type_paiement'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Type pmt'),
      '#default_value' => $entries[0]->type_paiement,
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-14-24')),
    );
    $form['duree_prevue'] = array(
      '#type'          => 'textfield',
      '#title'         => $this->t('DàP'),
      '#size'          => 20,
      '#default_value' => $entries[0]->duree_prevue,
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-14-24')),
    );

    // Group submit handlers in an actions element with a key of "actions" so
    // that it gets styled correctly, and so that other modules may add actions
    // to the form.
    $form['actions'] = [
      '#type' => 'actions',
    ];

    // Add a submit button that handles the submission of the form.
    $form['actions']['submit'] = [
      '#type'   => 'submit',
      '#value'  => $this->t('Submit'),
      '#submit' => array('::submitForm'),
    ];

    return $form;
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
      'co_modu'       => $form_state->getValue('co_modu'),
      'co_degre'      => $form_state->getValue('co_degre'),
      'date'          => $form_state->getValue('date'),
      'date_ts'       => strtotime($form_state->getValue('date')),
      'horaires'      => $form_state->getValue('horaires'),
      'co_lieu'       => $form_state->getValue('lieu'),
      'co_resp'       => $form_state->getValue('formateur'),
      'duree_prevue'  => $form_state->getValue('duree_prevue'),
      'type_paiement' => $form_state->getValue('type_paiement'),
      'groupe'        => $form_state->getValue('groupe'),
      'date_modif'    => date("Y-m-d H:i:s"),
    );

    if ( $form_state->getValue('sess_id') == 1) {
      // Insert
      $DBWriteStatus = BbCrudController::create('gbb_session', $entry);
    } else {
      // Update
      $entry['sess_id']  = $form_state->getValue('sess_id');
      $DBWriteStatus = BbCrudController::update('gbb_session', $entry, array('sess_id' => $form_state->getValue('sess_id')));
    };

    $form_state->setRedirect('bb.moduleng',
      array(
        'co_degre' => $form_state->getValue('co_degre'),
        'co_modu'  => $form_state->getValue('co_modu')
      ),
      array( 'fragment' => 'sessions')
    );
  }

}
