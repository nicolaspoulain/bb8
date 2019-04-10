<?php

namespace Drupal\pia\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\bb\Controller\BbCrudController;

class PiaController extends ControllerBase {

  /**
   * Render a list of entries in the database.
   */
  public function list() {
    $content = [];
    $gets =\Drupal::request()->query->all();
    $nomu = $gets['nomu'];
    $co_orie = $gets['co_orie'];


    $content['filtres'] = \Drupal::formBuilder()->getForm('Drupal\offres\Form\FiltresForm', $r->comment, $r->co_omodu);

    $content['message'] = [
      '#markup' => $this->t('À propos de «Position» : Pour chaque orientation, classer les offres de 1 (indispensable) à 500 (non retenue). Ex-aequo autorisés.'),
    ];

    $headers = array(
    '1P_p' => t('1D-papier (mono)'),
    '1P_w' => t('1D-Web (multi)'),
    '2S_p' => t('1D-papier (mono)'),
    '2S_w' => t('1D-Web (multi)'),
    'PA_p' => t('1D-papier (mono)'),
    'PA_w' => t('1D-Web (multi)'),
    );

    // switch database (cf settings.php)
    \Drupal\Core\Database\Database::setActiveConnection('external');
    // Build query

    // foreach (['1P', '2S', 'PA'] as $colonne) {
    $rows = array();
    foreach (['2S'] as $colonne) {
      $query = db_select('gbb_norie', 'n');
      $query ->condition('n.co_orie', $colonne."%", 'like');
      $query ->fields('n', array( 'co_orie', 'lib_court',));

      foreach ($result = $query->execute()->fetchAll() as $r) {
        $position = \Drupal::formBuilder()->getForm('Drupal\pia\Form\PositionForm', 500, $r->co_orie);

        $rows[] = array(
          $colonne.'_p'         => array('data' => $r->co_orie." ".$r->lib_court. " ". $position),
          $colonne.'_w'         => array('data' => $r->co_orie." ".$r->lib_court. " ". $position),
        );
      }
    }

    foreach (['1P'] as $colonne) {
      $query = db_select('gbb_norie', 'n');
      $query ->condition('n.co_orie', $colonne."%", 'like');
      $query ->fields('n', array( 'co_orie', 'lib_court',));

      $count = 0;
      foreach ($result = $query->execute()->fetchAll() as $r) {
        $position = \Drupal::formBuilder()->getForm('Drupal\pia\Form\PositionForm', 500, $r->co_orie);

        $rows[$count][$colonne.'_p'] = array('data' => $r->co_orie." ".$r->lib_court. " ". $position);
        $rows[$count][$colonne.'_w'] = array('data' => $r->co_orie." ".$r->lib_court. " ". $position);
        $count = $count +1;
      }
    }

    // print_r($rows);

    $content['table'][] = array(
      '#type' => 'table',
      '#header' => $headers,
      '#rows' => $rows,
    );
    $content['table'][] = array(
      '#type' => 'pager',
    );

    // Don't cache this page.
    $content['#cache']['max-age'] = 0;

    return $content;
  }
}

