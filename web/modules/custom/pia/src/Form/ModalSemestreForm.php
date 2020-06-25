<?php
/**
 * @file
 * Contains Drupal\pia\Form\ModalSemestreForm.
 */

namespace Drupal\pia\Form;


use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\CloseModalDialogCommand;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\bb\Controller\BbCrudController;

/**
 * Implements the ModalForm form controller.
 */
class ModalSemestreForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getTitle($type) {
    return 'modif';
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
  public function buildForm(array $form, FormStateInterface $form_state,$co_modu=1,$co_degre=2, $type='edit') {

    // get informations on session
    $entries = BbCrudController::load('gbb_gmodu_plus', [ 'co_modu' => $co_modu, 'co_degre'=> $co_degre ] );
    $semestre = $entries[0]->semestre;
    // On applique le theme session
    // voir HOOK_theme bb_theme dans module/custom/bb/bb.module
    // $form['#theme'] = 'modal';

    // $form['#attributes'] = array('class' => array('pure-form','pure-form-stacked'));

    // sess_id=1 signifie duplication
    if ($type == 'copy') {
      $sess_id = 1;
    }

    $form['co_modu'] = array(
      '#type' => 'hidden',
      // '#type' => 'textfield',
      '#default_value' => $co_modu,
    );
    $form['co_degre'] = array(
      '#type' => 'hidden',
      // '#type' => 'textfield',
      '#default_value' => $co_degre,
    );

   $form['semestre'] = array(
    '#type' => 'radios',
    '#title' => t('Semestre'),
    '#default_value' => $semestre,
    '#options' => array(1 => t('1'), 2 => t('2')),
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

    $account = \Drupal::currentUser();
    $entries = BbCrudController::load('gbb_gmodu_plus', [ 'co_modu' => $co_modu, 'co_degre'=> $co_degre ] );

    $condition = array(
      'co_modu'       => $form_state->getValue('co_modu'),
      'co_degre'      => $form_state->getValue('co_degre'),
    );


    $entry = array(
      'semestre'       => $form_state->getValue('semestre'),
    );

    $row = BbCrudController::load('gbb_gmodu_plus', $condition);
    if (!empty($row)) {
      $DBWriteStatus = BbCrudController::update('gbb_gmodu_plus', $entry, $condition);
    } else {
      $DBWriteStatus = BbCrudController::create('gbb_gmodu_plus', array_merge($condition,$entry));
    }

    // $form_state->setRedirect('pia.modal_semestre_form',
      // array(
        // 'co_degre' => $form_state->getValue('co_degre'),
        // 'co_modu'  => $form_state->getValue('co_modu')
      // ),
      // array( 'fragment' => 'sessions')
    // );
  }

}
