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
  public function buildForm(array $form, FormStateInterface
    $form_state,$sess_id = 1) {

    $entries = SessionCrudController::load( [ 'sess_id' => $sess_id ] );

    // On applique le theme session
    // voir HOOK_theme bb_theme dans module/custom/bb/bb.module
    $form['#theme'] = 'modal';

    $form['#attributes'] = array('class' => array('pure-form','pure-form-stacked'));

    $form['sess_id'] = array(
      '#type' => 'hidden',
      '#value' => $sess_id,
    );
    $form['co_modu'] = array(
      '#type' => 'hidden',
      '#default_value' => $entries[0]->co_modu,
    );
    $form['co_degre'] = array(
      '#type' => 'hidden',
      '#default_value' => $entries[0]->co_degre,
    );
    $form['date'] = array(
      '#type' => 'date',
      '#title' => t('Date'),
      // '#required' => TRUE,
      '#default_value' => $entries[0]->date,
      '#attributes' => array('class' => array('pure-u-23-24')),
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-3-24')),
    );
    $form['horaires'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Horaires'),
      '#default_value' => $entries[0]->horaires,
      '#attributes' => array('class' => array('pure-u-23-24')),
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-3-24')),
    );
    $form['lieu'] = array(
      '#type' => 'search',
      '#title' => $this->t('Lieu'),
      // '#required' => TRUE,
      '#default_value' => $entries[0]->sigle . " " . $entries[0]->denom_comp .
      " (" . $entries[0]->co_lieu . ")",
      '#autocomplete_route_name' => 'bb.autocomplete.lieu',
      '#attributes' => array('class' => array('pure-u-23-24')),
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-9-24')),
    );
    $form['formateur'] = array(
      '#type'          => 'textfield',
      '#title'         => $this->t('Formateur'),
      // '#required'   => TRUE,
      '#default_value' => $entries[0]->nomu,
      '#default_value' => $entries[0]->nomu . " "  . $entries[0]->prenom
                                            . " (" . $entries[0]->co_resp . ")",
      '#autocomplete_route_name' => 'bb.autocomplete.formateur',
      '#attributes' => array('class' => array('pure-u-23-24')),
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-9-24')),
    );

  // $default_value = ($r->convoc_sent)? 1 : $r->session_alert;
  // mal compris par les conseillers
  // $form['session_alert'] = array(
    // '#type' => 'checkbox',
    // '#title' => variable_get('ico_alert') .
                // t(' Alerte'),
    // '#default_value' => $entries[0]->session_alert,
    // '#prefix' => '<div class="inline">',
    // '#suffix' => '</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',
    // '#states' => array(
      // 'visible' => array( // action to take.
        // ':input[name="en_attente"]' => array('checked' => FALSE),
      // ),
    //),
  // );
    $form['session_alert'] = array(
      '#type'          => 'checkbox',
      '#title'         => $this->t('Alerte'),
      '#default_value' => $entries[0]->session_alert,
      '#attributes' => array('class' => array('pure-u-23-24')),
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-2-24')),
      '#states' => array(
        'visible' => array( // action to take.
          ':input[name="en_attente"]' => array('checked' => FALSE),
        ),
      ),
    );
    $form['en_attente'] = array(
      '#type'          => 'checkbox',
      '#title'         => $this->t('Pause'),
      '#default_value' => $entries[0]->en_attente,
      '#attributes' => array('class' => array('pure-u-23-24')),
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-2-24')),
      '#states' => array(    // This #states rule limits visibility
        'visible' => array(  // action to take.
          ':input[name="session_alert"]' => array('checked' => FALSE),
          ':input[name="convoc_sent"]' => array('checked' => FALSE),
        ),
      ),
    );
    $form['convoc_sent'] = array(
      '#type'          => 'checkbox',
      '#title'         => $this->t('Envoyé'),
      '#default_value' => $entries[0]->convoc_sent,
      '#attributes' => array('class' => array('pure-u-23-24')),
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-2-24')),
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
      '#attributes' => array('class' => array('pure-u-23-24')),
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-2-24')),
    );
    $form['duree_a_payer'] = array(
      '#type'          => 'textfield',
      '#title'         => $this->t('DàP'),
      '#size'          => 10,
      '#default_value' => $entries[0]->duree_a_payer,
      '#attributes'    => array('class' => array('pure-u-23-24')),
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-2-24')),
    );
    $form['duree_prevue'] = array(
      '#type'          => 'textfield',
      '#title'         => $this->t('DP'),
      '#size'          => 10,
      '#default_value' => $entries[0]->duree_prevue,
      '#attributes'    => array('class' => array('pure-u-23-24')),
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-2-24')),
    );
    $form['type_paiement'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Type pmt'),
      '#default_value' => $entries[0]->type_paiement,
      '#attributes' => array('class' => array('pure-u-23-24')),
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-2-24')),
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

    $form_state->setRedirect('bb.moduleng',
      array(
        'co_degre' => $form_state->getValue('co_degre'),
        'co_modu'  => $form_state->getValue('co_modu')
      )
    );
  }

}
