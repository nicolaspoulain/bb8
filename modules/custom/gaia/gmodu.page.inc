<?php

/**
 * @file
 * Contains gmodu.page.inc.
 *
 * Page callback for Gmodu entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Gmodu templates.
 *
 * Default template: gmodu.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_gmodu(array &$variables) {
  // Fetch Gmodu Entity Object.
  $gmodu = $variables['elements']['#gmodu'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
