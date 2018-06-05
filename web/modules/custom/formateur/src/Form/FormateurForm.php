<?php
/**
 * @file
 * Contains Drupal\formateur\Form\ModalForm.
 */

namespace Drupal\formateur\Form;


use Drupal\Core\Url;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\File\Entity\File;
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
    if (!array_key_exists('co_resp',$query)) {
      return False;
    };
    if (is_numeric($query['co_resp']) OR $query['co_resp'] == 'ADD') {
      $co_resp = $query['co_resp'];
    } else {
      return False;
    };

    // Doit correspondre au filtre groupé id_disp
    // sur admin/structure/views/view/bb_stages_formateur/edit/page_1
    switch ($query['id_disp']) {
      case '1':
        $annee = '18';
        break;
      case '2':
        $annee = '17';
        break;
      case '3':
        $annee = '16';
        break;
      case '4':
        $annee = '15';
        break;
      case '5':
        $annee = '14';
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
    $period['dech_dafor'] = '';
    $period['dech_pfa'] = '';
    $period['dech_dane'] = '';
    $period['dech_caffa'] = '';
    $period['resp_dafor'] = '';
    $period['champ_interv'] = '';
    if (!empty($periodic)) {
      foreach ($periodic as $elt) {
        $period[$elt->type] = $elt->val;
      }
    }

    $form['period'] = array(
      '#type' => 'hidden',
      '#value' => $annee,
    );

    $form['nomu'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Nom'),
      '#size'          => 30,
      '#default_value' => (array_key_exists(0,$formateur))? $formateur[0]->nomu : '',
      '#attributes' => array('placeholder' => t('')),
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-1-2')),
    );

    $form['prenom'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Prénom'),
      '#size'          => 30,
      '#default_value' => (array_key_exists(0,$formateur))? $formateur[0]->prenom : '',
      '#attributes' => array('placeholder' => t('')),
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-1-2')),
    );
    $an = (int)$annee;
    $anp = $an+1;
    $form['fieldset'] = array(
      '#type' => 'fieldset',
      '#title' => "20$an - 20$anp",
      '#attributes' => array('class' => array('annuel')),
    );

    $form['fieldset']['resp_dafor'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Resp. DAFOR'),
      '#size'          => 29,
      '#default_value' => $period['resp_dafor'],
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-11-24')),
    );

    $form['fieldset']['markupA'] = array(
      '#markup' => '<div class="pure-u-md-2-24"> </div>',
    );

    $form['fieldset']['dech_dafor'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Dech DAFOR'),
      '#size'          => 6,
      '#default_value' => $period['dech_dafor'],
      '#attributes' => array('placeholder' => t('0')),
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-5-24')),
    );

    $form['fieldset']['dech_pfa'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Déch PFA'),
      '#size'          => 6,
      '#default_value' => $period['dech_pfa'],
      '#attributes' => array('placeholder' => t('0')),
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-5-24')),
    );

    $form['fieldset']['champ_interv'] = array(
      '#type' => 'textarea',
      '#title' => $this->t('Champ d\'intervention'),
      '#rows' =>2,
      '#cols'          => 4,
      '#default_value' => $period['champ_interv'],
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-11-24')),
    );

    $form['fieldset']['markupB'] = array(
      '#markup' => '<div class="pure-u-md-2-24"> </div>',
    );

    $form['fieldset']['dech_dane'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Déch DANE'),
      '#size'          => 6,
      '#default_value' => $period['dech_dane'],
      '#attributes' => array('placeholder' => t('0')),
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-5-24')),
    );

    $form['fieldset']['dech_caffa'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Déch CAFFA'),
      '#size'          => 6,
      '#default_value' => $period['dech_caffa'],
      '#attributes' => array('placeholder' => t('0')),
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-5-24')),
    );

    $file ='';
    if (array_key_exists("pj",$period)) {
      $fid = $period['pj'];
      $file_loaded = BbCrudController::load( 'file_managed', ['fid' => $fid]);
      if ($file_loaded[0]->status) {
        $uri = $file_loaded[0]->uri;
        $url = Url::fromUri(file_create_url($uri));
        $file = \Drupal::l($file_loaded[0]->filename,$url);
      }
    }

    $form['fieldset']['pj'] = array(
      '#title' => t('Lettre de mission : ').$file,
      '#type' => 'managed_file',
      '#upload_validators'  => array(
        'file_validate_extensions' => array('jpg jpeg gif png txt csv rtf doc docx odt xls xlsx ods pdf zip'),
        'file_validate_size' => array(25600000),
      ),
      '#upload_location' => 'private://pieces-jointes/',
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-9-24')),
    );


    $form['mel'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Email'),
      '#size'          => 30,
      '#default_value' => (array_key_exists(0,$formateur))? $formateur[0]->mel : '',
      '#attributes' => array('placeholder' => t('')),
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-1-2')),
    );

    $form['tel'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Téléphone'),
      '#size'          => 30,
      '#default_value' => (array_key_exists(0,$formateur))? $formateur[0]->tel : '',
      '#attributes' => array('placeholder' => t('')),
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-1-2')),
    );

    $form['discipline'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('discipline'),
      '#size'          => 30,
      '#default_value' => (array_key_exists(0,$infoscompl))? $infoscompl[0]->discipline : '',
      '#attributes' => array('placeholder' => t('')),
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-1-2')),
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
      '#default_value' => (array_key_exists(0,$infoscompl))? $infoscompl[0]->grade : '',
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-6-24')),
    );

    $organismes = array(
      '0'  => '',
      '1' => 'ESPE',
      'EXT.' => 'Extérieur',
      );
    $form['statut'] = array(
      '#type' => 'select',
      '#title' => t('Organisme'),
      '#options' => $organismes,
      '#default_value' => (array_key_exists(0,$infoscompl))? $infoscompl[0]->statut : '',
      '#wrapper_attributes' => array('class' => array('pure-u-1','pure-u-md-6-24')),
    );

    $form['divers'] = array(
    '#type' => 'textarea',
      '#title' => $this->t('Divers'),
      '#rows' =>3,
      '#size'          => 25,
      '#default_value' => (array_key_exists(0,$infoscompl))? $infoscompl[0]->divers : '',
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
      '#value'  => $this->t('Enregister'),
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

    $entry_dafor = array(
      'nomu'   => $form_state->getValue('nomu'),
      'prenom' => $form_state->getValue('prenom'),
      'mel'    => $form_state->getValue('mel'),
      'tel'    => $form_state->getValue('tel'),
    );
    $entry_plus = array(
      'discipline' => $form_state->getValue('discipline'),
      'grade'      => $form_state->getValue('grade'),
      'divers'     => $form_state->getValue('divers'),
      'statut'     => $form_state->getValue('statut'),
    );
    if (is_numeric($condition['co_resp'])) {
      BbCrudController::update( 'gbb_gresp_dafor', $entry_dafor , $condition);
      BbCrudController::update( 'gbb_gresp_plus', $entry_plus, $condition);
    } else {
      $id = BbCrudController::create( 'gbb_gresp_dafor', $entry_dafor);
      $condition['co_resp'] = $id;
      BbCrudController::create( 'gbb_gresp_plus', array_merge($condition,$entry_plus));
    }
    $types = ['dech_dafor', 'dech_pfa', 'dech_dane', 'dech_caffa', 'resp_dafor','champ_interv'];
    foreach ($types as $type) {
      $condition = array(
        'co_resp' => $condition['co_resp'],
        'period'  => $form_state->getValue('period'),
        'type'  => $type,
      );
      $entry = array(
        'val' => $form_state->getValue($type),
      );
      $row = BbCrudController::load('gbb_gresp_periodic', $condition);
      if (!empty($row)) {
        $DBWriteStatus = BbCrudController::update('gbb_gresp_periodic', $entry, $condition);
      } else {
        $DBWriteStatus = BbCrudController::create('gbb_gresp_periodic', array_merge($condition,$entry));
      }
    };

    /* Fetch the array of the file stored temporarily in database */
    // $thefile = $form_state->getValue('pj');
    // if (!empty($thefile)) {
    if (!empty($thefile = $form_state->getValue('pj'))) {
      if ( $thefile[0] > 0 ) {
        /* Load the object of the file by its fid */
        $file = File::load( $thefile[0] );
        /* Set the status flag permanent of the file object */
        $file->setPermanent();
        /* Save the file in database */
        $file->save();
        $condition = array(
          'co_resp' => $condition['co_resp'],
          'period'  => $form_state->getValue('period'),
          'type'  => 'pj',
        );
        $entry = array(
          'val' => $thefile[0],
        );
        // dpm($entry);
        $row = BbCrudController::load('gbb_gresp_periodic', $condition);
        if (!empty($row)) {
          $DBWriteStatus = BbCrudController::update('gbb_gresp_periodic', $entry, $condition);
        } else {
          $DBWriteStatus = BbCrudController::create('gbb_gresp_periodic', array_merge($condition,$entry));
        }
      }
    }
    $form_state->setRedirect('view.bb_stages_formateur.page_1',
      array(
        'id_disp' => \Drupal::request()->query->get('id_disp'),
        'co_resp'  => $condition['co_resp'],
      )
    );
    return TRUE;
  }
}
