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
  public function buildForm(array $form, FormStateInterface $form_state, $comment=NULL, $co_omodu=NULL, $annee=NULL) {
    $gets =\Drupal::request()->query->all();
    $nomu = $gets['nomu'];
    $no_offre = $gets['no_offre'];
    $co_orie = $gets['co_orie'];
    $co_tpla = $gets['co_tpla'];
    $co_camp = $gets['co_camp'];
    $co_offreur = $gets['co_offreur'];

  $form['annee'] = array(
    '#type' => 'select',
    '#options' => array(
      '2021'=>'2021-22',
      '2020'=>'2020-21',
      '2019'=>'2019-20',
      '2018'=>'2018-19',
    ),
    '#title' => $this->t('Année'),
    '#default_value' => $annee,
    '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-2-24')),
  );
  $form['co_camp'] = array(
    '#type' => 'select',
    '#options' => array(
      'TOUT'=>'Tout',
      'FIL'=>'FIL',
      'PAF'=>'PAF',
    ),
    '#title' => $this->t('PAF/FIL'),
    '#attributes' => array('placeholder' => t('p.ex.: 2S49')),
    '#default_value' => $co_camp,
    '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-2-24')),
  );
  $form['co_tpla'] = array(
    '#type' => 'textfield',
    '#title' => $this->t('Plan'),
    '#size'          => 15,
    '#attributes' => array('placeholder' => t('p.ex.: S')),
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
  $form['co_omodu'] = array(
    '#type' => 'textfield',
    '#title' => $this->t('Numéro module'),
    '#size'          => 15,
    '#attributes' => array('placeholder' => t('p.ex.: 25006')),
    '#default_value' => $co_omodu,
    '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-4-24')),
  );
  $form['no_offre'] = array(
    '#type' => 'textfield',
    '#title' => $this->t('Numéro offre'),
    '#size'          => 15,
    '#attributes' => array('placeholder' => t('p.ex.: 20200056')),
    '#default_value' => $no_offre,
    '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-4-24')),
  );
  $form['position'] = array(
    '#type' => 'select',
    '#options' => array(
      'tous'=>'tous',
      'autre'=>'pas 500-800',
      '500'=>'500',
      '800'=>'800',
    ),
    '#title' => $this->t('position'),
    '#default_value' => $position,
    '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-2-24')),
  );
  $form['co_orie'] = array(
    '#type' => 'textfield',
    '#title' => $this->t('Code Orientation'),
    '#size'          => 15,
    '#attributes' => array('placeholder' => t('p.ex.: 2S49')),
    '#default_value' => $co_orie,
    '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-4-24')),
  );
  $form['co_offreur'] = array(
    '#type' => 'textfield',
    '#title' => $this->t('Priorité CDC'),
    '#size'          => 15,
    '#attributes' => array('placeholder' => t('p.ex.: 22')),
    '#default_value' => $co_offreur,
    '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-4-24')),
  );
  // $form['co_omodu']  = array('#type' => 'hidden','#value' => $co_omodu );
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
      'co_omodu'       => $form_state->getValue('co_omodu'),
      'position'       => $form_state->getValue('position'),
      'no_offre'       => $form_state->getValue('no_offre'),
      'co_orie'       => $form_state->getValue('co_orie'),
      'co_tpla'       => $form_state->getValue('co_tpla'),
      'co_camp'       => $form_state->getValue('co_camp'),
      'co_offreur'       => $form_state->getValue('co_offreur'),
      'annee'         => $form_state->getValue('annee'),
    );
    $form_state->setRedirect('offres_list',
      array(
        'nomu' => $form_state->getValue('nomu'),
        'co_omodu'  => $form_state->getValue('co_omodu'),
        'position'  => $form_state->getValue('position'),
        'no_offre'  => $form_state->getValue('no_offre'),
        'co_orie'  => $form_state->getValue('co_orie'),
        'co_tpla'  => $form_state->getValue('co_tpla'),
        'co_camp'  => $form_state->getValue('co_camp'),
        'annee'    => $form_state->getValue('annee'),
        'co_offreur'       => $form_state->getValue('co_offreur'),
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
