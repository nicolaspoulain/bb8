<?php
/**
 * @file
 * Contains Drupal\bb\Form\JournalForm.
 */

namespace Drupal\bb\Form;

use Drupal\Core\Ajax\ChangedCommand;
use Drupal\Core\Ajax\InvokeCommand;


use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\CssCommand;
use Drupal\Core\Ajax\HtmlCommand;


/**
 * Implements the ModalForm form controller.
 */
class JournalForm extends FormBase {

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
    return 'fapi_example_modal_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface
    $form_state) {

    // $module = ModuleCrudController::load( [ 'co_modu' => $co_modu ] );

   $form['journal'] = array(
      '#type' => 'textarea',
      '#title' => 'Journal',
      '#description' => '',
  '#ajax' => [
    'callback' => '::validateEmailAjax',
    'event' => 'change',
    'progress' => array(
      'type' => 'throbber',
      'message' => t('Verifying email...'),
    ),
  ],
  '#suffix' => '<span class="journal-valid-message"></span>'
    );


    return $form;
  }
	  public function submitForm(array &$form, FormStateInterface $form_state) {
			    drupal_set_message('Nothing Submitted. Just an Example.');
					  }
/**
 * {@inheritdoc}
 */
protected function validateEmail(array &$form, FormStateInterface $form_state) {
  if (substr($form_state->getValue('email'), -4) !== '.com') {
  return TRUE;
    return FALSE;
  }
  return TRUE;
}

/**
 * Ajax callback to validate the email field.
 */
public function validateEmailAjax(array &$form, FormStateInterface $form_state) {
  $valid = $this->validateEmail($form, $form_state);
  $response = new AjaxResponse();
  if ($valid) {
    $css = ['border' => '1px solid green'];
    $message = $this->t('Email ok.');
  }
  else {
    $css = ['border' => '1px solid red'];
    $message = $this->t('Email not valid.');
  }
  $response->addCommand(new CssCommand('#journal-email', $css));
  $response->addCommand(new HtmlCommand('.journal-valid-message', $message));
  return $response;
}



  }
