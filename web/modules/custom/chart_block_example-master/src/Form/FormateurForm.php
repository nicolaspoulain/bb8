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
    $query = \Drupal::request()->query->all();
    $co_resp = $query['co_resp'];

    // Doit correspondre au filtre groupé id_disp
    // sur admin/structure/views/view/bb_stages_formateur/edit/page_1
    switch ($query['id_disp']) {
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
    $entry['period'] = $annee;
    $periodic = BbCrudController::load( 'gbb_gresp_periodic', $entry);
    foreach ($periodic as $elt) {
      $period[$elt->type] = $elt->val;
    }
    // dpm($period['dech_dafor']);
    // dpm($period['dech_pfa']);
    // dpm($period['dech_dane']);
    // dpm($period['dech_caffa']);
    // dpm($period['resp_dafor']);

    $form['period'] = array(
      '#type' => 'hidden',
      '#value' => $annee,
    );

    $form['nomu'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Nom'),
      '#size'          => 30,
      '#default_value' => $formateur[0]->nomu,
      '#attributes' => array('placeholder' => t('p.ex.: 9h-17h')),
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-7-24')),
    );

    $form['prenom'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Prénom'),
      '#size'          => 30,
      '#default_value' => $formateur[0]->prenom,
      '#attributes' => array('placeholder' => t('p.ex.: 9h-17h')),
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-7-24')),
    );

    $form['discipline'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('discipline'),
      '#size'          => 30,
      '#default_value' => $infoscompl[0]->discipline,
      '#attributes' => array('placeholder' => t('p.ex.: 9h-17h')),
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-7-24')),
    );

    $form['mel'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Email'),
      '#size'          => 30,
      '#default_value' => $formateur[0]->mel,
      '#attributes' => array('placeholder' => t('p.ex.: 9h-17h')),
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-7-24')),
    );

    $form['tel'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Téléphone'),
      '#size'          => 30,
      '#default_value' => $formateur[0]->tel,
      '#attributes' => array('placeholder' => t('p.ex.: 9h-17h')),
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-7-24')),
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
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-5-24')),
    );

    $form['statut'] = array(
      '#type' => 'checkbox',
      '#title' => t('IUFM'),
      '#default_value' => $infoscompl[0]->statut,
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-2-24')),
    );

    $form['fieldset'] = array(
      '#type' => 'fieldset',
      '#title' => t(''),
      '#attributes' => array('class' => array('annuel')),
    );

    $an = (int)$annee;
    $anp = $an+1;
    $form['fieldset']['markup'] = array(
      '#markup' => "20$an - 20$anp",
      '#prefix' => '<div class="pure-u-1 pure-u-md-4-24">',
      '#suffix' => '</div>',
    );

    $form['fieldset']['dech_dafor'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Dech DAFOR'),
      '#size'          => 6,
      '#default_value' => $period['dech_dafor'],
      '#attributes' => array('placeholder' => t('0')),
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-4-24')),
    );

    $form['fieldset']['dech_pfa'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Déch PFA'),
      '#size'          => 6,
      '#default_value' => $period['dech_pfa'],
      '#attributes' => array('placeholder' => t('0')),
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-4-24')),
    );

    $form['fieldset']['dech_dane'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Déch DANE'),
      '#size'          => 6,
      '#default_value' => $period['dech_dane'],
      '#attributes' => array('placeholder' => t('0')),
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-4-24')),
    );

    $form['fieldset']['dech_caffa'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Déch CAFFA'),
      '#size'          => 6,
      '#default_value' => $period['dech_caffa'],
      '#attributes' => array('placeholder' => t('0')),
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-4-24')),
    );

    $form['fieldset']['resp_dafor'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Resp. DAFOR'),
      '#size'          => 6,
      '#default_value' => $period['resp_dafor'],
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-4-24')),
    );


    $form['divers'] = array(
    '#type' => 'textarea',
      '#title' => $this->t('Divers'),
      '#rows' =>3,
      '#size'          => 25,
      '#default_value' => $infoscompl[0]->divers,
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-24-24')),
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

    // get co_resp form query string
    // $query = \Drupal::request()->query->all();
    $condition = array(
      'co_resp' => \Drupal::request()->query->get('co_resp'),
    );

    $entry = array(
      'nomu'   => $form_state->getValue('nomu'),
      'prenom' => $form_state->getValue('prenom'),
      'mel'    => $form_state->getValue('mel'),
      'tel'    => $form_state->getValue('tel'),
    );
    BbCrudController::update( 'gbb_gresp_dafor', $entry, $condition);

    $entry = array(
      'discipline' => $form_state->getValue('discipline'),
      'grade'      => $form_state->getValue('grade'),
      'divers'     => $form_state->getValue('divers'),
      'statut'     => $form_state->getValue('statut'),
    );
    BbCrudController::update( 'gbb_gresp_plus', $entry, $condition);

    $types = ['dech_dafor', 'dech_pfa', 'dech_dane', 'dech_caffa', 'resp_dafor'];
    foreach ($types as $type) {
      $condition = array(
        'co_resp' => \Drupal::request()->query->get('co_resp'),
        'period'  => $form_state->getValue('period'),
        'type'  => $type,
      );
      dpm($condition);
      // BbCrudController::update( 'gbb_gresp_plus', $entry, $condition);
    }


    return TRUE;
  }
}
