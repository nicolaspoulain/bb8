<?php
/**
 * @file
 * Contains \Drupal\bb\Form\SessionsTableForm.
 */

namespace Drupal\bb\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Component\Utility\UrlHelper;
use Drupal\bb\Controller\SessionCrudController;
use Drupal\Core\Ajax\AjaxResponse;
// use Drupal\Core\Ajax;
use Drupal\Core\Ajax\OpenModalDialogCommand;
use Drupal\Core\Link;

class SessionsTableForm extends FormBase
{
  /**
   * {@inheritdoc}.
   */
  public function getFormId()
  {
    return 'session_form';
  }

  /**
   * Create form to list and edit sessions
   */
  public function buildForm(array $form, FormStateInterface $form_state)
  {
    // get sess_id from URL
    $current_uri = \Drupal::request()->getRequestUri();
    $options = UrlHelper::parse($current_uri);
    // dpm(explode('/',$options['path']));
    $degre = explode('/',$options['path'])[4];
    $comodu = explode('/',$options['path'])[5];

    // Tableselect Form constructor
    $options = array();
    foreach (
      $entries = SessionCrudController::load(
        [
          'co_modu'    => $comodu,
          's.co_degre' => $degre
        ]
      )
      as $entry) {

      $icon = "yyy";
      if ($entry->en_attente) {
        $icon = \Drupal::state()->get('ico_attente');
      } elseif ($entry->session_alert) {
        $icon = \Drupal::state()->get('ico_alert');
      } elseif ($entry->convoc_sent) {
        $icon = \Drupal::state()->get('ico_sent');
      } else {
        $icon = \Drupal::state()->get('ico_notAttente');
      };

      $options[$entry->sess_id] = array
        (
          'edit' => Link::createFromRoute
          (
            $this->t('<ul class="no-dot">
           <li class="pure-menu-item pure-menu-has-children pure-menu-allow-hover">
             <i class="fa fa-gear"></i>
             <ul class="pure-menu-children">
               <li class="pure-menu-item pure-menu-link fa fa-pencil blue"> Modifier</li>
               <li class="pure-menu-item"><a href="'.$comodu.'/'.$entry->sess_id.'/Dup/" class="pure-menu-link fa fa-copy"> Dupliquer</a></li>
               <li class="pure-menu-item"><a href="../../sessiondelete/'.$degre.'/'.$comodu.'/'.$entry->sess_id.'" class="pure-menu-link fa fa-trash red delAlertJs"> Supprimer</a></li>
             </ul>
            </li></ul>
            '),
            'bb.modal_form',
            array( 'sess_id'=>$entry->sess_id ),
            [
              'attributes' =>
              [
                'class' => ['use-ajax no-link'],
                'data-dialog-type' => 'modal',
                'data-dialog-options' => '{"width": "80%"}',
              ]
            ]
          ),
          'date' => Link::createFromRoute
          (
            $this->t('<i class="fa fa-edit"> ' . $entry->date .'</i>'),
            'bb.modal_form',
            array( 'sess_id'=>$entry->sess_id ),
            [
              'attributes' =>
              [
                'class' => ['use-ajax'],
                'data-dialog-type' => 'modal',
                'data-dialog-options' => '{"width": "80%"}',
              ]
            ]
          ),
          'date'          => $entry->date,
          'icon'          => $this->t($icon),
          'horaires'      => $entry->horaires,
          'groupe'        => $entry->groupe,
          'lieu'          => $entry->sigle .' '.$entry->denom_comp,
          'formateur'     => $entry->prenom.' '.$entry->nomu,
          'dap'           => $entry->duree_a_payer,
          'dp'            => $entry->duree_prevue,
          'type_paiement' => $entry->type_paiement,
        );
    }
    $header = array(
      'edit'          => t(''),
      'date'          => t('Date'),
      'icon'          => t(''),
      'horaires'      => t('Horaires'),
      'lieu'          => t('Lieu'),
      'groupe'        => t('Gr'),
      'formateur'     => t('Formateur'),
      'dap'           => t('dap'),
      'dp'            => t('dp'),
      'type_paiement' => t('Type pmt'),
    );

    // voir HOOK_theme bb_theme dans module/custom/bb/bb.module
    // $form['#theme'] = 'session';

    $form['list']['co_modu'] = array(
      '#type'  => 'hidden',
      '#value' => $comodu,
    );
    $form['list']['co_degre'] = array(
      '#type'  => 'hidden',
      '#value' => $degre,
    );
    $form['list']['table'] = array(
      '#type'          => 'tableselect',
      '#header'        => $header,
      '#options'       => $options,
      '#empty'         => t('No entries available.'),
      '#default_value' => array($sess_id => TRUE),
    );
    // $form['list']['edit'] = array(
      // '#type'     => 'submit',
      // '#value'    => $this->t('Edit'),
      // '#submit'   => array(  '::submitEditListForm'),
      // '#validate' => array('::validateEditListForm'),
    // );
    $form['list']['add'] = array(
      '#type'     => 'submit',
      '#value'    => $this->t('Ajouter session'),
      // '#submit'   => array(  '::submitAddListForm'),
      // '#validate' => array(''),
      '#ajax' => array( // here we add Ajax callback where we will process
                'callback' => '::open_modal',  // the data that came from the form and that we will receive as a result in the modal window
                      ),
    );

    // Don't cache this page.
    $content['#cache']['max-age'] = 0;

    return $form;
  }


  public function open_modal(array &$form, FormStateInterface $form_state) {
    $response = new AjaxResponse();
    $title = 'Node ID';
    $content = '<div class="test-popup-content"> Node ID is: ' . $id . '</div>';
    $options = array(
      'dialogClass' => 'popup-dialog-class',
      'width' => '300',
      'height' => '300',
    );
    // $content = \Drupal::formBuilder()->getForm('Drupal\bb\Form\SessionsTableForm');
    $response->addCommand(new OpenModalDialogCommand($title, $content, $options));
    return $response;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) { }
  public function   submitForm(array &$form, FormStateInterface $form_state) { }

  // public function validateEditListForm(array &$form, FormStateInterface $form_state)
  // {
    // if (count(array_filter($form_state->getValue('table'))) != 1) {
      // $form_state->setErrorByName('' ,
        // $this->t('Une et une seule session doit être cochée.'));
    // }
  // }
  // public function submitEditListForm(array &$form, FormStateInterface $form_state)
  // {
    // foreach (array_filter($form_state->getValue('table')) as $i) {
      // if ($i != 0) $id = $i;
    // };
    // $form_state->setRedirect('bb.moduleng',
      // array(
        // 'co_degre' => $form_state->getValue('co_degre'),
        // 'co_modu'  => $form_state->getValue('co_modu')
      // )
    // );
  // }

  /**
   * Ajout d'une nouvelle session
   */
  public function submitAddListForm(array &$form, FormStateInterface $form_state)
  {
    $entry = array(
      'uid'           => 0,
      'co_degre'      => $form_state->getValue('co_degre'),
      'co_modu'       => $form_state->getValue('co_modu'),
      'date_modif'    => date('Y-m-d'),
      'date'          => date('Y-m-d'),
      'horaires'      => '9h-17h',
      'co_lieu'       => 0,
      'co_resp'       => 0,
      'duree_a_payer' => 0,
      'duree_prevue'  => 0,
      'type_paiement' => 'VAC',
      'groupe'        => 1,
    );
    // Insert
    $DBWriteStatus = SessionCrudController::insert($entry);
    $form_state->setRedirect('bb.moduleng',
      array(
        'co_degre' => $form_state->getValue('co_degre'),
        'co_modu'  => $form_state->getValue('co_modu')
      )
    );
  }
  /**
   * {@inheritdoc}
   */
  public function submitSaveModifForm(array &$form, FormStateInterface $form_state)
  {
    $account = \Drupal::currentUser();

    $entry = array(
      'uid'           => $account->id(),
      'date'          => $form_state->getValue('date'),
      'horaires'      => $form_state->getValue('horaires'),
      'co_lieu'       => $form_state->getValue('lieu'),
      'co_resp'       => $form_state->getValue('formateur'),
      'duree_a_payer' => $form_state->getValue('duree_a_payer'),
      'duree_prevue'  => $form_state->getValue('duree_prevue'),
      'type_paiement' => $form_state->getValue('type_paiement'),
      'groupe'        => $form_state->getValue('groupe'),
    );

    if ( $form_state->getValue('sess_id') ==-1) {
      // Insert
      $DBWriteStatus = SessionCrudController::insert($entry);
    } else {
      // Update
      $entry['sess_id']  = $form_state->getValue('sess_id');
      $DBWriteStatus = SessionCrudController::update($entry);
    };
  }

}
