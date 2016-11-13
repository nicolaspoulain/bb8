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

  public function sessionplay($co_degre, $co_modu, $sessid) {
    $entry = array('en_attente' => 0, 'session_alert' => 0, 'convoc_sent' => 0, 'status' => 0);
    $condition = array('sess_id' => $sessid);
    $DBWriteStatus = BbCrudController::update('gbb_session', $entry, $condition);
    $routeparameters = array( 'co_degre' => $co_degre, 'co_modu'  => $co_modu,);
    return $this->redirect('bb.moduleng',$routeparameters,array( 'fragment' => 'sessions'));
  }
  public function sessionsent($co_degre, $co_modu, $sessid) {
    $entry = array('en_attente' => 0, 'session_alert' => 0, 'convoc_sent' => 1, 'status' => 3);
    $condition = array('sess_id' => $sessid);
    $DBWriteStatus = BbCrudController::update('gbb_session', $entry, $condition);
    $routeparameters = array( 'co_degre' => $co_degre, 'co_modu'  => $co_modu,);
    return $this->redirect('bb.moduleng',$routeparameters,array( 'fragment' => 'sessions'));
  }
  public function sessionalert($co_degre, $co_modu, $sessid) {
    $entry = array('en_attente' => 0, 'session_alert' => 1, 'convoc_sent' => 0, 'status' => 2);
    $condition = array('sess_id' => $sessid);
    $DBWriteStatus = BbCrudController::update('gbb_session', $entry, $condition);
    $routeparameters = array( 'co_degre' => $co_degre, 'co_modu'  => $co_modu,);
    return $this->redirect('bb.moduleng',$routeparameters,array( 'fragment' => 'sessions'));
  }

  public function sessionpause($co_degre, $co_modu, $sessid) {
    $entry = array('en_attente' => 1, 'session_alert' => 1, 'convoc_sent' => 0, 'status' => 1);
    $condition = array('sess_id' => $sessid);
    $DBWriteStatus = BbCrudController::update('gbb_session', $entry, $condition);
    $routeparameters = array( 'co_degre' => $co_degre, 'co_modu'  => $co_modu,);
    return $this->redirect('bb.moduleng',$routeparameters,array( 'fragment' => 'sessions'));
  }

  public function sessiondelete($co_degre, $co_modu, $sessid) {
    // delete session
    $entry = array('sess_id' => $sessid);
    $DBWriteStatus = BbCrudController::delete('gbb_session', $entry);

    drupal_set_message('Session supprimée');
    $routeparameters = array(
      'co_degre' => $co_degre,
      'co_modu'  => $co_modu,
    );
    return $this->redirect('bb.moduleng',$routeparameters,array( 'fragment' => 'sessions'));
  }

  public function sessionduplicate($co_degre, $co_modu, $sessid) {
    // load session informations
    $entry = array('sess_id' => $sessid);
    $session = BbCrudController::load('gbb_session', $entry);
    foreach ($session['0'] as $field=>$val) {
      $tab[$field] = $val;
    }
    // kill unwanted informations
    unset($tab['sess_id']);
    unset($tab['denom_comp'], $tab['sigle']);
    unset($tab['nomu'], $tab['prenom']);

    // insert new row
    $DBWriteStatus = BbCrudController::create('gbb_session', $tab);

    $routeparameters = array(
      'co_degre' => $co_degre,
      'co_modu'  => $co_modu,
    );
    return $this->redirect('bb.moduleng',$routeparameters,array( 'fragment' => 'sessions'));
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
    $content['cfile'] =
      \Drupal::formBuilder()->getForm('Drupal\bb\Form\CfileForm');
    $content['afile'] =
      \Drupal::formBuilder()->getForm('Drupal\bb\Form\AfileForm');
    $content['infospasconvoc'] =
      \Drupal::formBuilder()->getForm('Drupal\bb\Form\InfosPasConvocForm');
    $content['infossurconvoc'] =
      \Drupal::formBuilder()->getForm('Drupal\bb\Form\InfosSurConvocForm');

    // Disable page caching on the current request.
    \Drupal::service('page_cache_kill_switch')->trigger();

    // dpm($content);
    return $content;
  }

}
