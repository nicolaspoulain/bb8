<?php
/**
 * @file
 * Contains Drupal\offres\Form\IufmForm.
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
 * Implements the IufmForm form controller.
 */
class IufmForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getTitle() {
    return 'Modification de la iufm';
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'IufmForm';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, $iufm=NULL, $co_omodu=NULL) {

  $form['co_omodu']  = array('#type' => 'hidden','#value' => $co_omodu );
  $form['iufm'] = array(
    '#type' => 'select',
    '#options' => array(
      '0'       =>'-',
      'rectorat'=>'Rectorat',
      'ESPE'    =>'ESPE',
      'Paris1'  =>'Paris1',
      'Paris3'  =>'Paris3',
      'Paris4'  =>'Paris4',
      'Paris5'  =>'Paris5',
      'Paris6'  =>'Paris6',
      'Paris7'  =>'Paris7',
      'Paris8'  =>'Paris8',
      'Paris10' =>'Paris10',
      'CNAM'    =>'CNAM',
      'CANOPE'  =>'CANOPE',
      'Autres'  =>'Autres'
    ),
    '#default_value' => $iufm,
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
      'iufm'  => $form_state->getValue('iufm'),
    );
    $row = BbCrudController::load('gbb_gdiof_dafor', $condition);
    if (!empty($row)) {
      $DBWriteStatus = BbCrudController::update('gbb_gdiof_dafor', $entry, $condition);
    } else {
      $DBWriteStatus = BbCrudController::create('gbb_gdiof_dafor', array_merge($condition,$entry));
    }
  }
}
