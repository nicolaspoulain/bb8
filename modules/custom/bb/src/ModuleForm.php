<?php
// vim:tw=78 foldmarker={,} foldlevel=0 foldmethod=marker nospell :

/**
 * @file
 * Contains \Drupal\bb\ModuleForm.
 */

namespace Drupal\bb;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Component\Utility\UrlHelper;

class ModuleForm extends FormBase {

  /**
   * {@inheritdoc}.
   */
  public function getFormId() {
    return 'module';
  }

  /**
   * Create form to list and edit sessions
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    foreach ($entries = SessionCrudController::load() as $entry) {
      $form['new'][$entry->sess_id]['date'] = array(
        '#type' => 'date',
        '#required' => TRUE,
        '#default_value' => $entry->date,
      );
      $form['new'][$entry->sess_id]['horaires'] = array(
        '#type' => 'textfield',
        '#size' => 10, 
        '#default_value' => $entry->horaires,
      );
      $form['new'][$entry->sess_id]['groupe'] = array(
        '#type' => 'number',
        '#default_value' => $entry->groupe,
        '#attributes' => array(
          'min'  => 1,
          'max'  => 99,
          'step' => 1,
      ),
      );
      $form['new'][$entry->sess_id]['lieu'] = array(
        '#type' => 'textfield',
        '#required' => TRUE,
        '#default_value' => $entry->denom_comp,
        '#autocomplete_route_name' => 'bb.autocomplete.lieu',
      );
      $form['new'][$entry->sess_id]['formateur'] = array(
        '#type' => 'textfield',
        '#required' => TRUE,
        '#default_value' => $entry->nomu,
        '#autocomplete_route_name' => 'bb.autocomplete.formateur',
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
