<?php
/**
 * @file
 * Contains Drupal\bb\Form\DSFinfoForm.
 */

namespace Drupal\bb\Form;

use Drupal\Core\Ajax\ChangedCommand;
use Drupal\Core\Ajax\InvokeCommand;


use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\CssCommand;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\bb\Controller\BbCrudController;


/**
 * Implements the ModalForm form controller.
 */
class DSFinfoForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getTitle() {
    return 'Modification du DSF';
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'DSFinfoForm';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, $co_degre=NULL, $co_modu=NULL) {

    $entry = array(
      'co_degre' => $co_degre,
      'co_modu'  => $co_modu,
    );
    $module = BbCrudController::load( 'gbb_gmodu_plus', $entry);

    $form['co_degre'] = array(
      '#type'    => 'hidden',
      '#value' => $co_degre,
    );
    $form['co_modu'] = array(
      '#type'    => 'hidden',
      '#value' => $co_modu,
    );
    $form['DSF_info'] = array(
      '#type' => 'textarea', // WYSIWYG != textarea
      // '#type'=>'text_format',
      '#title' => 'Remarques sur les Déclarations de Service Fait',
      '#default_value' => (!empty($module))? strip_tags($module[0]->DSF_info) : '',
      '#description' => '',
      '#rows' => 3,
      '#ajax' => [
        'callback' => '::saveDSFAjax',
        'event' => 'change',
        'progress' => array(
          'type' => 'throbber',
          'message' => t('Enregistrement...'),
        ),
      ],
    );
    // $form['submit'] = array(
      // '#type' => 'submit',
      // '#value' => t('Submit'),
    // );
    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    // $valid = $this->validatDSF($form, $form_state);

    $condition = array(
      'co_degre' => $form_state->getValue('co_degre'),
      'co_modu' => $form_state->getValue('co_modu'),
    );
    $entry = array(
      'DSF_info'  => $form_state->getValue('DSF_info')['value'],
    );
    $row = BbCrudController::load('gbb_gmodu_plus', $condition);
    if (!empty($row)) {
      $DBWriteStatus = BbCrudController::update('gbb_gmodu_plus', $entry, $condition);
    } else {
      $DBWriteStatus = BbCrudController::create('gbb_gmodu_plus', array_merge($condition,$entry));
    }
    return TRUE;
  }

  /**
   * Validate DSF field.
   */
  protected function validateDSF(array &$form, FormStateInterface $form_state) {
    return TRUE;
  }

  /**
   * Ajax callback to save DSF field.
   */
  public function saveDSFAjax(array &$form, FormStateInterface $form_state) {

    $condition = array(
      'co_degre' => $form_state->getValue('co_degre'),
      'co_modu' => $form_state->getValue('co_modu'),
    );
    $entry = array(
      'DSF_info'  => $form_state->getValue('DSF_info'),
    );
    $row = BbCrudController::load('gbb_gmodu_plus', $condition);
    if (!empty($row)) {
      $DBWriteStatus = BbCrudController::update('gbb_gmodu_plus', $entry, $condition);
    } else {
      $DBWriteStatus = BbCrudController::create('gbb_gmodu_plus', array_merge($condition,$entry));
    }
    $response = new AjaxResponse();
    return $response;
  }



}
