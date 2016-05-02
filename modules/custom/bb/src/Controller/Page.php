<?php

/**
 * @file
 * Contains Drupal\bb\Controller\Page.
 */

namespace Drupal\bb\Controller;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Link;

/**
 * Simple page controller for drupal.
 */
class Page extends ControllerBase {
  /**
   * Lists the examples provided by form_example.
   */
  public function description() {
    // These libraries are required to facilitate the ajax modal form demo.
    $content['#attached']['library'][] = 'core/drupal.ajax';
    $content['#attached']['library'][] = 'core/drupal.dialog';
    $content['#attached']['library'][] = 'core/drupal.dialog.ajax';
    $content['intro'] = [
      '#markup' => '<p>' . $this->t('Examples from Drupal Form API.') . '</p>',
    ];

    // Create a list of links to the form examples.
    $content['links'] = [
      '#theme' => 'item_list',
      '#items' => [
        // Attributes are used by the core dialog libraries to invoke the modal.
        Link::createFromRoute(
          $this->t('Modal Example'),
          'bb.modal_form',
           [],
           [
             'attributes' => [
               'class' => ['use-ajax'],
               'data-dialog-type' => 'modal',
             ]
           ]
        ),
      ],
    ];

    // The message container is used by the modal form example it is an empty
    // tag that will be replaced by content.
    $content['message'] = [
      '#type' => 'container',
      '#attributes' => ['id' => 'fapi-example-message'],
    ];

    $content['sessions'] =
        \Drupal::formBuilder()->getForm('Drupal\bb\Form\SessionsTableForm');

    return $content;
  }

}
