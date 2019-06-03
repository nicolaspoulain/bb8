<?php
/**
 * @file
 * Contains Drupal\etab\Form\EtabForm.
 */

namespace Drupal\etab\Form;


use Drupal\Core\Url;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\File\Entity\File;
use Drupal\bb\Controller\BbCrudController;

/**
 * Implements the ModalForm form controller.
 */
class EtabForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getTitle() {
    return 'Modification de la fiche etab';
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
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['co_lieu'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('RNE'),
      '#size'          => 30,
      '#attributes' => array('placeholder' => t('')),
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-1-2')),
    );
    $form['sigle'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Sigle'),
      '#size'          => 30,
      '#attributes' => array('placeholder' => t('')),
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-1-2')),
    );
    $form['denom_comp'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Nom'),
      '#size'          => 30,
      '#attributes' => array('placeholder' => t('')),
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-1-2')),
    );
    $form['adr'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Adresse'),
      '#size'          => 30,
      '#attributes' => array('placeholder' => t('')),
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-1-2')),
    );
    $form['cp'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Code Postal'),
      '#size'          => 30,
      '#attributes' => array('placeholder' => t('')),
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-1-2')),
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
      '#value'  => $this->t('Enregister'),
      '#submit' => array('::submitForm'),
    ];

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
    // $valid = $this->validateJournal($form, $form_state);

    // get co_resp form query string
    // $query = \Drupal::request()->query->all();
    $condition = array(
      'co_resp' => \Drupal::request()->query->get('co_resp'),
    );

    $entry = array(
      'co_lieu'   => $form_state->getValue('co_lieu'),
      'sigle' => $form_state->getValue('sigle'),
      'denom_comp'    => $form_state->getValue('denom_comp'),
      'adr'    => $form_state->getValue('adr'),
      'cp'    => $form_state->getValue('cp'),
    );
    BbCrudController::create( 'gbb_netab_dafor', $entry);
    $form_state->setRedirect('view.bb_lieux_de_stage.page_1',
      array(
        'co_lieu' => $form_state->getValue('co_lieu'),
      )
    );
    return TRUE;
  }
}
