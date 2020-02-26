<?php
/**
 * @file
 * Contains Drupal\plan\Form\PrioNatForm.
 */

namespace Drupal\plan\Form;

use Drupal\Core\Ajax\ChangedCommand;
use Drupal\Core\Ajax\InvokeCommand;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\CssCommand;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\bb\Controller\BbCrudController;


/**
 * Implements the PrioNatForm form controller.
 */
class PrioNatForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getTitle() {
    return 'Modification de la prio_nat';
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'PrioNatForm';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, $prio_nat=NULL, $co_modu=NULL, $co_degre=NULL) {

  $prios = array(
0=> "-",
1=> "Bac-3/Bac+3",
2=>"Climscol_lutte_harcèlement",
3=>"Devoirs_faits",
4=>"École_maternelle",
5=>"Éduc_artistique_et_cult",
6=>"Éduc_valeurs_de_la_Rép",
7=>"Élèves_à_besoins_éduc_part",
8=>"Les_fondamentaux_(1D)",
9=>"Les_fondamentaux_cycle_3",
10=>"Orientation_au_collège",
11=>"Professionnalisation_formateurs",
12=>"Réforme_du_LGT",
13=>"Scol_obligatoire_à_partir_de_3_ans",
14=>"Sécurisation_des_parcours",
15=>"Transfo_voie_professionnelle",);

  $form['co_modu']  = array('#type' => 'hidden','#value' => $co_modu );
  $form['co_degre']  = array('#type' => 'hidden','#value' => $co_degre );
  $form['prio_nat'] = array(
    '#type' => 'select',
    '#options' => $prios,
    '#default_value' => (isset($prio_nat))? (int)$prio_nat : '0',
    '#ajax' => array(
      'callback' => [$this,'saveAjax'],
      'progress' => array('type' => 'throbber', 'message' => '')),);
  return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $valid = $this->validate($form, $form_state);
    return TRUE;
  }

  /**
   * Validate field.
   */
  protected function validate(array &$form, FormStateInterface $form_state) {
    return TRUE;
  }

  /**
   * Ajax callback to save field.
   */
  public function saveAjax(array &$form, FormStateInterface $form_state) {

    $coo = $form_state->getUserInput('co_modu');
    $condition = array(
      'co_modu'  => $coo['co_modu'],
      'co_degre'  => $coo['co_degre'],
    );
    $entry = array(
      'prio_nat'  => $form_state->getValue('prio_nat'),
    );
    $row = BbCrudController::load('gbb_gmodu_plus', $condition);
    if (!empty($row)) {
      $DBWriteStatus = BbCrudController::update('gbb_gmodu_plus', $entry, $condition);
    } else {
      $DBWriteStatus = BbCrudController::create('gbb_gmodu_plus', array_merge($condition,$entry));
    }
  }
}
