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
    $path_args = array_slice(explode('/',$current_uri),-3,3);
    $sess_id  = $path_args[0];
    $co_degre = $path_args[1];
    $co_modu  = $path_args[2];
    $sess = \Drupal\gaia\Entity\Session::load($sess_id);
    // get extra informations
    $lieu = BbCrudController::load('gbb_netab_dafor', [ 'co_lieu' => $sess->co_lieu->value ] );
    $resp = BbCrudController::load('gbb_gresp_dafor', [ 'co_resp' => $sess->co_resp->value ] );

    $form['#theme'] = 'modal';
    $form['#attributes'] = array('class' => array('pure-form','pure-form-stacked'));

    $form['sess_id'] = array(
      '#type' => 'hidden',
      // '#type' => 'textfield',
      '#value' => $sess->sess_id->value,
    );
    $form['co_modu'] = array(
      '#type' => 'hidden',
      // '#type' => 'textfield',
      '#default_value' => $sess->co_modu->value,
    );
    $form['co_degre'] = array(
      '#type' => 'hidden',
      // '#type' => 'textfield',
      '#default_value' => $sess->co_degre->value,
    );
    $form['date'] = array(
      '#type' => 'date',
      '#title' => t('Date'),
      // '#required' => TRUE,
      '#default_value' => $sess->date->value,
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-10-24')),
    );
    $form['lieu'] = array(
      '#type' => 'search',
      '#title' => $this->t('Lieu'),
      // '#required' => TRUE,
      '#default_value' => $lieu[0]->sigle
                 . "  " . $lieu[0]->denom_comp
                 . " (" . $sess->co_lieu->value . ")",
      '#autocomplete_route_name' => 'bb.autocomplete.lieu',
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-14-24')),
    );
    $form['horaires'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Horaires'),
      '#size'          => 20,
      '#default_value' => $sess->horaires->value,
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-10-24')),
    );
    $form['formateur'] = array(
      '#type'          => 'textfield',
      '#title'         => $this->t('Formateur'),
      // '#required'   => TRUE,
      '#default_value' => $resp[0]->nomu
                 . "  " . $resp[0]->prenom
                 . " (" . $sess->co_resp->value . ")",
      '#autocomplete_route_name' => 'bb.autocomplete.formateur',
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-14-24')),
    );
    $form['groupe'] = array(
      '#type'          => 'number',
      '#title'         => $this->t('Groupe'),
      '#default_value' => $sess->groupe->value,
      '#attributes'    => array(
        'min'  => 1,
        'max'  => 99,
        'step' => 1,
      ),
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-10-24')),
    );
    $form['duree_a_payer'] = array(
      '#type'          => 'textfield',
      '#title'         => $this->t('Pmt (h)'),
      '#size'          => 6,
      '#default_value' => $sess->duree_a_payer->value,
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-4-24')),
    );
    $form['type_paiement'] = array(
      '#type' => 'select',
      '#title' => $this->t('Type pmt'),
      '#options' => array(
          'VAC'  => 'VAC',
          'CONV' => 'CONV',
          'BDC'  => 'BDC',
          'DECH' => 'DECH',
          'HSE'  => 'HSE',
          'SF'   => 'SF',
       ),
      '#default_value' => $sess->type_paiement->value,
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-7-24')),
    );

    // Session 1 : create a session
    if ($sess_id==1) {
      $form['co_modu']['#default_value']=$co_modu;
      $form['co_degre']['#default_value']=$co_degre;
      $form['date']['#default_value']=date('Y-m-d');
      $form['lieu']['#default_value']='';
      $form['horaires']['#default_value']='9h-17h';
      $form['formateur']['#default_value']='';
    };

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
    preg_match('#\((.*?)\)#', $form_state->getValue('lieu'), $co_lieu);
    // $form_state->setValue('lieu', $co_lieu[1]);
    if ( FALSE )
      $form_state->setErrorByName('lieu', $this->t('Problème !'));
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // $valid = $this->validateForm($form, $form_state);
    $account = \Drupal::currentUser();
    $sess_id = $form_state->getValue('sess_id');
    $sess = \Drupal\gaia\Entity\Session::load($sess_id);

    preg_match('#\((.*?)\)#', $form_state->getValue('lieu'), $co_lieu);
    preg_match('#\((.*?)\)#', $form_state->getValue('formateur'), $co_resp);

    $sess->date_ts       = strtotime($form_state->getValue('date'));
    $sess->date          = $form_state->getValue('date');
    $sess->horaires      = $form_state->getValue('horaires');
    $sess->co_lieu       = $co_lieu[1];
    $sess->co_resp       = $co_resp[1];
    $sess->duree_a_payer = $form_state->getValue('duree_a_payer');
    $sess->type_paiement = $form_state->getValue('type_paiement');
    $sess->groupe        = $form_state->getValue('groupe');
    $sess->date_modif    = date("Y-m-d H:i:s");
    $sess->uid           = $account->id();
    $sess->save();

    $form_state->setRedirect('bb.moduleng',
      array(
        'co_degre' => $form_state->getValue('co_degre'),
        'co_modu'  => $form_state->getValue('co_modu')
      ),
      array( 'fragment' => 'sessions')
    );
  }

}
