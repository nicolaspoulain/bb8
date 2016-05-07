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
    $string = $request->query->get('q');
    $matches = array();
    $result = db_select('gbb_gresp_dafor')
      ->fields('gbb_gresp_dafor', array('co_resp', 'nomu', 'prenom'))
      ->condition('nomu', db_like($string) . '%', 'LIKE')
      ->range(0, 10)
      ->execute();
    foreach ($result as $resp) {
      // In the simplest case (see user_autocomplete), the key and the value are
      // the same. Here we'll display the uid along with the username in the
      // dropdown.
      $matches[] = array('value' => "$resp->nomu $resp->prenom ($resp->co_resp)",
                         'label' => "$resp->nomu $resp->prenom ($resp->co_resp)",) ;
    }

    return new JsonResponse($matches);
  }
  public function autocompLieu(Request $request) {
    $string = $request->query->get('q');
    $matches = array();
    if ($string) {
      $matches[] = array('value' => '0759999L', 'label' => 'Rectorat');
      $matches[] = array('value' => '0753345D', 'label' => 'Michelet');
      $matches[] = array('value' => '0752251P', 'label' => 'Louise Michel');
    }

    return new JsonResponse($matches);
  }
}
