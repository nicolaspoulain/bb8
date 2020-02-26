<?php

namespace Drupal\plan\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\bb\Controller\BbCrudController;

/**
 * Controller
 */
class PlanController extends ControllerBase {

  /**
   * Render a list of entries in the database.
   */
  public function list() {
    $content = [];
    $gets =\Drupal::request()->query->all();
    $nomu = $gets['nomu'];
    $co_orie = $gets['co_orie'];


    $content['filtres'] = \Drupal::formBuilder()->getForm('Drupal\plan\Form\FiltresForm', $r->comment, $r->co_omodu);

    $content['message'] = [
      '#markup' => $this->t('À propos de «Position» : Pour chaque orientation, classer les plan de 1 (indispensable) à 500 (non retenue). Ex-aequo autorisés.'),
    ];

    $headers = array(
    'nomu_o'         => t('Resp. O'),
    'co_tpla'      => t('Plan'),
    'co_orie'      => t('Orie'),
    'id_disp'      => t('Id disp'),
    'co_modu'      => t('Module'),
    'libl'         => t('Titre'),
    'nomu_p'        => t('Resp. P.'),
    'prio_nat'     => array('data' => t('Pr Nat'), 'class' => 'jaune'),
    );

    // switch database (cf settings.php)
    \Drupal\Core\Database\Database::setActiveConnection('external');
    // Build query
    $count = 12;

    $query = db_select('gbb_gdisp', 'd');
    $query ->leftjoin('gbb_gmodu', 'm', 'd.co_disp = m.co_disp');
    $query ->leftjoin('gbb_gmodu_plus', 'mm', 'mm.co_modu = m.co_modu AND mm.co_degre = m.co_degre');
    $query ->leftjoin('gbb_gdire', 'do', 'do.co_modu = m.co_modu AND do.co_degre = m.co_degre AND do.co_tres = 2');
    $query ->leftjoin('gbb_gdire', 'dp', 'dp.co_modu = m.co_modu AND dp.co_degre = m.co_degre AND dp.co_tres = 3');
    $query ->leftjoin('gbb_gresp', 'ro', 'do.co_resp = ro.co_resp AND do.co_degre = ro.co_degre');
    $query ->leftjoin('gbb_gresp', 'rp', 'dp.co_resp = rp.co_resp AND dp.co_degre = rp.co_degre');
    // $query ->leftjoin('gbb_gresp', 'r2', 'm.co_resp = r2.co_resp AND r2.co_degre = 2');
    $query ->condition('d.id_disp', '19%', 'LIKE');
    if (strlen($nomu)>0)    $query ->condition('ro.nomu', $nomu, 'like');
    if (strlen($co_orie)>0) $query ->condition('d.co_orie', $co_orie, 'like');
    $query ->fields('m', array(
      'libl', 'co_modu', 'co_degre',
    ));
    $query ->fields('d', array(
      'id_disp', 'co_tpla', 'co_orie',
    ));
    $query ->fields('mm', array(
      'prio_nat',
    ));
    // $query ->fields('ro', array('nomu'));
    $query ->addfield('d', 'libl', 'libdispo');
    $query ->addField('ro', 'nomu', 'nomu_o');
    $query ->addField('rp', 'nomu', 'nomu_p');
    $query ->distinct();
    $pager = $query->extend('Drupal\Core\Database\Query\PagerSelectExtender')->limit($count);

  $rows = array();
  foreach ($result = $pager->execute()->fetchAll() as $r) {
    // $comment = render(drupal_get_form('gbb_plan_comment_form', // $r->comment, $r->co_omodu)) ;
    $prio_nat = \Drupal::formBuilder()->getForm('Drupal\plan\Form\PrioNatForm', $r->prio_nat, $r->co_modu, $r->co_degre);

    $titre = $r->libl;
    $class = "normal";
    if ($titre=="") {
      $titre = $r->libdispo;
      $class = "red";
    };

    $rows[] = array(
      'nomu_o'         => array('data' => $r->nomu_o),
      'co_tpla'      => array('data' => $r->co_tpla),
      'co_orie'      => array('data' => $r->co_orie),
      'id_disp'      => array('data' => $r->id_disp),
      'co_modu'      => array('data' => $r->co_modu),
      'libl'         => array('data' => $titre, "class"=>$class),
      'nomu_p'        => array('data' => $r->nomu_p),
      'prio_nat'     => array('data' => $prio_nat),
    );
  }

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

