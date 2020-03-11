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
    $gets =\Drupal::request()->query->all();
    $nomu = $gets['nomu'];
    $co_orie = $gets['co_orie'];
    $co_tpla = $gets['co_tpla'];
    $co_camp = $gets['co_camp'];

  $form['co_camp'] = array(
    '#type' => 'select',
    '#options' => array(
      'FIL'=>'FIL',
      'PAF'=>'PAF',
    ),
    '#title' => $this->t('Campagne'),
    '#attributes' => array('placeholder' => t('p.ex.: 2S49')),
    '#default_value' => $co_camp,
    '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-2-24')),
  );
  $form['co_tpla'] = array(
    '#type' => 'textfield',
    '#title' => $this->t('Plan'),
    '#size'          => 15,
    '#attributes' => array('placeholder' => t('p.ex.: 2S49')),
    '#default_value' => $co_tpla,
    '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-4-24')),
  );
  $form['nomu'] = array(
    '#type' => 'textfield',
    '#title' => $this->t('Intelocuteur dispo'),
    '#size'          => 15,
    '#attributes' => array('placeholder' => t('p.ex.: Dupond')),
    '#default_value' => $nomu,
    '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-4-24')),
  );
  $form['co_orie'] = array(
    '#type' => 'textfield',
    '#title' => $this->t('Code Orientation'),
    '#size'          => 15,
    '#attributes' => array('placeholder' => t('p.ex.: 2S49')),
    '#default_value' => $co_orie,
    '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-4-24')),
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
      'co_tpla'       => $form_state->getValue('co_tpla'),
      'co_camp'       => $form_state->getValue('co_camp'),
    );
    $form_state->setRedirect('offres_list',
      array(
        'nomu' => $form_state->getValue('nomu'),
        'co_orie'  => $form_state->getValue('co_orie'),
        'co_tpla'  => $form_state->getValue('co_tpla'),
        'co_camp'  => $form_state->getValue('co_camp'),
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
