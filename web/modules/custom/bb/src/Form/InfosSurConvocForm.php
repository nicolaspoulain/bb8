<?php
/**
 * @file
 * Contains Drupal\bb\Form\InfosSurConvocForm.
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
class InfosSurConvocForm extends FormBase {

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
    return 'InfosSurConvocForm';
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
    $form['infossurconvoc'] = array(
      '#type' => 'textarea',
      // '#type'=>'text_format', // WYSIWYG textarea est mieux :
      '#title' => 'Infos à porter sur la convocation',
      '#default_value' => $module[0]->convoc_info_on,
      '#description' => '',
      '#rows' => 5,
      // '#ajax' => [
        // 'callback' => '::saveJournalAjax',
        // 'event' => 'change',
        // 'progress' => array(
          // 'type' => 'throbber',
          // 'message' => t('Enregistrement...'),
        // ),
      // ],
    );
    $form['submit'] = array(
      '#type' => 'submit',
      '#value' => t('Submit'),
    );
    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $valid = $this->validateJournal($form, $form_state);

    $condition = array(
      'co_degre' => $form_state->getValue('co_degre'),
      'co_modu' => $form_state->getValue('co_modu'),
    );
    $entry = array(
      'convoc_info_on'  => $form_state->getValue('infossurconvoc'),
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
  // public function saveJournalAjax(array &$form, FormStateInterface $form_state) {
    // $valid = $this->validateJournal($form, $form_state);

    // $condition = array(
      // 'co_degre' => $form_state->getValue('co_degre'),
      // 'co_modu' => $form_state->getValue('co_modu'),
    // );

    // $entry = array(
      // 'organisation'  => $form_state->getValue('organisation'),
    // );
    // $module = BbCrudController::update( 'gbb_gmodu_plus', $entry, $condition);

    // $response = new AjaxResponse();
    // return $response;
  // }



}
