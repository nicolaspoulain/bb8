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
    if ($string) {
      $matches[] = array('value' => '114', 'label' => 'Poulain N');
      $matches[] = array('value' => '2712', 'label' => 'Poulain A');
      $matches[] = array('value' => '106', 'label' => 'PANDAZOPOULOS');
      $matches[] = array('value' => '1343', 'label' => 'Baldacci J');
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
