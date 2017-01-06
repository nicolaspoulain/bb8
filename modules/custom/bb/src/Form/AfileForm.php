<?php
/**
 * @file
 * Contains Drupal\bb\Form\AfileForm.
 */

namespace Drupal\bb\Form;

use Drupal\Core\Ajax\ChangedCommand;
use Drupal\Core\Ajax\InvokeCommand;


use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\CssCommand;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\File\Entity\File;
use Drupal\bb\Controller\BbCrudController;
use Drupal\Core\Config\ConfigFactory;

/**
 * Implements the AfileForm form controller.
 */
class AfileForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getTitle() {
    return 'Fichiers pour les administratifs';
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'AfileForm';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    // switch database (cf settings.php)
    \Drupal\Core\Database\Database::setActiveConnection('external');
    // Ajouter un fichier
    $form['afile'] = array(
      '#title' => t('Fichiers pour les administratifs'),
      '#type' => 'managed_file',
      '#upload_validators'  => array(
        'file_validate_extensions' => array('gif png jpg jpeg'),
        'file_validate_size' => array(25600000),
      ),
      // '#upload_location' => 'public://images/',
      '#upload_location' => 'private://images/',
      '#required' => FALSE,
      // '#element_validate' => array( array($this, 'saveAfile'), ), // callback
    );
    $form['submit_file'] = array(
      '#type' => 'submit',
      '#value' => t('Submit'),
    );

    $current_uri = \Drupal::request()->getRequestUri();
    $path_args = array_slice(explode('/',$current_uri),-2,2);
    $co_degre = $path_args[0];
    $co_modu  = explode('?',$path_args[1])[0];

    // Supprimer un fichier
    $files = BbCrudController::load( 'gbb_file', ['co_modu' => $co_modu, 'co_degre' => $co_degre, 'zone' => 1]);
    foreach ($files as $f) {
      $file_loaded = BbCrudController::load( 'file_managed', ['fid' => $f->fid]);
      // dpm($file_loaded);
      $flist[$f->fid] = $file_loaded[0]->filename;
    }
    $form['fileToDelete'] = array(
      '#type'    => 'radios',
      '#options' => $flist,
    );
    $form['delete_file'] = array(
      '#type' => 'submit',
      '#value' => t('Delete'),
      '#submit' => array('::deleteForm'),
    );
    // $form['delete_file']['#submit'][] = 'delete_form';
    \Drupal\Core\Database\Database::setActiveConnection();
    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    // switch database (cf settings.php)
    \Drupal\Core\Database\Database::setActiveConnection('external');
    /* Fetch the array of the file stored temporarily in database */
    $afile = $form_state->getValue('afile');
    /* Load the object of the file by it's fid */
    dpm($afile[0]);
    $file = File::load( $afile[0] );
    /* Set the status flag permanent of the file object */
    $file->setPermanent();
    /* Save the file in database */
    $file->save();
    $current_uri = \Drupal::request()->getRequestUri();
    $path_args = array_slice(explode('/',$current_uri),-2,2);
    $entry = array(
      'co_degre' => $path_args[0],
      'co_modu'  => explode('?',$path_args[1])[0],
      'fid' => $afile[0],
      'zone' => 1,
    );
    // dpm($entry);
    $module = BbCrudController::create( 'gbb_file', $entry);
    \Drupal\Core\Database\Database::setActiveConnection();
  }
  public function deleteForm(array &$form, FormStateInterface $form_state) {
    // switch database (cf settings.php)
    \Drupal\Core\Database\Database::setActiveConnection('external');
    /* Fetch the array of the file stored temporarily in database */
    $afile = $form_state->getValue('fileToDelete');

    //  *************************
    // POURQUOI CA MARCHE PAS ????
    //  *************************
    /* Load the object of the file by it's fid */
    // $file = File::load( $afile );
    /* Set the status flag temporary of the file object */
    // $file->setTemporary();
    /* Save the file in database */
    // $file->save();
    $current_uri = \Drupal::request()->getRequestUri();
    $path_args = array_slice(explode('/',$current_uri),-2,2);
    $entry = array(
      'fid' => $afile,
    );
    dpm($afile);
    $module = BbCrudController::delete( 'gbb_file', $entry);
    \Drupal\Core\Database\Database::setActiveConnection();
  }
}

