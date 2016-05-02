<?php
/**
 * @file
 * Contains Drupal\bb\Form\ModalForm.
 */

namespace Drupal\bb\Form;


use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\CloseModalDialogCommand;
use Drupal\Core\Ajax\HtmlCommand;

/**
 * Implements the ModalForm form controller.
 *
 * This example demonstrates implementation of a form that is designed to be
 * used as a modal form.  To properly display the modal the link presented by
 * the \Drupal\fapi_example\Controller\Page page controller loads the Drupal
 * dialog and ajax libraries.  The submit handler in this class returns ajax
 * commands to replace text in the calling page after submission .
 *
 * @see \Drupal\Core\Form\FormBase
 */
class ModalForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state,$sess_id = 1) {
    $form['#prefix'] = '<div id="fapi-example-modal-form">';
    $form['#suffix'] = '</div>';
    // $form['title'] = [
      // '#type' => 'textfield',
      // '#title' => $this->t('Tiiitle'),
      // '#required' => TRUE,
    // ];
      $form['sess_id'] = array(
        '#type' => 'hidden',
        '#value' => $sess_id,
      );
      $form['date'] = array(
        '#type' => 'date',
        '#title' => t('Date'),
        // '#required' => TRUE,
        '#default_value' => $entries[0]->date,
      );
      $form['horaires'] = array(
        '#type' => 'textfield',
        '#title' => $this->t('Horaires'),
        '#default_value' => $entries[0]->horaires,
        '#default_value' => $sess_id,
      );
      $form['lieu'] = array(
        '#type' => 'search',
        '#title' => $this->t('Lieu'),
        // '#required' => TRUE,
        '#default_value' => $entries[0]->lieu,
        '#autocomplete_route_name' => 'bb.autocomplete.lieu',
      );
      $form['formateur'] = array(
        '#type' => 'textfield',
        '#title' => $this->t('Formateur'),
        // '#required' => TRUE,
        '#default_value' => $entries[0]->formateur,
        '#autocomplete_route_name' => 'bb.autocomplete.formateur',
      );
      $form['duree_a_payer'] = array(
        '#type' => 'textfield',
        '#title' => $this->t('Duree_a_payer'),
        '#size' => 10, 
        '#default_value' => $entries[0]->duree_a_payer,
      );
      $form['duree_prevue'] = array(
        '#type' => 'textfield',
        '#title' => $this->t('duree_prevue'),
        '#size' => 10, 
        '#default_value' => $entries[0]->duree_prevue,
      );
      $form['type_paiement'] = array(
        '#type' => 'textfield',
        '#title' => $this->t('Type pmt'),
        '#default_value' => $entries[0]->type_paiement,
      );
      $form['groupe'] = array(
        '#type' => 'number',
        '#title' => $this->t('Groupe'),
        '#default_value' => $entries[0]->groupe,
        '#attributes' => array(
          'min'  => 1,
          'max'  => 99,
          'step' => 1,
        ),
      );

    // Group submit handlers in an actions element with a key of "actions" so
    // that it gets styled correctly, and so that other modules may add actions
    // to the form.
    $form['actions'] = [
      '#type' => 'actions',
    ];

    // Add a submit button that handles the submission of the form.
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
      '#ajax' => [
        'callback' => '::ajaxSubmitForm',
        'event' => 'click',
      ]
    ];

    return $form;
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
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $title = $form_state->getValue('title');
    $message = t('Submit handler: You specified a title of %title.', ['%title' => $title]);
    drupal_set_message($message);
  }

  /**
   * Implements the sumbit handler for the ajax call.
   *
   * @param array $form
   *   Render array representing from.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   Current form state.
   *
   * @return \Drupal\Core\Ajax\AjaxResponse
   *   Array of ajax commands to execute on submit of the modal form.
   */
  public function ajaxSubmitForm(array &$form, FormStateInterface $form_state) {

    // At this point the submit handler has fired.
    // Clear the message set by the submit handler.
    drupal_get_messages();

    // We begin building a new ajax reponse.
    $response = new AjaxResponse();
    if ($form_state->getErrors()) {
      unset($form['#prefix']);
      unset($form['#suffix']);
      $form['status_messages'] = [
        '#type' => 'status_messages',
        '#weight' => -10,
      ];
      $response->addCommand(new HtmlCommand('#fapi-example-modal-form', $form));
    }
    else {
      $title = $form_state->getValue('title');
      $message = t('You specified a tiiiitle of %title.', ['%title' => $title]);
      $content = [
        '#type' => 'html_tag',
        '#tag' => 'p',
        '#value' => $message,
      ];
      $response->addCommand(new HtmlCommand('#fapi-example-message', $content));
      $response->addCommand(new CloseModalDialogCommand());
    }
    return $response;
  }

}
