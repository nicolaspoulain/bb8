<?php
namespace Drupal\bb\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Provides route responses for the Example module.
 */
class Liste extends ControllerBase {

  /**
   * Returns a simple page.
   *
   * @return array
   *   A simple renderable array.
   */
  public function page($id_disp,$co_anmo,$resp_filter) {
    if ($resp_filter == "username") {
      // Load the current user
      $user = \Drupal\user\Entity\User::load(\Drupal::currentUser()->id());
      // retrieve field data from that user
      $resp_filter = $user->get('field_name')->value;
      if ($user->get('field_degre')->value == 1) {
        $id_disp = $id_disp + 3;
        $resp_filter = '';
      };
    };
    // query parameters
    $routeparameters = array(
      'id_disp' => $id_disp,
      'co_anmo' => $co_anmo,
      'resp_filter' => $resp_filter);
    return $this->redirect('view.liste_modules.page_1',$routeparameters);
  }

}

