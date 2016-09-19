<?php
/**
 * @file
 * Contains Drupal\bb\Controller\ModuleNG.
 */

namespace Drupal\bb\Controller;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Link;

/**
 * Simple ModuleNG controller for drupal.
 */
class ModuleNG extends ControllerBase {
  /**
   * Lists the examples provided by form_example.
   */
  public function sessions() {
    // These libraries are required to facilitate the ajax modal form demo.
    $content['#attached']['library'][] = 'core/drupal.ajax';
    $content['#attached']['library'][] = 'core/drupal.dialog';
    $content['#attached']['library'][] = 'core/drupal.dialog.ajax';

    $content['intro'] = [ '#markup' => 'src/Controller/ModuleNG.php' ];
    // See bb.module function bbtheme
    $content['#theme'] = 'moduleng';
    // moduleng-layout/html.twig

    // Get form
    $content['sessions'] =
      \Drupal::formBuilder()->getForm('Drupal\bb\Form\SessionsTableForm');

    // Disable page caching on the current request.
    \Drupal::service('page_cache_kill_switch')->trigger();

    // dpm($content);
    return $content;
  }

}
