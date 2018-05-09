<?php
/**
 * @file
 * Contains Drupal\bb\Form\CfileForm.
 */

namespace Drupal\bb\Form;

use Drupal\Core\Ajax\ChangedCommand;
use Drupal\Core\Ajax\InvokeCommand;

use Drupal\Core\Url;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\CssCommand;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\File\Entity\File;
use Drupal\bb\Controller\BbCrudController;
use Drupal\Core\Config\ConfigFactory;

/**
 * Implements the CfileForm form controller.
 */
class CfileForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getTitle() {
    return '<i class="fa fa-lg fa-lock red "></i>&nbsp;<strong>Fichiers entre conseillers</strong><hr/>';
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'CfileForm';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    // Get URL components
    $current_uri = \Drupal::request()->getRequestUri();
    $path_args = array_slice(explode('/',$current_uri),-2,2);
    $co_degre = $path_args[0];
    $co_modu  = explode('?',$path_args[1])[0];

    $form['titre'] = array(
      '#markup' => CfileForm::getTitle(),
    );

    // Delete file list form
    $files = BbCrudController::load( 'gbb_file', ['co_modu' => $co_modu, 'co_degre' => $co_degre, 'zone' => 2]);
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
    // $form['delete_file']['#submit'][] = 'delete_form';

    // Add file form

    // ---------- a supprimer après la transition BB -> BB8 ------------------
    // verifie si l'id_disp est bien >18
    $res = BbCrudController::load( 'gbb_gmodu', ['co_modu' => $co_modu, 'co_degre' => $co_degre]);
    $res = BbCrudController::load( 'gbb_gdisp', ['co_disp' => $res['0']->co_disp, 'co_degre' => $co_degre]);
    if ( substr($res['0']->id_disp,0,2) >= 18 ) {
    // -----------------------------------------------------------------------

    $form['afile'] = array(
      '#title' => t('Ajouter un fichier'),
      '#type' => 'managed_file',
      '#upload_validators'  => array(
        'file_validate_extensions' => array('jpg jpeg gif png txt rtf doc docx odt xls xlsx ods pdf zip'),
        'file_validate_size' => array(25600000),
      ),
      '#upload_location' => 'private://pieces-jointes/',
      '#required' => FALSE,
    );
    // Add file submit button
    $form['submit_file'] = array(
      '#type' => 'submit',
      '#value' => t('Joindre'),
    );
    } else {
      $form['disclaimer'] = array(
        '#markup' => "pas de dépôt de fichier avant 18-19",
      );
    }

    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    /* Fetch the array of the file stored temporarily in database */
    $afile = $form_state->getValue('afile');
    /* Load the object of the file by it's fid */
    // dpm($afile[0]);
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
      'zone' => 2,
    );
    // dpm($entry);
    $module = BbCrudController::create( 'gbb_file', $entry);
  }
  public function deleteForm(array &$form, FormStateInterface $form_state) {
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
    // dpm($afile);
    $module = BbCrudController::delete( 'gbb_file', $entry);
  }
}

