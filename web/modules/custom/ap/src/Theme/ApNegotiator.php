<?php

/**
 * @file
 * Contains \Drupal\ap\Theme\ApNegotiator.
 */

namespace Drupal\ap\Theme;

use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\Core\Theme\ThemeNegotiatorInterface;

class ApNegotiator implements ThemeNegotiatorInterface {

  public function applies(RouteMatchInterface $route_match) {
    $applies = FALSE;
    $route_name = \Drupal::routeMatch()->getRouteName();
    $pages = array(
      'ap.list',
      'ap.circo',
    );
    if (in_array($route_name, $pages)) {
      $applies = TRUE;
    }
    // Use this theme negotiator.
    return $applies;
  }

  /**
   * {@inheritdoc}
   */
  public function determineActiveTheme(RouteMatchInterface $route_match) {
    return 'piatheme';
  }
}
