<?php
/**
 * @file
 * Contains Drupal\bb\Form\ModalDeForm.
 */

namespace Drupal\bb\Form;

use Drupal\Core\Url;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\CloseModalDialogCommand;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\bb\Controller\BbCrudController;
use Drupal\File\Entity\File;

/**
 * Implements the ModalDeForm form controller.
 */
class ModalDeForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getTitle($sess_id, $type) {
    if ($type == 'edit') {
      return 'Fichiers associés à la session n°'.$sess_id;
    } else {
      return '!!! ERREUR !!!';
    }
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'fapi_example_modal_de_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state,$co_modu=1,$co_degre=2, $sess_id = 1, $type='edit') {

    // get informations on session
    $entries = BbCrudController::load('gbb_session', [ 'sess_id' => $sess_id ] );
    $lieu = BbCrudController::load('gbb_netab_dafor', [ 'co_lieu' => $entries[0]->co_lieu ] );
    $entries[0]->denom_comp = $lieu[0]->denom_comp;
    $entries[0]->sigle = $lieu[0]->sigle;
    $resp = BbCrudController::load('gbb_gresp_dafor', [ 'co_resp' => $entries[0]->co_resp ] );
    $entries[0]->nomu = $resp[0]->nomu;
    $entries[0]->prenom = $resp[0]->prenom;

    // On applique le theme session
    // voir HOOK_theme bb_theme dans module/custom/bb/bb.module
    $form['#theme'] = 'modal-de';

    // $form['#attributes'] = array('class' => array('pure-form','pure-form-stacked'));

    // sess_id=1 signifie duplication
    if ($type == 'copy') {
      $sess_id = 1;
    }

    $form['sess_id'] = array(
      '#type' => 'hidden',
      // '#type' => 'textfield',
      '#value' => $sess_id,
    );
    $form['co_degre'] = array(
      '#type'    => 'hidden',
      '#value' => $co_degre,
    );
    $form['co_modu'] = array(
      '#type' => 'hidden',
      // '#type' => 'textfield',
      '#default_value' => $entries[0]->co_modu,
    );
    $form['de_info'] = array(
      '#type' => 'textarea',
      '#default_value' => $entries[0]->de_info,
    );
    // Delete file list form
    $files = BbCrudController::load( 'gbb_file', ['co_modu' => $co_modu, 'co_degre' => $co_degre, 'zone' => $sess_id]);
    $flist = [];
    foreach ($files as $f) {
      $file_loaded = BbCrudController::load( 'file_managed', ['fid' => $f->fid]);
      // dpm($file_loaded);
      if ($file_loaded[0]->status) {
        // $flist[$f->fid] = $file_loaded[0]->uri.$file_loaded[0]->filename;
        $uri = $file_loaded[0]->uri;
        $url = Url::fromUri(file_create_url($uri));
        $flist[$f->fid] = \Drupal::l($file_loaded[0]->filename,$url);
      }
    }
    $form['fileToDelete'] = array(
      '#type'    => 'radios',
      '#options' => $flist,
    );
    if (count($files)>0) {
      $form['delete_file'] = array(
        '#type' => 'submit',
        '#value' => t('Delete'),
        '#submit' => array('::deleteForm'),
      );
    }

    // Add file form
    $form['afile'] = array(
      '#title' => t('Ajouter un fichier'),
      '#type' => 'managed_file',
      '#multiple' => 'true',
      '#upload_validators'  => array(
        'file_validate_extensions' => array('jpg jpeg gif png txt csv rtf doc docx odt xls xlsx ods pdf zip'),
        'file_validate_size' => array(25600000),
      ),
      '#upload_location' => 'private://pieces-jointes/',
      '#required' => FALSE,
    );
    // Add file submit button
    $form['submit_file'] = array(
      '#type' => 'submit',
      '#value' => t('Valider'),
    );

    return $form;
  }


  public function submitForm(array &$form, FormStateInterface $form_state) {
    $condition = array(
      'sess_id' => $form_state->getValue('sess_id'),
    );

    $entry = array(
      'de_info'  => $form_state->getValue('de_info'),
    );
    $DBWriteStatus = BbCrudController::update('gbb_session', $entry, $condition);

    /* Fetch the array of the file stored temporarily in database */
    $afile = $form_state->getValue('afile');
    /* Load the object of the file by it's fid */
    // dpm($afile);
    foreach ($afile as $thefile) {
      $file = File::load( $thefile );
      /* Set the status flag permanent of the file object */
      $file->setPermanent();
      /* Save the file in database */
      $file->save();
      $entry = array(
        'co_degre' => $form_state->getValue('co_degre'),
        'co_modu' => $form_state->getValue('co_modu'),
        'fid' => $thefile,
        'zone' => $form_state->getValue('sess_id'),
      );
      // dpm($entry);
      $module = BbCrudController::create( 'gbb_file', $entry);
    }
    $form_state->setRedirect('bb.moduleng',
      array(
        'co_degre' => $form_state->getValue('co_degre'),
        'co_modu'  => $form_state->getValue('co_modu')
      ),
      array( 'fragment' => 'sessions')
    );
  }
  public function deleteForm(array &$form, FormStateInterface $form_state) {

    //  *************************
    // POURQUOI CA MARCHE PAS ????
    //  *************************
    /* Load the object of the file by it's fid */
    // $file = File::load( $afile );
    /* Set the status flag temporary of the file object */
    // $file->setTemporary();
    /* Save the file in database */
    // $file->save();

    $entry = array(
      'fid' => $form_state->getValue('fileToDelete'),
    );
    $module = BbCrudController::delete( 'gbb_file', $entry);
    $form_state->setRedirect('bb.moduleng',
      array(
        'co_degre' => $form_state->getValue('co_degre'),
        'co_modu'  => $form_state->getValue('co_modu')
      ),
      array( 'fragment' => 'sessions')
    );
  }
}

