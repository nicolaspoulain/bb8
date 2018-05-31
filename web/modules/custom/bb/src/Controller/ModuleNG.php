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

  public function changecolor($co_degre, $co_modu, $color, $id_disp, $co_anmo, $resp_filter) {
    $entry = array('color' => $color);
    $condition = array('co_modu' => $co_modu, 'co_degre' => $co_degre);
    $row = BbCrudController::load('gbb_gmodu_plus', $condition);
    if (!empty($row)) {
      $DBWriteStatus = BbCrudController::update('gbb_gmodu_plus', $entry, $condition);
    } else {
      $DBWriteStatus = BbCrudController::create('gbb_gmodu_plus', array_merge($condition,$entry));
    }
    $routeparameters = array( 'id_disp' => $id_disp, 'co_anmo' => $co_anmo, 'resp_filter' => $resp_filter);
    return $this->redirect('view.liste_modules.page_1',$routeparameters,array( 'fragment' => $co_modu));
  }

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
  public function sessionsentformateur($co_degre, $co_modu, $sessid) {
    $entry = array('en_attente' => 0, 'session_alert' => 0, 'convoc_sent' => 2, 'status' => 4);
    $condition = array('sess_id' => $sessid);
    $DBWriteStatus = BbCrudController::update('gbb_session', $entry, $condition);
    $routeparameters = array( 'co_degre' => $co_degre, 'co_modu'  => $co_modu,);
    return $this->redirect('bb.moduleng',$routeparameters,array( 'fragment' => 'sessions'));
  }
  public function sessionsentstagiaires($co_degre, $co_modu, $sessid) {
    $entry = array('en_attente' => 0, 'session_alert' => 0, 'convoc_sent' => 3, 'status' => 5);
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

  public function session_ficand_on($co_degre, $co_modu, $sessid) {
    $entry = array('ficand' => 1);
    $condition = array('sess_id' => $sessid);
    $DBWriteStatus = BbCrudController::update('gbb_session', $entry, $condition);
    $routeparameters = array( 'co_degre' => $co_degre, 'co_modu'  => $co_modu,);
    return $this->redirect('bb.moduleng',$routeparameters,array( 'fragment' => 'sessions'));
  }

  public function session_ficand_off($co_degre, $co_modu, $sessid) {
    $entry = array('ficand' => 0);
    $condition = array('sess_id' => $sessid);
    $DBWriteStatus = BbCrudController::update('gbb_session', $entry, $condition);
    $routeparameters = array( 'co_degre' => $co_degre, 'co_modu'  => $co_modu,);
    return $this->redirect('bb.moduleng',$routeparameters,array( 'fragment' => 'sessions'));
  }

  public function session_le_on($co_degre, $co_modu, $sessid) {
    $entry = array('LE_etat' => 1);
    $condition = array('sess_id' => $sessid);
    $DBWriteStatus = BbCrudController::update('gbb_session', $entry, $condition);
    $routeparameters = array( 'co_degre' => $co_degre, 'co_modu'  => $co_modu,);
    return $this->redirect('bb.moduleng',$routeparameters,array( 'fragment' => 'sessions'));
  }

  public function session_le_off($co_degre, $co_modu, $sessid) {
    $entry = array('LE_etat' => 0);
    $condition = array('sess_id' => $sessid);
    $DBWriteStatus = BbCrudController::update('gbb_session', $entry, $condition);
    $routeparameters = array( 'co_degre' => $co_degre, 'co_modu'  => $co_modu,);
    return $this->redirect('bb.moduleng',$routeparameters,array( 'fragment' => 'sessions'));
  }

  public function session_paiement_on($co_degre, $co_modu, $sessid) {
    $entry = array('paiement_etat' => 1);
    $condition = array('sess_id' => $sessid);
    $DBWriteStatus = BbCrudController::update('gbb_session', $entry, $condition);
    $routeparameters = array( 'co_degre' => $co_degre, 'co_modu'  => $co_modu,);
    return $this->redirect('bb.moduleng',$routeparameters,array( 'fragment' => 'sessions'));
  }

  public function session_paiement_off($co_degre, $co_modu, $sessid) {
    $entry = array('paiement_etat' => 0);
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

  public function journal() {
    // These libraries are required to facilitate the ajax modal form demo.
    $content['#attached']['library'][] = 'core/drupal.ajax';
    $content['#attached']['library'][] = 'core/drupal.dialog';
    $content['#attached']['library'][] = 'core/drupal.dialog.ajax';

    $content['intro'] = [ '#markup' => 'src/Controller/ModuleNG.php' ];
    // See bb.module function bbtheme
    $content['#theme'] = 'moduleng';
    // moduleng-layout/html.twig

    // dpm($content);
    return $content;
  }
  public function forms($co_degre, $co_modu) {
    // These libraries are required to facilitate the ajax modal form demo.
    $content['#attached']['library'][] = 'core/drupal.ajax';
    $content['#attached']['library'][] = 'core/drupal.dialog';
    $content['#attached']['library'][] = 'core/drupal.dialog.ajax';

    $content['intro'] = [ '#markup' => 'src/Controller/ModuleNG.php' ];
    // See bb.module function bbtheme
    $content['#theme'] = 'moduleng';
    // moduleng-layout/html.twig

    $content['journal'] =
      \Drupal::formBuilder()->getForm('Drupal\bb\Form\JournalForm', $co_degre, $co_modu);
    $content['cfile'] =
      \Drupal::formBuilder()->getForm('Drupal\bb\Form\CfileForm', $co_degre, $co_modu);
    $content['afile'] =
      \Drupal::formBuilder()->getForm('Drupal\bb\Form\AfileForm', $co_degre, $co_modu);
    $content['infospasconvoc'] =
      \Drupal::formBuilder()->getForm('Drupal\bb\Form\InfosPasConvocForm', $co_degre, $co_modu);
    $content['infossurconvoc'] =
      \Drupal::formBuilder()->getForm('Drupal\bb\Form\InfosSurConvocForm', $co_degre, $co_modu);

    // Disable page caching on the current request.
    \Drupal::service('page_cache_kill_switch')->trigger();

    // dpm($content);
    return $content;
  }

}
