<?php
/**
 * @file
 * Contains Drupal\offres\Form\NbHpForm.
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
 * Implements the NbHpForm form controller.
 */
class NbHpForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getTitle() {
    return 'Modification de la nb_hp';
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'NbHpForm_'. $this->formId;
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, $nb_hp=NULL, $co_omodu=NULL) {

  $this->formId = rand(11111, 99999);

  $form['co_omodu']  = array('#type' => 'hidden','#value' => $co_omodu );
  $form['nb_hp'] = array(
    '#type' => 'textfield', '#size' => 1,
    '#default_value' => (isset($nb_hp))? (int)$nb_hp : '0',
    '#ajax' => array(
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

    $coo = $form_state->getUserInput('co_omodu');
    $condition = array(
      'co_omodu'  => $coo['co_omodu'],
    );
    $entry = array(
      'nb_hp'  => $form_state->getValue('nb_hp'),
    );
    $row = BbCrudController::load('gbb_gdiof_dafor', $condition);
    if (!empty($row)) {
      $DBWriteStatus = BbCrudController::update('gbb_gdiof_dafor', $entry, $condition);
    } else {
      $DBWriteStatus = BbCrudController::create('gbb_gdiof_dafor', array_merge($condition,$entry));
    }
  }
}
