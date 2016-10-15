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
    return 'fapi_example_modal_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

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
  $form['submit'] = array(
    '#type' => 'submit',
    '#value' => t('Submit'),
  );
  return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    // dpm($form_state->getvalue('afile'));
    /* Fetch the array of the file stored temporarily in database */
    $afile = $form_state->getValue('afile');
    /* Load the object of the file by it's fid */
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
    );
  }
}

