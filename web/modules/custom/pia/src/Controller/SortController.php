<?php

namespace Drupal\pia\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\bb\Controller\BbCrudController;

class SortController extends ControllerBase {

  /**
   * Render a list of entries in the database.
   */
  public function list($co_orie, $tid) {
    $content = [];

    // switch database (cf settings.php)
    \Drupal\Core\Database\Database::setActiveConnection('external');
    $query = db_select('taxonomy_term_data', 'ttd');
    $query ->condition('ttd.tid', $tid);
    $query ->fields('ttd', array('name',));
    foreach ($result = $query->execute()->fetchAll() as $r) {
      $content['title'] = [
        '#markup' => "<h1>Classement pour ".$r->name.'. Orientation :'.$co_orie.' </h1>',
      ];
    };

    $content['message'] = [
      '#markup' => $this->t('Ré-organisez ici les modules en les déplaçant avec la souris.'),
    ];
    $content['filtres'] = \Drupal::formBuilder()->getForm('Drupal\pia\Form\DraggableForm', $co_orie, $tid);

    // Don't cache this page.
    $content['#cache']['max-age'] = 0;

    return $content;
  }

  public function list_w($tid) {
    $content = [];
    \Drupal\Core\Database\Database::setActiveConnection('external');

    $query = db_select('taxonomy_term_data', 'ttd');
    $query ->condition('ttd.tid', $tid);
    $query ->fields('ttd', array('name'));
    foreach ($result = $query->execute()->fetchAll() as $r) {
      $content['title'] = [
        '#markup' => "<h1>Classement web pour ".$r->name.'</h1>',
      ];
    };

    $content['message'] = [
      '#markup' => $this->t('Ré-organisez ici les modules en les déplaçant avec la souris.'),
    ];
    $content['filtres'] = \Drupal::formBuilder()->getForm('Drupal\pia\Form\DraggableForm', 'WEB', $tid);
    $content['message2'] = [
      '#markup' => $this->t('Vous pouvez être intéressé par :'),
    ];
    $content['filtre2'] = \Drupal::formBuilder()->getForm('Drupal\pia\Form\DraggableForm', 'WEB2', $tid);

    // Don't cache this page.
    $content['#cache']['max-age'] = 0;

    return $content;
  }
}

