<?php

namespace Drupal\pia\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\bb\Controller\BbCrudController;

class PiaController extends ControllerBase {

  /**
   * Render a list of entries in the database.
   */
  public function list($co_modu, $co_degre) {
    $content = [];
    // switch database (cf settings.php)
    \Drupal\Core\Database\Database::setActiveConnection('external');
    // Build query

    $query = db_select('gbb_gmodu', 'm');
    $query ->join('gbb_gdisp', 'd', 'm.co_disp = d.co_disp AND m.co_degre = d.co_degre');
    $query ->condition('m.co_modu', $co_modu, '=');
    $query ->condition('m.co_degre', $co_degre, '=');
    $query ->fields('m', array( 'co_modu', 'lib',));
    $query ->fields('d', array( 'co_orie',));
    foreach ($result = $query->execute()->fetchAll() as $r) {
      $content['title'] = [
        '#markup' => '<h1>'.$co_modu.' '.$r->lib.'</h1>',
      ];
    };
    $co_orie = $r->co_orie;
    $content['message'] = [
      '#markup' => $this->t('Mono affichage. Cochez une case unique.'),
    ];

    $headers = array(
    '2S' => t('2S'),
    '2S_p' => t('Papier'),
    '2S_w' => t('Web'),
    '1P' => t('1P'),
    '1P_p' => t('Papier'),
    '1P_w' => t('Web'),
    'PA' => t('PA'),
    'PA_p' => t('Papier'),
    'PA_w' => t('Web'),
    '4E' => t('4E'),
    '4E_p' => t('Papier'),
    '4E_w' => t('Web'),
    );
    $headers = array(
    '2S' => t('2S'),
    '2S_p' => t('Papier'),
    '1P' => t('1P'),
    '1P_p' => t('Papier'),
    'PA' => t('PA'),
    'PA_p' => t('Papier'),
    '4E' => t('4E'),
    '4E_p' => t('Papier'),
    );

    // switch database (cf settings.php)
    \Drupal\Core\Database\Database::setActiveConnection('external');
    // Build query

    //  -------------------------------------------------
    //  ----- 2S ----------
    $rows = array();
    $query = db_select('taxonomy_term_data', 'ttd');
    $query ->condition('ttd.vid', "52");
    $query ->fields('ttd', array( 'tid', 'name',));
    $query ->orderBy('weight','ASC');

    // $co_degre=2;
    // $co_modu=22222;
    $condition = array('co_modu' => $co_modu, 'co_degre' => $co_degre);
    $row = BbCrudController::load('gbb_gmodu_taxonomy', $condition);
    foreach ($row as $l) {
      if ($l->type=='p') $pap[$l->tid]=$l->weight;
      // if ($l->type=='w') $web[$l->tid]=$l->weight;
    }
    // print_r($tab);
    // print_r($row);
    // switch database (cf settings.php)
    \Drupal\Core\Database\Database::setActiveConnection('external');
    // Build query
    $count = 0;
    foreach ($result = $query->execute()->fetchAll() as $r) {
      $position = $pap[$r->tid];
      $check=($position==0)? 0: 1;
      $position = ($position==0)? 1:$position;
      $position_p = \Drupal::formBuilder()->getForm('Drupal\pia\Form\PositionForm',
        $check, $position, 'p', $r->tid, $co_orie, $co_modu, $co_degre);

      // $position = $web[$r->co_orie];
      // $check=($position==0)? 0: 1;
      // $position = ($position==0)? 1:$position;
      // $position_w = \Drupal::formBuilder()->getForm('Drupal\pia\Form\PositionForm',
        // $check, $position, 'w', $r->co_orie, $co_modu, $co_degre);

      $str = substr($r->tid,-2).":".str_replace(" ","_",$r->name);
      $str = str_replace('19125','2S',$r->tid).":".str_replace(" ","_",$r->name);
      $str = $r->tid.":".str_replace(" ","_",$r->name);
      $str = $r->name;

      $rows[$count]['2S']   = array('data' => $str);
      $rows[$count]['2S_p'] = array('data' => $position_p, 'class'=>'jaunepia');
      // $rows[$count]['PA0_w'] = array('data' => $position_w,'class'=>'jaunepia');
      $count = $count +1;
    }
    $rows[10]['2S']   = array('data' => "");
    $rows[10]['2S_p'] = array('data' => "", 'class'=>'jaunepia');
    $rows[11]['2S']   = array('data' => "");
    $rows[11]['2S_p'] = array('data' => "", 'class'=>'jaunepia');

    //  -------------------------------------------------
    //  ----- 1P ----------

    // switch database (cf settings.php)
    \Drupal\Core\Database\Database::setActiveConnection('external');
    // Build query
    $query = db_select('taxonomy_term_data', 'ttd');
    $query ->condition('ttd.vid', "51");
    $query ->fields('ttd', array( 'tid', 'name',));
    $query ->orderBy('weight','DESC');

    // $co_degre=2;
    // $co_modu=22222;
    $condition = array('co_modu' => $co_modu, 'co_degre' => $co_degre);
    $row = BbCrudController::load('gbb_gmodu_taxonomy', $condition);
    foreach ($row as $l) {
      if ($l->type=='p') $pap[$l->tid]=$l->weight;
      // if ($l->type=='w') $web[$l->tid]=$l->weight;
    }
    // print_r($tab);
    // print_r($row);
    // switch database (cf settings.php)
    \Drupal\Core\Database\Database::setActiveConnection('external');
    // Build query
    $count = 0;
    foreach ($result = $query->execute()->fetchAll() as $r) {
      $position = $pap[$r->tid];
      $check=($position==0)? 0: 1;
      $position = ($position==0)? 1:$position;
      $position_p = \Drupal::formBuilder()->getForm('Drupal\pia\Form\PositionForm',
        $check, $position, 'p', $r->tid, $co_orie, $co_modu, $co_degre);

      // $position = $web[$r->co_orie];
      // $check=($position==0)? 0: 1;
      // $position = ($position==0)? 1:$position;
      // $position_w = \Drupal::formBuilder()->getForm('Drupal\pia\Form\PositionForm',
        // $check, $position, 'w', $r->co_orie, $co_modu, $co_degre);

      $str = $r->tid.":".str_replace(" ","_",$r->name);
      $str = $r->name;


      $rows[$count]['1P']   = array('data' => $str);
      $rows[$count]['1P_p'] = array('data' => $position_p, 'class'=>'jaunepia');
      // $rows[$count]['PA0_w'] = array('data' => $position_w,'class'=>'jaunepia');
      $count = $count +1;
    }
    //  -------------------------------------------------
    //  ----- PA ----------

    // switch database (cf settings.php)
    \Drupal\Core\Database\Database::setActiveConnection('external');
    // Build query
    $query = db_select('taxonomy_term_data', 'ttd');
    $query ->condition('ttd.vid', "54");
    $query ->fields('ttd', array( 'tid', 'name',));
    $query ->orderBy('weight','ASC');

    // $co_degre=2;
    // $co_modu=22222;
    $condition = array('co_modu' => $co_modu, 'co_degre' => $co_degre);
    $row = BbCrudController::load('gbb_gmodu_taxonomy', $condition);
    foreach ($row as $l) {
      if ($l->type=='p') $pap[$l->tid]=$l->weight;
      // if ($l->type=='w') $web[$l->tid]=$l->weight;
    }
    // print_r($tab);
    // print_r($row);
    // switch database (cf settings.php)
    \Drupal\Core\Database\Database::setActiveConnection('external');
    // Build query
    $count = 0;
    foreach ($result = $query->execute()->fetchAll() as $r) {
      $position = $pap[$r->tid];
      $check=($position==0)? 0: 1;
      $position = ($position==0)? 1:$position;
      $position_p = \Drupal::formBuilder()->getForm('Drupal\pia\Form\PositionForm',
        $check, $position, 'p', $r->tid, $co_orie, $co_modu, $co_degre);

      // $position = $web[$r->co_orie];
      // $check=($position==0)? 0: 1;
      // $position = ($position==0)? 1:$position;
      // $position_w = \Drupal::formBuilder()->getForm('Drupal\pia\Form\PositionForm',
        // $check, $position, 'w', $r->co_orie, $co_modu, $co_degre);

      $str = $r->tid.":".str_replace(" ","_",$r->name);
      $str = $r->name;


      $rows[$count]['PA']   = array('data' => $str);
      $rows[$count]['PA_p'] = array('data' => $position_p, 'class'=>'jaunepia');
      // // $rows[$count]['PA0_w'] = array('data' => $position_w,'class'=>'jaunepia');
      $count = $count +1;
    }
    $rows[4]['PA']   = array('data' => "");
    $rows[4]['PA_p'] = array('data' => "", 'class'=>'jaunepia');
    $rows[5]['PA']   = array('data' => "");
    $rows[5]['PA_p'] = array('data' => "", 'class'=>'jaunepia');
    $rows[6]['PA']   = array('data' => "");
    $rows[6]['PA_p'] = array('data' => "", 'class'=>'jaunepia');
    $rows[7]['PA']   = array('data' => "");
    $rows[7]['PA_p'] = array('data' => "", 'class'=>'jaunepia');
    //  -------------------------------------------------
    //  ----- 4E ----------

    // switch database (cf settings.php)
    \Drupal\Core\Database\Database::setActiveConnection('external');
    // Build query
    $query = db_select('taxonomy_term_data', 'ttd');
    $query ->condition('ttd.vid', "53");
    $query ->fields('ttd', array( 'tid', 'name',));
    $query ->orderBy('weight','ASC');

    // $co_degre=2;
    // $co_modu=22222;
    $condition = array('co_modu' => $co_modu, 'co_degre' => $co_degre);
    $row = BbCrudController::load('gbb_gmodu_taxonomy', $condition);
    foreach ($row as $l) {
      if ($l->type=='p') $pap[$l->tid]=$l->weight;
      // if ($l->type=='w') $web[$l->tid]=$l->weight;
    }
    // print_r($tab);
    // print_r($row);
    // switch database (cf settings.php)
    \Drupal\Core\Database\Database::setActiveConnection('external');
    // Build query
    $count = 0;
    foreach ($result = $query->execute()->fetchAll() as $r) {
      $position = $pap[$r->tid];
      $check=($position==0)? 0: 1;
      $position = ($position==0)? 1:$position;
      $position_p = \Drupal::formBuilder()->getForm('Drupal\pia\Form\PositionForm',
        $check, $position, 'p', $r->tid, $co_orie, $co_modu, $co_degre);

      // $position = $web[$r->co_orie];
      // $check=($position==0)? 0: 1;
      // $position = ($position==0)? 1:$position;
      // $position_w = \Drupal::formBuilder()->getForm('Drupal\pia\Form\PositionForm',
        // $check, $position, 'w', $r->co_orie, $co_modu, $co_degre);

      $str = $r->tid.":".str_replace(" ","_",$r->name);
      $str = $r->name;


      $rows[$count]['4E']   = array('data' => $str);
      $rows[$count]['4E_p'] = array('data' => $position_p, 'class'=>'jaunepia');
      // // $rows[$count]['PA0_w'] = array('data' => $position_w,'class'=>'jaunepia');
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
    \Drupal\Core\Database\Database::setActiveConnection('external');
    // Build query

    //  -------------------------------------------------
    //  ----- 2S ----------
    $rows = array();
    $query = db_select('taxonomy_term_data', 'ttd');
    $query ->condition('ttd.vid', "56");
    $query ->fields('ttd', array( 'name', 'tid',))
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
    \Drupal\Core\Database\Database::setActiveConnection('external');
    $query = db_select('taxonomy_term_data', 'ttd');
    $query ->condition('ttd.vid', "55");
    $query ->fields('ttd', array( 'name', 'tid',))
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
    \Drupal\Core\Database\Database::setActiveConnection('external');
    $query = db_select('taxonomy_term_data', 'ttd');
    $query ->condition('ttd.vid', "58");
    $query ->fields('ttd', array( 'name', 'tid',))
           ->orderBy('weight', 'ASC');

    $count = 0;
    foreach ($result = $query->execute()->fetchAll() as $r) {
      $position = $web[$r->tid];
      $check=$checktab[$r->tid];
      print($r->tid."-".$check.' ** ');
      $position_w = \Drupal::formBuilder()->getForm('Drupal\pia\Form\PositionForm_w',
        $check, $position, 'w', $r->tid, $co_modu, $co_degre);

      $str = $r->name;

      $rows[$count]['PA0']   = array('data' => $str);
      $rows[$count]['PA0_w'] = array('data' => $position_w,'class'=>'jaunepia');
      $count = $count +1;
    }
    //  -------------------------------------------------
    //  ----- 4E ----------
    \Drupal\Core\Database\Database::setActiveConnection('external');
    $query = db_select('taxonomy_term_data', 'ttd');
    $query ->condition('ttd.vid', "57");
    $query ->fields('ttd', array( 'name', 'tid',))
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

