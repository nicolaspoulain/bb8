<?php
/**
 * @file
 * Contains Drupal\chart_block_example\Form\ModalForm.
 */

namespace Drupal\chart_block_example\Form;


use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\CloseModalDialogCommand;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\bb\Controller\BbCrudController;

/**
 * Implements the ModalForm form controller.
 */
class FormateurForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getTitle() {
    return 'Modification de la fiche formateur';
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
  public function buildForm(array $form, FormStateInterface $form_state) {
    $current_uri = \Drupal::request()->getRequestUri();
    $path_args = array_slice(explode('/',$current_uri),-2,2);
    $co_resp = explode('=',explode('?',$path_args[1])[1])[3];
    $annee = explode('&',(explode('=',explode('?',$path_args[1])[1])[1]))[0];
    // Doit correspondre au filtre groupé id_disp
    // sur admin/structure/views/view/bb_stages_formateur/edit/page_1
    switch ($annee) {
      case '1':
        $annee = '20';
        break;
      case '2':
        $annee = '19';
        break;
      case '3':
        $annee = '18';
        break;
      case '4':
        $annee = '17';
        break;
      case '5':
        $annee = '16';
        break;
      case '6':
        $annee = '15';
        break;
      case '7':
        $annee = '14';
        break;
      case '8':
        $annee = '13';
        break;
      default:
        $annee = '17';
        break;
    }

    $entry = array(
      'co_resp'  => $co_resp,
    );
    // dpm($entry);

    $infoscompl = BbCrudController::load( 'gbb_gresp_plus', $entry);
    $formateur = BbCrudController::load( 'gbb_gresp_dafor', $entry);

    $form['nomu'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Nom'),
      '#size'          => 15,
      '#default_value' => $formateur[0]->nomu,
      '#attributes' => array('placeholder' => t('p.ex.: 9h-17h')),
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-10-24')),
    );

    $form['prenom'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Prénom'),
      '#size'          => 15,
      '#default_value' => $formateur[0]->prenom,
      '#attributes' => array('placeholder' => t('p.ex.: 9h-17h')),
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-10-24')),
    );

    $form['email'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Email'),
      '#size'          => 15,
      '#default_value' => $formateur[0]->mel,
      '#attributes' => array('placeholder' => t('p.ex.: 9h-17h')),
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-10-24')),
    );

    $form['telephone'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Téléphone'),
      '#size'          => 15,
      '#default_value' => $formateur[0]->tel,
      '#attributes' => array('placeholder' => t('p.ex.: 9h-17h')),
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-10-24')),
    );

    $form['discipline'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('discipline'),
      '#size'          => 15,
      '#default_value' => $infoscompl[0]->discipline,
      '#attributes' => array('placeholder' => t('p.ex.: 9h-17h')),
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-10-24')),
    );

    $form['grade'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Grade'),
      '#size'          => 15,
      '#default_value' => $infoscompl[0]->grade,
      '#attributes' => array('placeholder' => t('p.ex.: 9h-17h')),
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-10-24')),
    );

    $form['decharge'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Décharge'),
      '#size'          => 15,
      '#default_value' => $infoscompl[0]->decharge,
      '#attributes' => array('placeholder' => t('p.ex.: 9h-17h')),
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-10-24')),
    );

    $form['resp_dafor'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Responsable DAFOR'),
      '#size'          => 15,
      '#default_value' => $infoscompl[0]->resp_dafor,
      '#attributes' => array('placeholder' => t('p.ex.: 9h-17h')),
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-10-24')),
    );

    $form['divers'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Divers'),
      '#size'          => 15,
      '#default_value' => $infoscompl[0]->divers,
      '#attributes' => array('placeholder' => t('p.ex.: 9h-17h')),
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-10-24')),
    );

    $form['statut'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Statut'),
      '#size'          => 15,
      '#default_value' => $infoscompl[0]->statut,
      '#attributes' => array('placeholder' => t('p.ex.: 9h-17h')),
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-10-24')),
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
    // $valid = $this->validateJournal($form, $form_state);

    $current_uri = \Drupal::request()->getRequestUri();
    $path_args = array_slice(explode('/',$current_uri),-2,2);

    $condition = array(
      'co_degre' => $path_args[0],
      'co_modu'  => $path_args[1],
    );

    $entry = array(
      'convoc_info_off'  => $form_state->getValue('infospasconvocform')['value'],
    );
    $module = BbCrudController::update( 'gbb_gmodu_plus', $entry, $condition);
    // drupal_set_message('Submitted.'.$path_args[0].'-'.$path_args[1]);
    // dpm($condition);
    // dpm($entry);
    return TRUE;
  }
}
