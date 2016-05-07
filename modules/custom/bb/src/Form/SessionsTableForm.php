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
use Drupal\Core\Link;

class SessionsTableForm extends FormBase {

  /**
   * {@inheritdoc}.
   */
  public function getFormId() {
    return 'session_form';
  }

  /**
   * Create form to list and edit sessions
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    // get sess_id from URL
    $current_uri = \Drupal::request()->getRequestUri();
    $options = UrlHelper::parse($current_uri);
    $sess_id = $options['query']['query']['sess_id'];
    if ($options['query']['query']['action'] == 'add') $sess_id = -1;
    // dpm(explode('/',$options['path']));

    // Tableselect Form constructor
    $options = array();
    foreach ($entries = SessionCrudController::load() as $entry) {
      $options[$entry->sess_id] = array(
        'date'          => $entry->date,
        'horaires'      => $entry->horaires,
        'groupe'        => $entry->groupe,
        'lieu'          => $entry->sigle .' '.$entry->denom_comp,
        'formateur'     => $entry->prenom.' '.$entry->nomu,
        'dap'           => $entry->duree_a_payer,
        'dp'            => $entry->duree_prevue,
        'type_paiement' => $entry->type_paiement,
        'edit'          => Link::createFromRoute(
          $this->t('Edt'),
          'bb.modal_form',
           array('sess_id'=>$entry->sess_id),
          [
            'attributes' => [
              'class' => ['use-ajax'],
              'data-dialog-type' => 'modal',
            ]
          ]
        ),
      );
    }
    $param = "dd";
    // $param = $route_match->getRawParameters('co_modu');
    $header = array(
      'date'          => t('Date'),
      'horaires'      => t('Horaires'),
      'lieu'          => t('Lieu'),
      'groupe'        => t('Gr'),
      'formateur'     => t('Formateur'),
      'dap'           => t('dap'),
      'dp'            => t('dp'),
      'type_paiement' => t('Type pmt'),
      'edit' => t('Edt'),
    );

    // On applique le theme session
    // voir HOOK_theme bb_theme dans module/custom/bb/bb.module
    $form['#theme'] = 'session';

    $form['list']['table'] = array(
      '#type'          => 'tableselect',
      '#header'        => $header,
      '#options'       => $options,
      '#empty'         => t('No entries available.'),
      '#default_value' => array($sess_id => TRUE),

    );
    $form['list']['edit'] = array(
      '#type'     => 'submit',
      '#value'    => $this->t('Edit'),
      '#submit'   => array(  '::submitEditListForm'),
      '#validate' => array('::validateEditListForm'),
    );
    $form['list']['add'] = array(
      '#type'     => 'submit',
      '#value'    => $this->t('Add'),
      '#submit'   => array(  '::submitAddListForm'),
      '#validate' => array(''),
    );

    // Field edit Form constructor if sess_id provided
    if (is_numeric($sess_id)) {

      // load values for current sess_id
      $entries = SessionCrudController::load(array('sess_id' => $sess_id));

      $form['modif']['sess_id'] = array(
        '#type' => 'hidden',
        '#value' => $sess_id,
      );
      $form['modif']['date'] = array(
        '#type' => 'date',
        '#title' => t('Date'),
        '#required' => TRUE,
        '#default_value' => $entries[0]->date,
      );
      $form['modif']['horaires'] = array(
        '#type' => 'textfield',
        '#title' => $this->t('Horaires'),
        '#default_value' => $entries[0]->horaires,
      );
      $form['modif']['lieu'] = array(
        '#type' => 'search',
        '#title' => $this->t('Lieu'),
        '#required' => TRUE,
        '#default_value' => $entries[0]->lieu,
        '#autocomplete_route_name' => 'bb.autocomplete.lieu',
      );
      $form['modif']['formateur'] = array(
        '#type' => 'textfield',
        '#title' => $this->t('Formateur'),
        '#required' => TRUE,
        '#default_value' => $entries[0]->formateur,
        '#autocomplete_route_name' => 'bb.autocomplete.formateur',
      );
      $form['modif']['duree_a_payer'] = array(
        '#type' => 'textfield',
        '#title' => $this->t('Duree_a_payer'),
        '#size' => 10, 
        '#default_value' => $entries[0]->duree_a_payer,
      );
      $form['modif']['duree_prevue'] = array(
        '#type' => 'textfield',
        '#title' => $this->t('duree_prevue'),
        '#size' => 10, 
        '#default_value' => $entries[0]->duree_prevue,
      );
      $form['modif']['type_paiement'] = array(
        '#type' => 'textfield',
        '#title' => $this->t('Type pmt'),
        '#default_value' => $entries[0]->type_paiement,
      );
      $form['modif']['groupe'] = array(
        '#type' => 'number',
        '#title' => $this->t('Groupe'),
        '#default_value' => $entries[0]->groupe,
        '#attributes' => array(
          'min'  => 1,
          'max'  => 99,
          'step' => 1,
        ),
      );
      $form['modif']['save'] = array(
        '#type'     => 'submit',
        '#value'    => $this->t('Save'),
        '#submit'   => array('::submitSaveModifForm'),
        '#validate' => array(),
      );
    }

    // Don't cache this page.
    $content['#cache']['max-age'] = 0;

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
  }
  public function submitForm(array &$form, FormStateInterface $form_state) {
  }

  /**
   * Verification du formulaire tableselect 
   */
  public function validateEditListForm(array &$form, FormStateInterface $form_state) {
    if (count(array_filter($form_state->getValue('table'))) != 1) {
      $form_state->setErrorByName('' ,
        $this->t('Une et une seule session doit être cochée.'));
    }
  }
  /**
   * {@inheritdoc}
   */
  public function submitEditListForm(array &$form, FormStateInterface $form_state) {
    foreach (array_filter($form_state->getValue('table')) as $i) { if ($i != 0) $id = $i; };
    $form_state->setRedirect('bb.sessionstableform',
      array(
        'query' => array(
          'sess_id' => $id,
          'action' => $form_state->getValue('add'),
        ),
      )
    );
  }
  /**
   * {@inheritdoc}
   */
  public function submitAddListForm(array &$form, FormStateInterface $form_state) {
    $form_state->setRedirect('bb.sessionstableform',
      array(
        'query' => array(
          'action' => 'add',
        ),
      )
    );
  }
  /**
   * {@inheritdoc}
   */
  public function submitSaveModifForm(array &$form, FormStateInterface $form_state) {

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
