<?php
/**
 * @file
 * Contains Drupal\offres\Form\FiltresForm.
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
 * Implements the FiltresForm form controller.
 */
class FiltresForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getTitle() {
    return 'Modification de la comment';
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'FiltresForm_'. $this->formId;
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, $comment=NULL, $co_omodu=NULL) {

  $form['nomu'] = array(
    '#type' => 'textfield',
    '#title' => $this->t('Intelocuteur dispo'),
    '#size'          => 15,
    '#attributes' => array('placeholder' => t('p.ex.: Dupond')),
    '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-10-24')),
  );
  $form['co_orie'] = array(
    '#type' => 'textfield',
    '#title' => $this->t('Code Orientation'),
    '#size'          => 15,
    '#attributes' => array('placeholder' => t('p.ex.: 2S49')),
    '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-10-24')),
  );
  $form['co_omodu']  = array('#type' => 'hidden','#value' => $co_omodu );
  // Group submit handlers in an actions element with a key of "actions" so
  // that it gets styled correctly, and so that other modules may add actions
  // to the form.
  $form['actions'] = [
    '#type' => 'actions',
  ];

  // Add a submit button that handles the submission of the form.
  $form['actions']['submit'] = [
    '#type'   => 'submit',
    '#value'  => $this->t('Filtrer'),
    '#submit' => array('::submitForm'),
  ];

  return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $valid = $this->validate($form, $form_state);
    $entry = array(
      'nomu'       => $form_state->getValue('nomu'),
      'co_orie'       => $form_state->getValue('co_orie'),
    );
    $form_state->setRedirect('offres_list',
      array(
        'nomu' => $form_state->getValue('nomu'),
        'co_orie'  => $form_state->getValue('co_orie')
      ),
      array( 'fragment' => 'sessions')
    );

  }

  /**
   * Validate field.
   */
  protected function validate(array &$form, FormStateInterface $form_state) {
    return TRUE;
  }
}
