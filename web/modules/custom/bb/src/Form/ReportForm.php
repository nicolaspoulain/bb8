<?php
/**
 * @file
 * Contains Drupal\bb\Form\ReportForm.
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
class ReportForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getTitle() {
    return 'Modification du journal';
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'ReportForm';
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
    if ($co_degre==1) {
    $form['report'] = array(
      '#type' => 'checkbox', // WYSIWYG != textarea
      '#title' => '<i class="fas fa-registered fa-lg pink"></i> Report COVID-19',
      '#default_value' => (!empty($module))? $module[0]->report : '',
      '#description' => '',
      '#ajax' => [
        'callback' => '::saveAjax',
        'event' => 'change',
        'progress' => array(
          'type' => 'throbber',
          'message' => t('Enregistrement...'),
        ),
      ],
    );
    }
    // $form['submit'] = array(
      // '#type' => 'submit',
      // '#value' => t('Submit'),
    // );
    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    // $valid = $this->validateJournal($form, $form_state);

    $condition = array(
      'co_degre' => $form_state->getValue('co_degre'),
      'co_modu' => $form_state->getValue('co_modu'),
    );
    $entry = array(
      'report'  => $form_state->getValue('report')['value'],
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
   * Validate journal field.
   */
  protected function validateJournal(array &$form, FormStateInterface $form_state) {
    return TRUE;
  }

  /**
   * Ajax callback to save journal field.
   */
  public function saveAjax(array &$form, FormStateInterface $form_state) {

    $condition = array(
      'co_degre' => $form_state->getValue('co_degre'),
      'co_modu' => $form_state->getValue('co_modu'),
    );
    $entry = array(
      'report'  => $form_state->getValue('report'),
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
