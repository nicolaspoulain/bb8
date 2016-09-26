<?php
/**
 * @file
 * Contains Drupal\bb\Controller\ModuleNG.
 */

namespace Drupal\bb\Controller;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Url;
use Drupal\Core\Link;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Simple ModuleNG controller for drupal.
 */
class ModuleNG extends ControllerBase {

  public function sessiondelete($co_degre, $co_modu, $sessid) {
    // delete session
    $entry = array('sess_id' => $sessid);
    $DBWriteStatus = SessionCrudController::delete($entry);

    drupal_set_message('Session supprimée');
    $routeparameters = array(
      'co_degre' => $co_degre,
      'co_modu'  => $co_modu,
    );
    return $this->redirect('bb.moduleng',$routeparameters);
  }

  public function sessionduplicate($co_degre, $co_modu, $sessid) {
    // load session informations
    $entry = array('sess_id' => $sessid);
    $session = SessionCrudController::load($entry);
    foreach ($session['0'] as $field=>$val) {
      $tab[$field] = $val;
    }
    // kill unwanted informations
    unset($tab['sess_id']);
    unset($tab['denom_comp'], $tab['sigle']);
    unset($tab['nomu'], $tab['prenom']);

    // insert new row
    $DBWriteStatus = SessionCrudController::insert($tab);

    $routeparameters = array(
      'co_degre' => $co_degre,
      'co_modu'  => $co_modu,
    );
    return $this->redirect('bb.moduleng',$routeparameters);
  }

  public function journal() {
    // These libraries are required to facilitate the ajax modal form demo.
    $content['#attached']['library'][] = 'core/drupal.ajax';
    $content['#attached']['library'][] = 'core/drupal.dialog';
    $content['#attached']['library'][] = 'core/drupal.dialog.ajax';

    $content['intro'] = [ '#markup' => 'src/Controller/ModuleNG.php' ];
    // See bb.module function bbtheme
    $content['#theme'] = 'moduleng';
    // moduleng-layout/html.twig

    // Get form

    // Disable page caching on the current request.
    \Drupal::service('page_cache_kill_switch')->trigger();

    // dpm($content);
    return $content;
  }
  public function forms() {
    // These libraries are required to facilitate the ajax modal form demo.
    $content['#attached']['library'][] = 'core/drupal.ajax';
    $content['#attached']['library'][] = 'core/drupal.dialog';
    $content['#attached']['library'][] = 'core/drupal.dialog.ajax';

    $content['intro'] = [ '#markup' => 'src/Controller/ModuleNG.php' ];
    // See bb.module function bbtheme
    $content['#theme'] = 'moduleng';
    // moduleng-layout/html.twig

    // devenu inutile avec les sessions affichées en views
    // $content['sessions'] =
      // \Drupal::formBuilder()->getForm('Drupal\bb\Form\SessionsTableForm');
    $content['journal'] =
      \Drupal::formBuilder()->getForm('Drupal\bb\Form\JournalForm');

    // Disable page caching on the current request.
    \Drupal::service('page_cache_kill_switch')->trigger();

    // dpm($content);
    return $content;
  }

}
