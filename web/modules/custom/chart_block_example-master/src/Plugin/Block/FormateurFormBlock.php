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
    // See .module hook_theme
    $content['#theme'] = 'formateur_form';

    $content['intro'] = [ '#markup' => $this->t('Salut iii coco block content'), ];
    // $content['cfile'] = \Drupal::formBuilder()->getForm('Drupal\chart_block_example\Form\FormateurForm');
    return $content;
    // return array(
      // '#markup' => $this->t('Hello, World!'),
    // );
  }

}

