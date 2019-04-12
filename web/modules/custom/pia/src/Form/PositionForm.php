<?php
/**
 * @file
 * Contains Drupal\pia\Form\PositionForm.
 */

namespace Drupal\pia\Form;

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
    return 'PositionForm_'. $this->formId;
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state,
    $check=0, $position=0, $co_omodu=0) {

  $this->formId = rand(11111, 99999);

  $rnd = rand(0,1000000000);
  $form['f']['co_omodu']  = array('#type' => 'hidden','#value' => $co_omodu );
  $form['f'][$rnd] = array(
    '#type' => 'checkbox',
    '#title' => '',
    '#default_value' => $check,
    '#prefix' => '<div class="inline">',
    '#suffix' => '</div>',
  );
  $form['f']['position'] = array(
    '#type' => 'textfield', '#size' => 3,
    '#default_value' => (int)$position,
    '#states' => array(    // This #states rule limits visibility
      'visible' => array(  // action to take.
        ':input[name='.$rnd.']' => array('checked' => TRUE),),
    ),
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
      'position'  => $form_state->getValue('position'),
    );
    $row = BbCrudController::load('gbb_gdiof_dafor', $condition);
    if (!empty($row)) {
      $DBWriteStatus = BbCrudController::update('gbb_gdiof_dafor', $entry, $condition);
    } else {
      $DBWriteStatus = BbCrudController::create('gbb_gdiof_dafor', array_merge($condition,$entry));
    }
  }
}
