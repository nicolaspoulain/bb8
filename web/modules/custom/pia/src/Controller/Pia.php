<?php

namespace Drupal\pia\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\bb\Controller\BbCrudController;

class Pia extends ControllerBase {

  public function heures() {
    $query = \Drupal::request()->query->all();
    $co_resp = (array_key_exists('co_resp',$query))? $query['co_resp'] : '';

    $userCurrent = \Drupal::currentUser();
    $user = \Drupal\user\Entity\User::load($userCurrent->id());
    $roles = $user->getRoles();
    dpm($roles);

    return [
      'dech_dafor' => 33,
      'sum_vac' => 22,
      'sum_dec' => $sum_dec,
      'dech_pfa' => $dech_pfa*27,
      'sum_pfa' => $sum_pfa,
    ];
  }
}
