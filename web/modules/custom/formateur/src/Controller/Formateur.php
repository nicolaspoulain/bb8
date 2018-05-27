<?php

namespace Drupal\formateur\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\bb\Controller\BbCrudController;

class Formateur extends ControllerBase {

  public function heures() {
    $query = \Drupal::request()->query->all();
    $co_resp = $query['co_resp'];
    // Doit correspondre au filtre groupé id_disp
    // sur admin/structure/views/view/bb_stages_formateur/edit/page_1
    switch ($query['id_disp']) {
      case '1':
        $annee = '18';
        break;
      case '2':
        $annee = '17';
        break;
      case '3':
        $annee = '16';
        break;
      case '4':
        $annee = '15';
        break;
      case '5':
        $annee = '14';
        break;
    }

    $entry = array(
      'co_resp'  => $co_resp,
      'period'   => $annee,
      'type'     => 'dech_dafor'
    );
    $formateur = BbCrudController::load( 'gbb_gresp_periodic', $entry);
    $dech_dafor = $formateur[0]->val;
    $dech_dafor = ($dech_dafor > 0)? $dech_dafor : 0;

    $entry = array(
      'co_resp'  => $co_resp,
      'period'   => $annee,
      'type'     => 'dech_pfa'
    );
    $formateur = BbCrudController::load( 'gbb_gresp_periodic', $entry);
    $dech_pfa = $formateur[0]->val;
    $dech_pfa = ($dech_pfa > 0)? $dech_pfa : 0;

    // switch database (cf settings.php)
    \Drupal\Core\Database\Database::setActiveConnection('external');
    // Build query

    //**** les vacations **************
    $query = db_select('gbb_session', 's');
    $query ->leftjoin('gbb_gmodu', 'm',
      'm.co_modu = s.co_modu AND m.co_degre = s.co_degre'
    );
    $query ->leftjoin('gbb_gdisp', 'd',
      'd.co_disp = m.co_disp AND d.co_degre = s.co_degre'
    );
    $query ->condition('s.co_resp', $co_resp, '=')
      ->condition('s.co_degre', '2', '=')
      ->condition('s.type_paiement', 'VAC', 'LIKE')
      ->condition('id_disp', db_like($annee) . '%', 'LIKE')
      ->distinct();
    $query ->addExpression('SUM(duree_prevue)', 'sumvac');
    $sum_vac = $query->execute()->fetchObject()->sumvac;
    $sum_vac = ($sum_vac > 0)? $sum_vac : 0;
    // dpq($query);

    //**** la decharge **************
    $query = db_select('gbb_session', 's');
    $query ->leftjoin('gbb_gmodu', 'm',
      'm.co_modu = s.co_modu AND m.co_degre = s.co_degre'
    );
    $query ->leftjoin('gbb_gdisp', 'd',
      'd.co_disp = m.co_disp AND d.co_degre = s.co_degre'
    );
    $query ->condition('s.co_resp', $co_resp, '=')
      ->condition('s.co_degre', '2', '=')
      ->condition('s.type_paiement', 'DECH', 'LIKE')
      ->condition('id_disp', db_like($annee) . '%', 'LIKE')
      ->distinct();
    $query ->addExpression('SUM(duree_prevue)', 'sumdec');
    $sum_dec = $query->execute()->fetchObject()->sumdec;
    $sum_dec = ($sum_dec > 0)? $sum_dec : 0;
    // dpq($query);

    //**** les heures PFA **************
    $query = db_select('gbb_session', 's');
    $query ->leftjoin('gbb_gmodu', 'm',
      'm.co_modu = s.co_modu AND m.co_degre = s.co_degre'
    );
    $query ->leftjoin('gbb_gdisp', 'd',
      'd.co_disp = m.co_disp AND d.co_degre = s.co_degre'
    );
    $query ->condition('s.co_resp', $co_resp, '=')
      ->condition('s.co_degre', '2', '=')
      ->condition('s.type_paiement', 'PFA', 'LIKE')
      ->condition('id_disp', db_like($annee) . '%', 'LIKE')
      ->distinct();
    $query ->addExpression('SUM(duree_prevue)', 'sumvac');
    $sum_pfa = $query->execute()->fetchObject()->sumvac;
    $sum_pfa = ($sum_pfa > 0)? $sum_pfa : 0;
    // dpq($query);


    return [
      'dech_dafor' => $dech_dafor*27,
      'sum_vac' => $sum_vac,
      'sum_dec' => $sum_dec,
      'dech_pfa' => $dech_pfa*27,
      'sum_pfa' => $sum_pfa,
    ];
  }
}
