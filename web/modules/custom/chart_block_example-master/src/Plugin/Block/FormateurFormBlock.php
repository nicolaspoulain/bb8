<?php

namespace Drupal\chart_block_example\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Hello' Block.
 *
 * @Block(
 *   id = "formateu_form_block",
 *   admin_label = @Translation("Formulaire formateur"),
 *   category = @Translation("Formulaire formateur"),
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

