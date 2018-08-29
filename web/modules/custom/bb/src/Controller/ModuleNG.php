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

  public function sessionchangestatus($co_degre, $co_modu, $sessid, $status) {
    switch ($status) {
      case '0': // Play
        $entry = array('en_attente' => 0, 'session_alert' => 0, 'convoc_sent' => 0, 'status' => 0, 'date_modif' => date("Y-m-d H:i:s"));
        break;
      case '1': // En attente
        $entry = array('en_attente' => 1, 'session_alert' => 0, 'convoc_sent' => 0, 'status' => 1, 'date_modif' => date("Y-m-d H:i:s"));
        break;
      case '2': // Alerte
        $entry = array('en_attente' => 0, 'session_alert' => 1, 'convoc_sent' => 0, 'status' => 2, 'date_modif' => date("Y-m-d H:i:s"));
        break;
      case '3': // convoc sent
        $entry = array('en_attente' => 0, 'session_alert' => 0, 'convoc_sent' => 1, 'status' => 3, 'date_modif' => date("Y-m-d H:i:s"));
        break;
      case '4': // convoc formateur
        $entry = array('en_attente' => 0, 'session_alert' => 0, 'convoc_sent' => 2, 'status' => 4, 'date_modif' => date("Y-m-d H:i:s"));
        break;
      case '5': // convoc stagiaires
        $entry = array('en_attente' => 0, 'session_alert' => 0, 'convoc_sent' => 3, 'status' => 5, 'date_modif' => date("Y-m-d H:i:s"));
        break;
      case '6': // transmis DE
        $entry = array('en_attente' => 0, 'session_alert' => 0, 'convoc_sent' => 4, 'status' => 6, 'date_modif' => date("Y-m-d H:i:s"));
        break;
      case '7': // en traitement
        $entry = array('en_attente' => 0, 'session_alert' => 0, 'convoc_sent' => 4, 'status' => 7, 'date_modif' => date("Y-m-d H:i:s"));
        break;
    }
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

    $condition = array('co_modu' => $co_modu, 'co_degre' => $co_degre);
    $row = BbCrudController::load('gbb_session', $condition);
    $last_mod = "1971-01-01 01:01:01";
    $last_user = "0";
    foreach ($row as $el) {
      if (strtotime($last_mod) < strtotime($el->date_modif)) {
        $last_mod = $el->date_modif;
        $last_user = $el->uid;
      }
    }
    setlocale(LC_TIME, 'fr_FR.UTF-8', 'fra');
    $last_mod = strftime('%A %e %B %Y à %T',strtotime($last_mod));
    $the_user = user_load($last_user);
    $content['last_mod'] = [ '#markup' => $last_mod ];
    // $content['last_user'] = [ '#markup' => $the_user->get('name')->value ];
    // $content['last_user'] = [ '#markup' => $the_user->id() ];
    $content['last_user'] = [ '#markup' => 'NaN' ];

    // Disable page caching on the current request.
    \Drupal::service('page_cache_kill_switch')->trigger();

    // dpm($content);
    return $content;
  }

}
