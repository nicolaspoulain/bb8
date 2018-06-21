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
      $result = db_select('gbb_gresp_dafor')
        ->fields('gbb_gresp_dafor', array('co_resp', 'nomu', 'prenom'))
        ->condition('nomu', db_like($string) . '%', 'LIKE')
        ->range(0, 10)
        ->execute();
      foreach ($result as $res) {
        $matches[] = array('value' => "$res->nomu $res->prenom (id:$res->co_resp)",
          'label' => "$res->nomu $res->prenom (id:$res->co_resp)",) ;
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
