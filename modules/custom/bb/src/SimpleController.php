<?php

/**
 * @file
 * Contains \Drupal\bb\SimpleController.
 */

namespace Drupal\bb;

use Drupal\Core\Controller\ControllerBase;

/**
 * Controller for simple action.
 */
class SimpleController extends ControllerBase {

  /**
   * Render a famous sentence.
   */
  public function hello() {
    return array(
        '#type' => 'markup',
        '#markup' => t('Hello, World!'),
    );
  }
}

