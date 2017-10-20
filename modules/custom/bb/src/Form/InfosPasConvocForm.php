<?php
/**
 * @file
 * Contains Drupal\bb\Form\InfosPasConvocForm.
 */

namespace Drupal\bb\Form;

use Drupal\Core\Ajax\ChangedCommand;
use Drupal\Core\Ajax\InvokeCommand;


use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\CssCommand;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\bb\Controller\BbCrudController;


/**
 * Implements the ModalForm form controller.
 */
class InfosPasConvocForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getTitle() {
    return 'Modification du journal';
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'InfosPasConvocForm';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $current_uri = \Drupal::request()->getRequestUri();
    $path_args = array_slice(explode('/',$current_uri),-2,2);
    $co_degre = $path_args[0];
    $co_modu  = $path_args[1];
    $mid = 10*$co_modu + $co_degre;

    $module = \Drupal\gaia\Entity\Gmodu::load($mid);

    $form['convoc_info_off'] = array(
      // '#type' => 'textarea', // WYSIWYG != textarea
      '#type'=>'text_format',
      '#title' => 'Infos à ne PAS porter sur la convocation',
      '#default_value' => $module->field_convoc_info_off->value,
      '#description' => '',
    );
    $form['submit'] = array(
      '#type' => 'submit',
      '#value' => t('Submit'),
    );
    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $current_uri = \Drupal::request()->getRequestUri();
    $path_args = array_slice(explode('/',$current_uri),-2,2);
    $co_degre = $path_args[0];
    $co_modu  = $path_args[1];
    $mid = 10*$co_modu + $co_degre;

    $module = \Drupal\gaia\Entity\Gmodu::load($mid);

    $module->field_convoc_info_off = $form_state->getValue('convoc_info_off')['value'];
    $module->save();

    $url = \Drupal\Core\Url::fromRoute('bb.moduleng')
          ->setRouteParameters(array('co_degre' => $co_degre,'co_modu' => $co_modu));
    $form_state->setRedirectUrl($url);
    return TRUE;
  }

}
