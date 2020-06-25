<?php

namespace Drupal\pia\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\bb\Controller\BbCrudController;

class PiaController extends ControllerBase {

  /**
   * Render a list of entries in the database.
   */
  public function list_w($co_modu, $co_degre) {
    $content = [];

    \Drupal\Core\Database\Database::setActiveConnection('external');
    $query = db_select('gbb_gmodu', 'm');
    $query ->condition('m.co_modu', $co_modu, '=');
    $query ->condition('m.co_degre', $co_degre, '=');
    $query ->fields('m', array( 'co_modu', 'lib',));
    foreach ($result = $query->execute()->fetchAll() as $r) {
      $content['title'] = [
        '#markup' => '<h1>'.$co_modu.' '.$r->lib.'</h1>',
      ];
    };
    $content['semestre_form']= \Drupal::formBuilder()->getForm('Drupal\pia\Form\SemestreForm', $co_modu, $co_degre, 'edit');
    $content['message'] = [
      '#markup' => $this->t('Multi-affichage. Nombre >100 pour les domanies ou disc. non porteurs'),
    ];

    $headers = array(
    '2S' => t('2S'),
    '2S_w' => t('Web'),
    '1P' => t('1P'),
    '1P_w' => t('Web'),
    'PA' => t('PA'),
    'PA_w' => t('Web'),
    '4E' => t('4E'),
    '4E_w' => t('Web'),
    );

    // switch database (cf settings.php)
    // \Drupal\Core\Database\Database::setActiveConnection('external');
    // Build query

    //  -------------------------------------------------
    //  ----- 2S ----------
    $rows = array();
    $query = db_select('taxonomy_term_field_data', 'ttfd');
    $query->join('taxonomy_term__field_plan', 'ttfp', 'ttfp.entity_id = ttfd.tid ');
    $query ->condition('ttfp.field_plan_value', "S");
    $query ->fields('ttfd', array( 'name', 'tid',))
           ->orderBy('weight', 'ASC');

    // $co_degre=2;
    // $co_modu=22222;
    $condition = array('co_modu' => $co_modu, 'co_degre' => $co_degre);
    $row = BbCrudController::load('gbb_gmodu_taxonomy', $condition);
    foreach ($row as $l) {
      if ($l->type=='w') $web[$l->tid]=$l->weight;
      $web[$l->tid]=$l->weight;
      $checktab[$l->tid]=1;
    }
    foreach ($result = $query->execute()->fetchAll() as $r) {
      $position = $web[$r->tid];
      $check=$checktab[$r->tid];
      // print($r->tid."-".$check.' ** ');
      $position = ($position==0)? 1:$position;
      $position_w = \Drupal::formBuilder()->getForm('Drupal\pia\Form\PositionForm_w',
        $check, $position, 'w', $r->tid, $co_modu, $co_degre);

      $str = $r->name;

      $rows[] = array(
        '2S'   => array('data' => $str),
        '2S_w' => array('data' => $position_w, 'class'=>'jaunepia'),
      );
    }

    //  -------------------------------------------------
    //  ----- 1P ----------
    // \Drupal\Core\Database\Database::setActiveConnection('external');
    $query = db_select('taxonomy_term_field_data', 'ttfd');
    $query->join('taxonomy_term__field_plan', 'ttfp', 'ttfp.entity_id = ttfd.tid ');
    $query ->condition('ttfp.field_plan_value', "P");
    $query ->fields('ttfd', array( 'name', 'tid',))
           ->orderBy('weight', 'ASC');


    $count = 0;
    foreach ($result = $query->execute()->fetchAll() as $r) {
      $position = $web[$r->tid];
      $check=($position==0)? 0: 1;
      $position = ($position==0)? 1:$position;
      $position_w = \Drupal::formBuilder()->getForm('Drupal\pia\Form\PositionForm_w',
        $check, $position, 'w', $r->tid, $co_modu, $co_degre);

      $str = $r->name;

      $rows[$count]['1P']   = array('data' => $str);
      $rows[$count]['1P_w'] = array('data' => $position_w,'class'=>'jaunepia');
      $count = $count +1;
    }
    //  -------------------------------------------------
    //  ----- PA ----------
    // \Drupal\Core\Database\Database::setActiveConnection('external');
    $query = db_select('taxonomy_term_field_data', 'ttfd');
    $query->join('taxonomy_term__field_plan', 'ttfp', 'ttfp.entity_id = ttfd.tid ');
    $query ->condition('ttfp.field_plan_value', "A");
    $query ->fields('ttfd', array( 'name', 'tid',))
           ->orderBy('weight', 'ASC');

    $count = 0;
    foreach ($result = $query->execute()->fetchAll() as $r) {
      $position = $web[$r->tid];
      $check=$checktab[$r->tid];
      // print($r->tid."-".$check.' ** ');
      $position_w = \Drupal::formBuilder()->getForm('Drupal\pia\Form\PositionForm_w',
        $check, $position, 'w', $r->tid, $co_modu, $co_degre);

      $str = $r->name;

      $rows[$count]['PA0']   = array('data' => $str);
      $rows[$count]['PA0_w'] = array('data' => $position_w,'class'=>'jaunepia');
      $count = $count +1;
    }
    //  -------------------------------------------------
    //  ----- 4E ----------
    // \Drupal\Core\Database\Database::setActiveConnection('external');
    $query = db_select('taxonomy_term_field_data', 'ttfd');
    $query->join('taxonomy_term__field_plan', 'ttfp', 'ttfp.entity_id = ttfd.tid ');
    $query ->condition('ttfp.field_plan_value', "E");
    $query ->fields('ttfd', array( 'name', 'tid',))
           ->orderBy('weight', 'ASC');

    $count = 0;
    foreach ($result = $query->execute()->fetchAll() as $r) {
      $position = $web[$r->tid];
      $check=($position==0)? 0: 1;
      $position = ($position==0)? 1:$position;
      $position_w = \Drupal::formBuilder()->getForm('Drupal\pia\Form\PositionForm_w',
        $check, $position, 'w', $r->tid, $co_modu, $co_degre);

      $str = $r->name;

      $rows[$count]['4E']   = array('data' => $str);
      $rows[$count]['4E_w'] = array('data' => $position_w,'class'=>'jaunepia');
      $count = $count +1;
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

