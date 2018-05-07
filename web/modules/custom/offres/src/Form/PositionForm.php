<?php
/**
 * @file
 * Contains Drupal\offres\Form\PositionForm.
 */

namespace Drupal\offres\Form;

use Drupal\Core\Ajax\ChangedCommand;
use Drupal\Core\Ajax\InvokeCommand;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\CssCommand;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\bb\Controller\BbCrudController;


/**
 * Implements the PositionForm form controller.
 */
class PositionForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getTitle() {
    return 'Modification de la position';
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'PositionForm';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, $position=NULL, $co_omodu=NULL) {

  $form['co_omodu']  = array('#type' => 'hidden','#value' => $co_omodu );
  $form['position'] = array(
    '#type' => 'textfield', '#size' => 3,
    '#default_value' => (isset($position))? (int)$position : '0',
    '#ajax' => array(
      // 'callback' => 'Drupal\offres\Form\PositionForm::saveAjax',
      'callback' => [$this,'saveAjax'],
      'progress' => array('type' => 'throbber', 'message' => '')),);
  return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $valid = $this->validate($form, $form_state);
    return TRUE;
  }

  /**
   * Validate field.
   */
  protected function validate(array &$form, FormStateInterface $form_state) {
    return TRUE;
  }

  /**
   * Ajax callback to save field.
   */
  public function saveAjax(array &$form, FormStateInterface $form_state) {

    $condition = array(
      'co_omodu'  => $form_state->getValue('co_omodu'),
    );
    $entry = array(
      'position'  => $form_state->getValue('position'),
    );
    $module = BbCrudController::update( 'gbb_gdiof_dafor', $entry, $condition);
    dpm($condition);
    dpm($entry);
  }
}
