<?php

namespace Drupal\bb\Controller;

use Drupal\Core\Controller\ControllerInterface;
use Drupal\Core\Controller\ControllerBase;

class ModuleController extends ControllerBase {

  /**
   * This will return the output of the foobar page.
   */
  public function foobarPage() {
    $crud = new SessionCrudController;

    foreach ($entries = $crud->load() as $entry) {
      // dpm($entry);

      $form[$entry->sess_id]['date'] =
        \Drupal::formBuilder()->getForm('Drupal\bb\Form\SessionDateForm',
          $entry->sess_id, $entry->date );

      $form[$entry->sess_id]['horaires'] =
        \Drupal::formBuilder()->getForm('Drupal\bb\Form\SessionHorairesForm',
          $entry->sess_id, $entry->horaires );
    }
    return $form;
  }

}
