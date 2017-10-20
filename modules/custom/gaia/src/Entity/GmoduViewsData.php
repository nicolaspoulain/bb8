<?php

namespace Drupal\gaia\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Gmodu entities.
 */
class GmoduViewsData extends EntityViewsData {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    // Additional information for Views integration, such as table joins, can be
    // put here.

    return $data;
  }

}
