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

    $form['mel'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Email'),
      '#size'          => 15,
      '#default_value' => $formateur[0]->mel,
      '#attributes' => array('placeholder' => t('p.ex.: 9h-17h')),
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-10-24')),
    );

    $form['tel'] = array(
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

    $grades = array(
        '', 'NOMENCLATURE', 'VACATAIRE', 'CONTRACTUEL', 'MA',
        'PEGC', 'PLP', 'CERTIFIE', 'AGREGE', 'INST', 'PE', 'COP',
        'CPE', 'INF', 'MED', 'ING', 'ASU', 'CASU', 'AS', 'PERDIR',
        'IA-IPR', 'IEN-EG', 'IEN-ET', 'IEN-CC', 'CC', 'PREC',
        'PRCE', 'PRAG', 'MC', 'PR', 'ASSOCIATION', 'ENTREPRISE',
        'UNIVERSITE', 'INTERVENANT-XT',
      );

    $form['grade'] = array(
      '#type' => 'select',
      '#title' => $this->t('Grade'),
      '#options' => array_combine($grades, $grades),
      '#default_value' => $infoscompl[0]->grade,
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
    '#type' => 'textarea',
      '#title' => $this->t('Divers'),
      '#rows' =>4,
      '#size'          => 15,
      '#default_value' => $infoscompl[0]->divers,
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-10-24')),
    );

    $form['statut'] = array(
      '#type' => 'checkbox',
      '#title' => t('IUFM'),
      '#default_value' => $infoscompl[0]->statut,
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

    $query = \Drupal::request()->query->all();

    // get co_resp form query string
    $condition = array(
      'co_resp' => \Drupal::request()->query->get('co_resp'),
    );

    $entry = array(
      'nomu'  => $form_state->getValue('nomu'),
      'prenom'  => $form_state->getValue('prenom'),
      'mel'  => $form_state->getValue('mel'),
      'tel'  => $form_state->getValue('tel'),
    );
    BbCrudController::update( 'gbb_gresp_dafor', $entry, $condition);

    $entry = array(
      'discipline'  => $form_state->getValue('discipline'),
      'grade'  => $form_state->getValue('grade'),
      'decharge'  => $form_state->getValue('decharge'),
      'resp_dafor'  => $form_state->getValue('resp_dafor'),
      'divers'  => $form_state->getValue('divers'),
      'statut'  => $form_state->getValue('statut'),
    );
    BbCrudController::update( 'gbb_gresp_plus', $entry, $condition);
    // drupal_set_message('Submitted.'.$path_args[0].'-'.$path_args[1]);
    // dpm($condition);
    // dpm($entry);
    return TRUE;
  }
}
