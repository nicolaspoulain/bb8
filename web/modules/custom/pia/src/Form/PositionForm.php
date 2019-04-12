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
    $check=0, $position=0, $type='w', $co_orie=0, $co_modu=0, $co_degre=0) {

  $this->formId = rand(11111, 99999);

  $rnd = rand(0,1000000000);
  $form['f']['co_modu']  = array('#type' => 'hidden','#value' => $co_modu );
  $form['f']['co_degre']  = array('#type' => 'hidden','#value' => $co_degre );
  $form['f']['co_orie']  = array('#type' => 'hidden','#value' => $co_orie );
  $form['f']['type']  = array('#type' => 'hidden','#value' => $type );
  $form['f']['rnd']  = array('#type' => 'hidden','#value' => $rnd );
  $form['f']['check'.$rnd] = array(
    '#type' => 'checkbox',
    '#title' => '',
    '#default_value' => $check,
    '#prefix' => '<div class="inline">',
    '#suffix' => '</div>',
    '#ajax' => array(
      'callback' => [$this,'saveCheckAjax'],
      'progress' => array('type' => 'throbber', 'message' => '')
    ),
  );
  $form['f']['position'.$rnd] = array(
    '#type' => 'textfield', '#size' => 3,
    '#default_value' => (int)$position,
    '#states' => array(    // This #states rule limits visibility
      'visible' => array(  // action to take.
        ':input[name=check'.$rnd.']' => array('checked' => TRUE),),
    ),
    '#ajax' => array(
      'callback' => [$this,'saveAjax'],
      'progress' => array('type' => 'throbber', 'message' => '')),);
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
    ddl("klklkl");
  return $form;
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
  public function submitForm(array &$form, FormStateInterface $form_state) {

    $qu = $form_state->getUserInput('check');
    $rnd     = $qu['rnd'];
    $co_modu = $qu['co_modu'];
    $co_degre= $qu['co_degre'];
    $co_orie = $qu['co_orie'];
    $type    = $qu['type'];
    $check   = $qu['check'.$rnd];
    $position= $qu['position'.$rnd];
    $entry = array(
      'co_modu'  => $co_modu,
      'co_degre'  => $co_degre,
      'type'  => $type,
      'tid'  => $co_orie,
      'weight'  => $position,
    );
    $condition = array(
      'co_modu'  => $co_modu,
      'co_degre'  => $co_degre,
      'type'  => $type,
      'tid'  => $co_orie,
    );
    dpm($check);
    dpm($entry);
    if ($check) {
      $DBWriteStatus = BbCrudController::create('gbb_gmodu_taxonomy', $entry);
    } else {
      $DBWriteStatus = BbCrudController::delete('gbb_gmodu_taxonomy', $condition);
    }
  }
  public function saveCheckAjax(array &$form, FormStateInterface $form_state) {

    $qu = $form_state->getUserInput('check');
    $rnd     = $qu['rnd'];
    $co_modu = $qu['co_modu'];
    $co_degre= $qu['co_degre'];
    $co_orie = $qu['co_orie'];
    $type    = $qu['type'];
    $check   = $qu['check'.$rnd];
    $position= $qu['position'.$rnd];
    $entry = array(
      'co_modu'  => $co_modu,
      'co_degre'  => $co_degre,
      'type'  => $type,
      'tid'  => $co_orie,
      'weight'  => $position,
    );
    $condition = array(
      'co_modu'  => $co_modu,
      'co_degre'  => $co_degre,
      'type'  => $type,
      'tid'  => $co_orie,
    );
    dpm($check);
    dpm($entry);
    if ($check) {
      $DBWriteStatus = BbCrudController::create('gbb_gmodu_taxonomy', $entry);
    } else {
      $DBWriteStatus = BbCrudController::delete('gbb_gmodu_taxonomy', $condition);
    }
  }
  public function savePositionAjax(array &$form, FormStateInterface $form_state) {

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
