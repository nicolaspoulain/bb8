<?php

/**
 * @file
 * Contains \Drupal\pia\Theme\PiaNegotiator.
 */

namespace Drupal\pia\Theme;

use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\Core\Theme\ThemeNegotiatorInterface;

class PiaNegotiator implements ThemeNegotiatorInterface {

  public function applies(RouteMatchInterface $route_match) {
    $applies = FALSE;
    $route_name = \Drupal::routeMatch()->getRouteName();
    $pages = array(
      'view.bb_pia.page_1',
      'view.bb_pia.page_2',
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
    return 'pia';
  }
}
