<?php

namespace Drupal\chart_block_example\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\bb\Controller\BbCrudController;

/**
 * Provides a 'ChartsBlock' block.
 *
 * @Block(
 *  id = "charts_block",
 *  admin_label = @Translation("Charts block"),
 *  category = @Translation("BB"),
 * )
 */
class ChartsBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $co_resp = '114';
    $current_uri = \Drupal::request()->getRequestUri();
    $path_args = array_slice(explode('/',$current_uri),-2,2);
    $co_resp = explode('=',explode('?',$path_args[1])[1])[3];
    $annee = explode('&',(explode('=',explode('?',$path_args[1])[1])[1]))[0];
    // Doit correspondre au filtre groupé id_disp
    // sur admin/structure/views/view/bb_stages_formateur/edit/page_1
    switch ($annee) {
      case '1':
        $annee = '20';
        break;
      case '2':
        $annee = '19';
        break;
      case '3':
        $annee = '18';
        break;
      case '4':
        $annee = '17';
        break;
      case '5':
        $annee = '16';
        break;
      case '6':
        $annee = '15';
        break;
      case '7':
        $annee = '14';
        break;
      case '8':
        $annee = '13';
        break;
      default:
        $annee = '17';
        break;
    }

    $entry = array(
      'co_resp'  => explode('=',explode('?',$path_args[1])[1])[3],
    );
    // dpm($entry);

    $formateur = BbCrudController::load( 'gbb_gresp_plus', $entry);
    $decharge = $formateur[0]->decharge;

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
    $query ->addExpression('SUM(duree_a_payer)', 'sumvac');
    $sumvac = $query->execute()->fetchObject()->sumvac;

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
    $query ->addExpression('SUM(duree_a_payer)', 'sumdec');
    $sumdec = $query->execute()->fetchObject()->sumdec;


    $options = [];

    $options['type'] = 'column';
    $options['title'] = $this->t('');

    $options['yaxis_title'] = $this->t('Heures');
    $options['xaxis_title'] = $this->t('Ages');

    $options['yaxis_min'] = '100';
    $options['yaxis_max'] = '';

    // TODO Google specific options...
    $options['legend'] = 'none';

    // Sample data format.
    $categories = [
      'Déch.DAFOR',
      'En décharge',
      'En vacation',
    ];

    $seriesData = [
      [
        'name'  => 'Heures',
        'color' => '#0d233a',
        'data'  => [$decharge*27, $sumdec, $sumvac],
      ],
    ];

    $build = [
      '#theme'      => 'chart_block_example',
      '#library'    => 'google',
      '#categories' => $categories,
      '#seriesData' => $seriesData,
      '#options'    => $options,
    ];

    // Don't cache this page.
    $build['#cache']['max-age'] = 0;

    return $build;
  }

}
