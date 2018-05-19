<?php
/**
 * @file
 * Contains Drupal\chart_block_example\Form\ModalForm.
 */

namespace Drupal\chart_block_example\Form;


use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\CloseModalDialogCommand;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\bb\Controller\BbCrudController;

/**
 * Implements the ModalForm form controller.
 */
class FormateurForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getTitle() {
    return 'Modification de la fiche formateur';
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


    $form['nomu'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Nom'),
      '#size'          => 15,
      '#default_value' => '7-11',
      '#attributes' => array('placeholder' => t('p.ex.: 9h-17h')),
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-10-24')),
    );

    $form['prenom'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Prénom'),
      '#size'          => 15,
      '#default_value' => '7-11',
      '#attributes' => array('placeholder' => t('p.ex.: 9h-17h')),
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-10-24')),
    );

    $form['email'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Email'),
      '#size'          => 15,
      '#default_value' => '7-11',
      '#attributes' => array('placeholder' => t('p.ex.: 9h-17h')),
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-10-24')),
    );

    $form['telephone'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Téléphone'),
      '#size'          => 15,
      '#default_value' => '7-11',
      '#attributes' => array('placeholder' => t('p.ex.: 9h-17h')),
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-10-24')),
    );

    $form['discipline'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('discipline'),
      '#size'          => 15,
      '#default_value' => '7-11',
      '#attributes' => array('placeholder' => t('p.ex.: 9h-17h')),
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-10-24')),
    );

    $form['grade'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Grade'),
      '#size'          => 15,
      '#default_value' => '7-11',
      '#attributes' => array('placeholder' => t('p.ex.: 9h-17h')),
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-10-24')),
    );

    $form['decharge'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Décharge'),
      '#size'          => 15,
      '#default_value' => '7-11',
      '#attributes' => array('placeholder' => t('p.ex.: 9h-17h')),
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-10-24')),
    );

    $form['resp_dafor'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Responsable DAFOR'),
      '#size'          => 15,
      '#default_value' => '7-11',
      '#attributes' => array('placeholder' => t('p.ex.: 9h-17h')),
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-10-24')),
    );

    $form['divers'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Divers'),
      '#size'          => 15,
      '#default_value' => '7-11',
      '#attributes' => array('placeholder' => t('p.ex.: 9h-17h')),
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-10-24')),
    );

    $form['statut'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Statut'),
      '#size'          => 15,
      '#default_value' => '7-11',
      '#attributes' => array('placeholder' => t('p.ex.: 9h-17h')),
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-10-24')),
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
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    $form_state->setRedirect('bb.moduleng',
      array(
        'co_degre' => $form_state->getValue('co_degre'),
        'co_modu'  => $form_state->getValue('co_modu')
      ),
      array( 'fragment' => 'sessions')
    );
  }

}
