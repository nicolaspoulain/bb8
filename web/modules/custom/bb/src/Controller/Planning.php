<?php
namespace Drupal\bb\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Provides route responses for the Example module.
 */
class Planning extends ControllerBase {

  /**
   * Returns a simple page.
   *
   * @return array
   *   A simple renderable array.
   */
  public function page($id_disp,$co_anmo,$filter) {
    $resp_filter = '';
    $co_offreur = 'All';
    $date = date("Y-m-d");
    if ($filter == "username") {
      // Load the current user
      $user = \Drupal\user\Entity\User::load(\Drupal::currentUser()->id());
      // retrieve field data from that user
      $resp_filter = $user->get('field_name')->value;
    };
    if ($filter == "BD") {
      $co_offreur = 1;
    };
    // query parameters
    $routeparameters = array(
      'date_ts' => $date,
      'co_offreur' => $co_offreur,
      'resp_filter' => $resp_filter);
    return $this->redirect('view.planning.page_1',$routeparameters);
  }

}

