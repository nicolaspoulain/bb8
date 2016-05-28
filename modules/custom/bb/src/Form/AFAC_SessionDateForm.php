<?php
// vim:tw=78 foldmarker={,} foldlevel=0 foldmethod=marker nospell :

/**
 * @file
 * Contains \Drupal\bb\Form\SessionsDateForm.
 */

namespace Drupal\bb\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class SessionDateForm extends FormBase {

  /**
   * {@inheritdoc}.
   */
  public function getFormId() {
    return 'session_date_form';
  }

  /**
   * Create form
   */
  public function buildForm(array $form, FormStateInterface $form_state,
    $sess_id=1, $def_val=NULL) {

    // On applique le theme session
    // voir HOOK_theme bb_theme dans module/custom/bb/bb.module
    $form['#theme'] = 'session';

    $form['new'][$sess_id]['date'] = array(
      '#type' => 'date',
      '#required' => TRUE,
      '#default_value' => $def_val,
    );
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
