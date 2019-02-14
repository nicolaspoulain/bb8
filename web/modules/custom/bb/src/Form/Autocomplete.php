<?php

/**
 * @file
 * Contains \Drupal\bb\Form\Autocomplete
 */

namespace Drupal\bb\Form;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


// Lire
// http://capgemini.github.io/drupal/writing-custom-fields-in-drupal-8/
// https://www.safaribooksonline.com/library/view/programmers-guide-to/9781491911457/ch04.html

class Autocomplete {

  public function autocompFormateur(Request $request) {
    \Drupal\Core\Database\Database::setActiveConnection('external');
    $string = $request->query->get('q');
    $matches = array();
    if ($string) {
      $query = db_select('gbb_gresp_dafor','r')
        ->where("CONCAT(nomu, ' ', prenom) LIKE :q", array(':q'=>$string.'%'))
        // ->condition('nomu', db_like($string) . '%', 'LIKE')
        ->fields('r', array('co_resp', 'nomu', 'prenom'))
        ->range(0, 10);
      $result = $query->execute();

      $thisyear = date("y");
      $thismonth = date("m");
      $year = ($thismonth>7)?$thisyear:$thisyear-1;

      foreach ($result as $res) {
        $query2 = db_select('gbb_gresp_dafor','r')
          ->condition('r.co_resp', $res->co_resp, '=');
        $query2->join('gbb_gresp_periodic','p',"p.co_resp=r.co_resp AND p.period=$year");
        $query2->condition('type', db_like('dech_dafor'), 'LIKE')
          ->fields('p', array('val'));
        $xx = $query2->execute()->fetchAssoc();
        $xx = ($xx['val']>0)? "**".$xx['val']."h**":"";
        $matches[] = array('value' => "$res->nomu $res->prenom (id:$res->co_resp)",
          'label' => "$res->nomu $res->prenom $xx (id:$res->co_resp)",) ;
      }
    }
    \Drupal\Core\Database\Database::setActiveConnection();
    return new JsonResponse($matches);
  }

  public function autocompLieu(Request $request) {
    \Drupal\Core\Database\Database::setActiveConnection('external');
    $string = $request->query->get('q');
    $matches = array();
    if ($string) {
      $result = db_select('gbb_netab_dafor')
        ->fields('gbb_netab_dafor', array('co_lieu', 'denom_comp', 'sigle'))
        ->condition('denom_comp', '%' . db_like($string) . '%', 'LIKE')
        ->range(0, 10)
        ->execute();
      foreach ($result as $res) {
        $matches[] = array('value' => "$res->sigle $res->denom_comp (rne:$res->co_lieu)",
          'label' => "$res->sigle $res->denom_comp (rne:$res->co_lieu)",) ;
      }
    }
    \Drupal\Core\Database\Database::setActiveConnection();
    return new JsonResponse($matches);
  }
}
