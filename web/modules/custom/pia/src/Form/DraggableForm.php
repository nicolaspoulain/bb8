<?php
/**
 * @file
 * Contains Drupal\pia\Form\DraggableForm
 */

namespace Drupal\pia\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\bb\Controller\BbCrudController;

/**
 * Table drag example simple form.
 *
 * @ingroup tabledrag_example
 */
class DraggableForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'draggable_form';
  }

  /**
   * Builds the simple tabledrag form.
   *
   * @param array $form
   *   Render array representing from.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   Current form state.
   *
   * @return array
   *   The render array defining the elements of the form.
   */
  public function buildForm(array $form, FormStateInterface $form_state, $co_orie="2S30 ou WEB", $tid="123456") {
    $form['table-row'] = [
      '#type' => 'table',
      '#header' => [
        $this
          ->t('Name'),
        $this
          ->t('Weight'),
      ],
      '#empty' => $this
        ->t('Sorry, There are no items!'),
      // TableDrag: Each array value is a list of callback arguments for
      // drupal_add_tabledrag(). The #id of the table is automatically
      // prepended; if there is none, an HTML ID is auto-generated.
      '#tabledrag' => [
        [
          'action' => 'order',
          'relationship' => 'sibling',
          'group' => 'table-sort-weight',
        ],
      ],
    ];

    // Build the table rows and columns.
    //
    // The first nested level in the render array forms the table row, on which
    // you likely want to set #attributes and #weight.
    // Each child element on the second level represents a table column cell in
    // the respective table row, which are render elements on their own. For
    // single output elements, use the table cell itself for the render element.
    // If a cell should contain multiple elements, simply use nested sub-keys to
    // build the render element structure for drupal_render() as you would
    // everywhere else.
    //
    // About the condition id<8:
    // For the purpose of this 'simple table' we are only using the first 8 rows
    // of the database.  The others are for 'nested' example.

    // switch database (cf settings.php)
    \Drupal\Core\Database\Database::setActiveConnection('external');
    // Build query

    // dpm($co_orie);

    $query = db_select('gbb_gmodu_taxonomy', 't');
    $query->leftjoin('gbb_gmodu','m', 't.co_modu=m.co_modu AND t.co_degre=m.co_degre');
    $query->leftjoin('gbb_gdisp','d', 'm.co_disp=d.co_disp AND m.co_degre=d.co_degre');
    $query->condition('t.tid', $tid);
    $query->condition('m.co_anmo', '04', 'not like');
    $query->condition('d.co_camp', 'BS', 'not like');
    $query->condition('t.type',"w");
    if ($co_orie == "WEB") {
    $query->condition('t.weight', 100, '<');
    } elseif ($co_orie == "WEB2") {
    $query->condition('t.weight', 99, '>');
    } else {
    $query->condition('t.co_orie', $co_orie, 'like');
    }


    $query->fields('t')
      ->fields('m')
      ->fields('d');
    $query->addField('m', 'lib', 'libm');
    $query->orderBy('weight');
    $results = $query->execute()->fetchAll();
    // dpm($results);
    foreach ($results as $row) {

      // TableDrag: Mark the table row as draggable.
      $form['table-row'][$row->id]['#attributes']['class'][] = 'draggable';

      // TableDrag: Sort the table row according to its existing/configured
      // weight.
      $form['table-row'][$row->id]['#weight'] = $row->weight;

      // Some table columns containing raw markup.
      $pub_des = ($row->co_tcan == 3)? "Ⓓ " : "";
      $str = $row->co_modu." ".$row->libm." ".$pub_des;
      $form['table-row'][$row->id]['text'] = [
        '#markup' => $str,
      ];
      // TableDrag: Weight column element.
      $form['table-row'][$row->id]['weight'] = [
        '#type' => 'weight',
        '#delta' => 150,
        '#title' => $this
          ->t('Weight for @title', [
          '@title' => $row->co_modu,
        ]),
        '#title_display' => 'invisible',
        '#default_value' => $row->weight,
        // Classify the weight element for #tabledrag.
        '#attributes' => [
          'class' => [
            'table-sort-weight',
          ],
        ],
      ];
    }
    $form['actions'] = [
      '#type' => 'actions',
    ];
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this ->t('Enregistrer les changements'),
    ];
    $form['actions']['cancel'] = [
      '#type' => 'submit',
      '#value' => 'Annuler',
      '#attributes' => [
        'title' => $this
          ->t('Return to TableDrag Overview'),
      ],
      '#submit' => [
        '::cancel',
      ],
      '#limit_validation_errors' => [],
    ];
    return $form;
  }

  /**
   * Form submission handler for the 'Return to' action.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   */
  public function cancel(array &$form, FormStateInterface $form_state) {
    $form_state
      ->setRedirect('tabledrag_example.description');
  }

  /**
   * Form submission handler for the simple form.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    // Because the form elements were keyed with the item ids from the database,
    // we can simply iterate through the submitted values.
    $submission = $form_state
      ->getValue('table-row');
    foreach ($submission as $id => $item) {
      $condition = array( 'id' => $id);
      $entry = array( 'weight'  => $item['weight'],);
      $DBWriteStatus = BbCrudController::update('gbb_gmodu_taxonomy', $entry, $condition);
    }
  }

}
