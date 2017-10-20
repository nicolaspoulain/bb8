<?php

/**
 * @file
 * Contains session.page.inc.
 *
 * Page callback for Session entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Session templates.
 *
 * Default template: session.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_session(array &$variables) {
  // Fetch Session Entity Object.
  $session = $variables['elements']['#session'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
