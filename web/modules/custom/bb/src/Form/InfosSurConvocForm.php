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
  public function buildForm(array $form, FormStateInterface $form_state) {

    $current_uri = \Drupal::request()->getRequestUri();
    $path_args = array_slice(explode('/',$current_uri),-2,2);
    $entry = array(
      'co_degre' => $path_args[0],
      'co_modu'  => explode('?',$path_args[1])[0],
    );
    $module = BbCrudController::load( 'gbb_gmodu_plus', $entry);

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

    $current_uri = \Drupal::request()->getRequestUri();
    $path_args = array_slice(explode('/',$current_uri),-2,2);

    $condition = array(
      'co_degre' => $path_args[0],
      'co_modu'  => $path_args[1],
    );

    $entry = array(
      'convoc_info_on'  => $form_state->getValue('infossurconvoc'),
    );
    $module = BbCrudController::update( 'gbb_gmodu_plus', $entry, $condition);
    // drupal_set_message('Submitted.'.$path_args[0].'-'.$path_args[1]);
    // dpm($condition);
    // dpm($entry);
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

    // $current_uri = \Drupal::request()->getRequestUri();
    // $path_args = array_slice(explode('/',$current_uri),-2,2);

    // $condition = array(
      // 'co_degre' => $path_args[0],
      // 'co_modu'  => explode('?',$path_args[1])[0],
    // );

    // $entry = array(
      // 'organisation'  => $form_state->getValue('organisation'),
    // );
    // $module = BbCrudController::update( 'gbb_gmodu_plus', $entry, $condition);

    // $response = new AjaxResponse();
    // return $response;
  // }



}
