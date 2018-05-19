<?php

namespace Drupal\chart_block_example\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a formateur edition Block.
 *
 * @Block(
 *   id = "formateur_form_block",
 *   admin_label = @Translation("Formulaire formateur"),
 *   category = @Translation("BB"),
 * )
 */
class FormateurFormBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    return array(
      '#markup' => $this->t('Hello, World!'),
    );
  }

}

