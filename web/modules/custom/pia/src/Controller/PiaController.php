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
    '2S_p' => t('2S Web'),
    '2S_pf' => t(''),
    '2S_w' => t('2S Web'),
    '2S_wf' => t(''),
    '1P_p' => t('1P papier'),
    '1P_pf' => t(''),
    '1P_w' => t('1P Web'),
    '1P_wf' => t(''),
    'PA_p' => t('PA papier'),
    'PA_pf' => t(''),
    'PA_w' => t('PA Web'),
    'PA_wf' => t(''),
    '4E_p' => t('4E papier'),
    '4E_pf' => t(''),
    '4E_w' => t('4E Web'),
    '4E_wf' => t(''),
    );

    // switch database (cf settings.php)
    \Drupal\Core\Database\Database::setActiveConnection('external');
    // Build query

    //  -------------------------------------------------
    //  ----- 2S ----------
    $rows = array();
    $query = db_select('gbb_norie', 'n');
    $query ->condition('n.co_orie', "2S%", 'like');
    $query ->fields('n', array( 'co_orie', 'lib_court',));

    $co_degre=2;
    $co_modu=22222;
    $condition = array('co_modu' => $co_modu, 'co_degre' => $co_degre);
    $row = BbCrudController::load('gbb_gmodu_taxonomy', $condition);
    foreach ($row as $l) {
      if ($l->type=='p') $pap[$l->tid]=$l->weight;
      if ($l->type=='w') $web[$l->tid]=$l->weight;
    }
    print_r($tab);
    // print_r($row);
    foreach ($result = $query->execute()->fetchAll() as $r) {
      $position = $pap[$r->co_orie];
      $check=($position==0)? 0: 1;
      $position_p = \Drupal::formBuilder()->getForm('Drupal\pia\Form\PositionForm',
        $check, $position, 'p', $r->co_orie, $co_modu, $co_degre);

      $position = $web[$r->co_orie];
      $check=($position==0)? 0: 1;
      $position_w = \Drupal::formBuilder()->getForm('Drupal\pia\Form\PositionForm',
        $check, $position, 'w', $r->co_orie, $co_modu, $co_degre);

      $str = substr($r->co_orie,-2).":".str_replace(" ","_",$r->lib_court);

      $rows[] = array(
        // '2S_p'         => array('data' => $str),
        '2S_p'         => array('data' => $str),
        '2S_pf'        => array('data' => $position_p),
        '2S_w' => array('data' => $str,'class'=>'jaunepia'),
        '2S_wf'=> array('data' => $position_w, 'class'=>'jaunepia'),
      );
    }

    //  -------------------------------------------------
    //  ----- 1P ----------
    $query = db_select('gbb_norie', 'n');
    $query ->condition('n.co_orie', "1P%", 'like');
    $query ->fields('n', array( 'co_orie', 'lib_court',));

    $count = 0;
    foreach ($result = $query->execute()->fetchAll() as $r) {
      $position_p = \Drupal::formBuilder()->getForm('Drupal\pia\Form\PositionForm', 500, $r->co_orie);
      $position_w = \Drupal::formBuilder()->getForm('Drupal\pia\Form\PositionForm', 500, $r->co_orie);
      $str = substr($r->co_orie,-2).":".str_replace(" ","_",$r->lib_court);

      $rows[$count]['1P_p']  = array('data' => $str);
      $rows[$count]['1P_pf'] = array('data' => $position_p);
      $rows[$count]['1P_w'] = array('data' => $str,'class'=>'jaunepia');
      $rows[$count]['1P_wf'] = array('data' => $position_w,'class'=>'jaunepia');
      $count = $count +1;
    }
    //  -------------------------------------------------
    //  ----- PA ----------
    $query = db_select('gbb_norie', 'n');
    $query ->condition('n.co_orie', "PA0%", 'like');
    $query ->fields('n', array( 'co_orie', 'lib_court',));

    $count = 0;
    foreach ($result = $query->execute()->fetchAll() as $r) {
      $position_p = \Drupal::formBuilder()->getForm('Drupal\pia\Form\PositionForm', 500, $r->co_orie);
      $position_w = \Drupal::formBuilder()->getForm('Drupal\pia\Form\PositionForm', 500, $r->co_orie);
      $str = substr($r->co_orie,-2).":".str_replace(" ","_",$r->lib_court);

      $rows[$count]['PA0_p'] = array('data' => $str);
      $rows[$count]['PA0_pf'] = array('data' => $position_p);
      $rows[$count]['PA0_w'] = array('data' => $str,'class'=>'jaunepia');
      $rows[$count]['PA0_wf'] = array('data' => $position_w,'class'=>'jaunepia');
      $count = $count +1;
    }
    //  -------------------------------------------------
    //  ----- 4E ----------
    $query = db_select('gbb_norie', 'n');
    $query ->condition('n.co_orie', "4E%", 'like');
    $query ->fields('n', array( 'co_orie', 'lib_court',));

    $count = 0;
    foreach ($result = $query->execute()->fetchAll() as $r) {
      $position_p = \Drupal::formBuilder()->getForm('Drupal\pia\Form\PositionForm', 500, $r->co_orie);
      $position_w = \Drupal::formBuilder()->getForm('Drupal\pia\Form\PositionForm', 500, $r->co_orie);
      $str = substr($r->co_orie,-2).":".str_replace(" ","_",$r->lib_court);

      $rows[$count]['4E_p'] = array('data' => $str);
      $rows[$count]['4E_pf'] = array('data' => $position_p);
      $rows[$count]['4E_w'] = array('data' => $str,'class'=>'jaunepia');
      $rows[$count]['4E_wf'] = array('data' => $position_w,'class'=>'jaunepia');
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

