<?php

namespace Drupal\formateur\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a formateur edition Block.
 *
 * @Block(
 *   id = "formulaire_formateur_block",
 *   admin_label = @Translation("Formulaire gest. formateur"),
 *   category = @Translation("BB"),
 * )
 */
class FormateurFormBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    // See .module hook_theme
    $content['#theme'] = 'formateur_form';

    $content['intro'] = [ '#markup' => $this->t(''), ];
    $content['form'] = \Drupal::formBuilder()->getForm('Drupal\formateur\Form\FormateurForm');
    return $content;
  }

}

