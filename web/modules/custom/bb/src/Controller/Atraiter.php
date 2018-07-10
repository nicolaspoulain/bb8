<?php
namespace Drupal\bb\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Provides route responses for the Example module.
 */
class Atraiter extends ControllerBase {

  /**
   * Returns a simple page.
   *
   * @return array
   *   A simple renderable array.
   */
  public function page($id_disp_1) {
      // Load the current user
      $user = \Drupal\user\Entity\User::load(\Drupal::currentUser()->id());
      // retrieve field data from that user
      $degre = $user->get('field_degre')->value;
    // query parameters
    $routeparameters = array( 'id_disp_1' => $degre,);
    return $this->redirect('view.a_traiter.page_1',$routeparameters);
  }

}


