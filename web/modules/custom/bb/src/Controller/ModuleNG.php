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

  public function changecolor($co_degre, $co_modu, $color, $id_disp, $co_anmo, $resp_filter,$id_disp_1) {
    $resp_filter = ($resp_filter=='NaN')? '':$resp_filter;
    $entry = array('color' => $color);
    $condition = array('co_modu' => $co_modu, 'co_degre' => $co_degre);
    $row = BbCrudController::load('gbb_gmodu_plus', $condition);
    if (!empty($row)) {
      $DBWriteStatus = BbCrudController::update('gbb_gmodu_plus', $entry, $condition);
    } else {
      $DBWriteStatus = BbCrudController::create('gbb_gmodu_plus', array_merge($condition,$entry));
    }
    $routeparameters = array( 'id_disp' => $id_disp, 'co_anmo' => $co_anmo, 'resp_filter' => $resp_filter, 'id_disp_1' => $id_disp_1);
    return $this->redirect('view.liste_modules.page_1',$routeparameters,array( 'fragment' => $co_modu));
  }

  public function rpedacolor($co_degre, $co_modu, $color, $id_disp, $co_anmo, $resp_filter,$id_disp_1) {
    $resp_filter = ($resp_filter=='NaN')? '':$resp_filter;
    $entry = array('rpedacolor' => $color);
    $condition = array('co_modu' => $co_modu, 'co_degre' => $co_degre);
    $row = BbCrudController::load('gbb_gmodu_plus', $condition);
    if (!empty($row)) {
      $DBWriteStatus = BbCrudController::update('gbb_gmodu_plus', $entry, $condition);
    } else {
      $DBWriteStatus = BbCrudController::create('gbb_gmodu_plus', array_merge($condition,$entry));
    }
    $routeparameters = array( 'id_disp' => $id_disp, 'co_anmo' => $co_anmo, 'resp_filter' => $resp_filter, 'id_disp_1' => $id_disp_1);
    return $this->redirect('view.liste_modules.page_1',$routeparameters,array( 'fragment' => $co_modu));
  }

  public function rorgacolor($co_degre, $co_modu, $color, $id_disp, $co_anmo, $resp_filter,$id_disp_1) {
    $resp_filter = ($resp_filter=='NaN')? '':$resp_filter;
    $entry = array('rorgacolor' => $color);
    $condition = array('co_modu' => $co_modu, 'co_degre' => $co_degre);
    $row = BbCrudController::load('gbb_gmodu_plus', $condition);
    if (!empty($row)) {
      $DBWriteStatus = BbCrudController::update('gbb_gmodu_plus', $entry, $condition);
    } else {
      $DBWriteStatus = BbCrudController::create('gbb_gmodu_plus', array_merge($condition,$entry));
    }
    $routeparameters = array( 'id_disp' => $id_disp, 'co_anmo' => $co_anmo, 'resp_filter' => $resp_filter, 'id_disp_1' => $id_disp_1);
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
      case '6': // DE orange
        $entry = array('en_attente' => 0, 'session_alert' => 0, 'convoc_sent' => 4, 'status' => 6, 'date_modif' => date("Y-m-d H:i:s"));
        break;
      case '7': // en traitement
        $entry = array('en_attente' => 0, 'session_alert' => 0, 'convoc_sent' => 4, 'status' => 7, 'date_modif' => date("Y-m-d H:i:s"));
        break;
      case '8': // DE vert
        $entry = array('en_attente' => 0, 'session_alert' => 0, 'convoc_sent' => 4, 'status' => 8, 'date_modif' => date("Y-m-d H:i:s"));
        break;
      case '9': // DE rouge
        $entry = array('en_attente' => 0, 'session_alert' => 0, 'convoc_sent' => 4, 'status' => 9, 'date_modif' => date("Y-m-d H:i:s"));
        break;
      case '10': // DE orange Drapeau
        $entry = array('en_attente' => 0, 'session_alert' => 0, 'convoc_sent' => 4, 'status' => 10, 'date_modif' => date("Y-m-d H:i:s"));
        break;
      case '11': // Inspec noir
        $entry = array('en_attente' => 0, 'session_alert' => 0, 'convoc_sent' => 4, 'status' => 11, 'date_modif' => date("Y-m-d H:i:s"));
        break;
      case '12': // Inspec red
        $entry = array('en_attente' => 0, 'session_alert' => 0, 'convoc_sent' => 4, 'status' => 12, 'date_modif' => date("Y-m-d H:i:s"));
        break;
      case '13': // Annule session red
        $entry = array('en_attente' => 0, 'session_alert' => 0, 'convoc_sent' => 4, 'status' => 13, 'date_modif' => date("Y-m-d H:i:s"));
        break;
      case '14': // Annule session green
        $entry = array('en_attente' => 0, 'session_alert' => 0, 'convoc_sent' => 4, 'status' => 14, 'date_modif' => date("Y-m-d H:i:s"));
        break;
    }
    $account = \Drupal::currentUser();
    $entry['uid'] = $account->id();
    $condition = array('sess_id' => $sessid);
    $DBWriteStatus = BbCrudController::update('gbb_session', $entry, $condition);
    $routeparameters = array( 'co_degre' => $co_degre, 'co_modu'  => $co_modu,);
    return $this->redirect('bb.moduleng',$routeparameters,array( 'fragment' => 'sessions'));
  }

  public function session_ficand_on($co_degre, $co_modu, $sessid) {
    $account = \Drupal::currentUser();
    $entry = array('ficand' => 1, 'uid' => $account->id());
    $condition = array('sess_id' => $sessid);
    $DBWriteStatus = BbCrudController::update('gbb_session', $entry, $condition);
    $routeparameters = array( 'co_degre' => $co_degre, 'co_modu'  => $co_modu,);
    return $this->redirect('bb.moduleng',$routeparameters,array( 'fragment' => 'sessions'));
  }

  public function session_ficand_off($co_degre, $co_modu, $sessid) {
    $account = \Drupal::currentUser();
    $entry = array('ficand' => 0, 'uid' => $account->id());
    $condition = array('sess_id' => $sessid);
    $DBWriteStatus = BbCrudController::update('gbb_session', $entry, $condition);
    $routeparameters = array( 'co_degre' => $co_degre, 'co_modu'  => $co_modu,);
    return $this->redirect('bb.moduleng',$routeparameters,array( 'fragment' => 'sessions'));
  }

  public function session_ficand_done($co_degre, $co_modu, $sessid) {
    $account = \Drupal::currentUser();
    $entry = array('ficand' => 2, 'uid' => $account->id());
    $condition = array('sess_id' => $sessid);
    $DBWriteStatus = BbCrudController::update('gbb_session', $entry, $condition);
    $routeparameters = array( 'co_degre' => $co_degre, 'co_modu'  => $co_modu,);
    return $this->redirect('bb.moduleng',$routeparameters,array( 'fragment' => 'sessions'));
  }

  public function session_le_on($co_degre, $co_modu, $sessid) {
    $account = \Drupal::currentUser();
    $entry = array('LE_etat' => 1, 'uid' => $account->id());
    $condition = array('sess_id' => $sessid);
    $DBWriteStatus = BbCrudController::update('gbb_session', $entry, $condition);
    $routeparameters = array( 'co_degre' => $co_degre, 'co_modu'  => $co_modu,);
    return $this->redirect('bb.moduleng',$routeparameters,array( 'fragment' => 'sessions'));
  }

  public function session_le_off($co_degre, $co_modu, $sessid) {
    $account = \Drupal::currentUser();
    $entry = array('LE_etat' => 0, 'uid' => $account->id());
    $condition = array('sess_id' => $sessid);
    $DBWriteStatus = BbCrudController::update('gbb_session', $entry, $condition);
    $routeparameters = array( 'co_degre' => $co_degre, 'co_modu'  => $co_modu,);
    return $this->redirect('bb.moduleng',$routeparameters,array( 'fragment' => 'sessions'));
  }

  public function session_paiement_on($co_degre, $co_modu, $sessid) {
    $account = \Drupal::currentUser();
    $entry = array('paiement_etat' => 1, 'uid' => $account->id());
    $condition = array('sess_id' => $sessid);
    $DBWriteStatus = BbCrudController::update('gbb_session', $entry, $condition);
    $routeparameters = array( 'co_degre' => $co_degre, 'co_modu'  => $co_modu,);
    return $this->redirect('bb.moduleng',$routeparameters,array( 'fragment' => 'sessions'));
  }

  public function session_paiement_off($co_degre, $co_modu, $sessid) {
    $account = \Drupal::currentUser();
    $entry = array('paiement_etat' => 0, 'uid' => $account->id());
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

    $content['journalinspec'] =
      \Drupal::formBuilder()->getForm('Drupal\bb\Form\JournalInspecForm', $co_degre, $co_modu);
    $content['journal'] =
      \Drupal::formBuilder()->getForm('Drupal\bb\Form\JournalForm', $co_degre, $co_modu);
    $content['prioritaire'] =
      \Drupal::formBuilder()->getForm('Drupal\bb\Form\PrioritaireForm', $co_degre, $co_modu);
    $content['reforme'] =
      \Drupal::formBuilder()->getForm('Drupal\bb\Form\ReformeForm', $co_degre, $co_modu);
    $content['report'] =
      \Drupal::formBuilder()->getForm('Drupal\bb\Form\ReportForm', $co_degre, $co_modu);
    $content['cfile'] =
      \Drupal::formBuilder()->getForm('Drupal\bb\Form\CfileForm', $co_degre, $co_modu);
    $content['afile'] =
      \Drupal::formBuilder()->getForm('Drupal\bb\Form\AfileForm', $co_degre, $co_modu);
    $content['ifile'] =
      \Drupal::formBuilder()->getForm('Drupal\bb\Form\IfileForm', $co_degre, $co_modu);
    $content['infospasconvoc'] =
      \Drupal::formBuilder()->getForm('Drupal\bb\Form\InfosPasConvocForm', $co_degre, $co_modu);
    $content['infossurconvoc'] =
      \Drupal::formBuilder()->getForm('Drupal\bb\Form\InfosSurConvocForm', $co_degre, $co_modu);
    $content['LEinfo'] =
      \Drupal::formBuilder()->getForm('Drupal\bb\Form\LEinfoForm', $co_degre, $co_modu);
    $content['LEetat'] =
      \Drupal::formBuilder()->getForm('Drupal\bb\Form\LEetatForm', $co_degre, $co_modu);
    $content['DSFinfo'] =
      \Drupal::formBuilder()->getForm('Drupal\bb\Form\DSFinfoForm', $co_degre, $co_modu);
    $content['DSFetat'] =
      \Drupal::formBuilder()->getForm('Drupal\bb\Form\DSFetatForm', $co_degre, $co_modu);
    $content['DAdateDepot'] =
      \Drupal::formBuilder()->getForm('Drupal\bb\Form\DAdateDepotForm', $co_degre, $co_modu);

    $condition = array('co_modu' => $co_modu, 'co_degre' => $co_degre);
    $row = BbCrudController::load('gbb_gmodu_plus', $condition);
    foreach ($row as $el) {
      $content['isInspecOpen']=(strlen($el->organisation_inspec) >0)? 1 : 0;
    }

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
    if (is_object($the_user)) {
      $thename = $the_user->get('name')->value;
    } else {
      $thename = 'NaN';
    }
    $content['last_user'] = [ '#markup' => $thename ];

    // Disable page caching on the current request.
    \Drupal::service('page_cache_kill_switch')->trigger();

    // dpm($content);
    return $content;
  }

}
