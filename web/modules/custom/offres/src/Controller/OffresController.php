<?php

namespace Drupal\offres\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\bb\Controller\BbCrudController;

/**
 * Controller for DBTNG Example.
 */
class OffresController extends ControllerBase {

  /**
   * Render a list of entries in the database.
   */
  public function list() {
    $content = [];

    $content['message'] = [
      '#markup' => $this->t('Generate a list of all entries in the database. There is no filter in the query.'),
    ];

    $headers = array(
      'nomu' => t('Interlocuteur dispo'),
      'co_tpla' => t('Type de Plan'),
      'co_orie' => t('Code Orientation'),
      'co_offreur' => t('Code offr'),
      array('data' => t('Position'), 'class' => 'jaune'),
      'no_offre' => t('No Offre/ Code Module'),
      'libl' => t('Titre'),
      'nomu2' => t('Resp. péda.'),
      'co_moda' => t('Hybride'),
      array('data' => t('AP/Pub.Dés'), 'class' => 'jaune'),
      array('data' => t('Offreur'), 'class' => 'jaune'),
      array('data' => t('Interdisciplinaire'), 'class' => 'jaune'),
      array('data' => t('Nouv. offreur'), 'class' => 'jaune'),
      array('data' => t('Priorité Nat.'), 'class' => 'jaune'),
      array('data' => t('Priorité Aca.'), 'class' => 'jaune'),
      // array('data' => t('Offre nouvelle'), 'class' => 'jaune'),
      // array('data' => t('FOAD'), 'class' => 'jaune'),
      // array('data' => t('Pub. Dés.'), 'class' => 'jaune'),
      // array('data' => t('Anim. Péda.'), 'class' => 'jaune'),
      array('data' => t('Nbre HP'), 'class' => 'jaune'),
      array('data' => t('Nbre vac.'), 'class' => 'jaune'),
      array('data' => t('Taux vac.'), 'class' => 'jaune'),
      // array('data' => t('taux en € Vac'), 'class' => 'jaune'),
      array('data' => t('HT2'), 'class' => 'jaune'),
      #array('data' => t('Hors CDC'), 'class' => 'jaune'),
      'cout prest' => t('Coût prest'),
      'cout fonc' => t('Coût fonc'),
      'cout excep' => t('Coût excep'),
      'nb_groupe' => t('Nbre groupe'),
      'nb_eff_groupe' => t('Effectif groupe'),
      'duree_prev' => t('Duree prév. (h)'),
      array('data' => t('&nbsp;&nbsp;&nbsp;Observations&nbsp;&nbsp;&nbsp;'), 'class' => 'jaune'),
    );

    // switch database (cf settings.php)
    \Drupal\Core\Database\Database::setActiveConnection('external');
    // Build query
    $count = 20;

    $query = db_select('gbb_gdiof', 'd');
    $query ->leftjoin('gbb_gmoof', 'm',
                      'd.co_offre = m.co_offre');
    $query ->leftjoin('gbb_gdiof_dafor', 'dd',
                      'm.co_omodu = dd.co_omodu');
    $query ->leftjoin('gbb_gresp', 'r',
                      'd.co_resp = r.co_resp AND r.co_degre = 2');
    $query ->leftjoin('gbb_gresp', 'r2',
                      'm.co_resp = r2.co_resp AND r2.co_degre = 2');
    $query ->condition('d.no_offre', '20180000', '>');
    $query ->fields('m', array(
      'libl', 'co_omodu', 'nb_groupe',
      'cout_p_excep', 'cout_p_prest', 'cout_p_fonc',
            'duree_prev','nb_eff_groupe', 'co_moda'));
    $query ->fields('d', array(
      'no_offre', 'co_tpla', 'co_orie','co_offreur',
    ));
    $query ->fields('dd', array(
      'nb_hp','nb_vac','taux','ht2','iufm',
      'nouv_offreur','prio_nat','prio_aca',
      'offre_new', 'pub_des','anim_peda',
      'foad','comment','position',
      'offre_cat','interdisc',
    ));
    $query ->fields('r', array('nomu'));
    $query ->addField('r2', 'nomu', 'nomu2');
    $query ->distinct();
    $pager = $query->extend('Drupal\Core\Database\Query\PagerSelectExtender')->limit(10);

    // $rows = [];
    // foreach ($result = $pager->execute()->fetchAll() as $entry) {
      // // Sanitize each entry.
      // $rows[] = array_map('Drupal\Component\Utility\SafeMarkup::checkPlain', (array) $entry);
    // }
  $rows = array();
  foreach ($result = $pager->execute()->fetchAll() as $r) {
    // $hp = render(drupal_get_form('gbb_offres_nb_hp_form',
                                // $r->nb_hp, $r->co_omodu)) ;
    // $vac = render(drupal_get_form('gbb_offres_nb_vac_form',
                                // $r->nb_vac, $r->co_omodu)) ;
    // $taux = render(drupal_get_form('gbb_offres_taux_form',
                                // $r->taux, $r->co_omodu)) ;
    // $ht2 = render(drupal_get_form('gbb_offres_ht2_form',
                                // $r->ht2, $r->co_omodu)) ;
    // $prio_nat = render(drupal_get_form('gbb_offres_prio_nat_form',
                                // $r->prio_nat, $r->co_omodu)) ;
    // $prio_aca = render(drupal_get_form('gbb_offres_prio_aca_form',
                                // $r->prio_aca, $r->co_omodu)) ;
    // $offre_new = render(drupal_get_form('gbb_offres_offre_new_form',
                                // $r->offre_new, $r->co_omodu)) ;
    // $comment = render(drupal_get_form('gbb_offres_comment_form',
                                // $r->comment, $r->co_omodu)) ;

    // $position = render(drupal_get_form('gbb_offres_position_form',
                                // $r->position, $r->co_omodu)) ;
    $position = \Drupal::formBuilder()->getForm('Drupal\offres\Form\PositionForm', $r->position, $r->co_omodu);
    // $catOffre = render(drupal_get_form('gbb_offres_categories_form',
                                // $r->offre_cat, $r->co_omodu)) ;
    // $interdisc = render(drupal_get_form('gbb_offres_interdisc_form',
                                // $r->interdisc, $r->co_omodu)) ;
    // $iufm = render(drupal_get_form('gbb_offres_iufm_form',
                                // $r->iufm, $r->co_omodu)) ;
    // $nouv_offreur = render(drupal_get_form('gbb_offres_nouv_offreur_form',
                                // $r->nouv_offreur, $r->co_omodu)) ;
    // $pub_des = render(drupal_get_form('gbb_offres_pub_des_form',
                                // $r->pub_des, $r->co_omodu)) ;
    // $anim_peda = render(drupal_get_form('gbb_offres_anim_peda_form',
                                // $r->anim_peda, $r->co_omodu)) ;
    // $foad= render(drupal_get_form('gbb_offres_foad_form',
                                // $r->foad, $r->co_omodu)) ;

    $rows[] = array(
                array('data' => $r->nomu),
                array('data' => $r->co_tpla),
                array('data' => $r->co_orie),
                array('data' => $r->co_offreur),
                array('data' => $position),
                array('data' => $r->no_offre.' / '.$r->co_omodu),
                array('data' => $r->nomu2),
                array('data' => ($r->co_moda=="S")? "OUI" : '-'),
                // array('data' => $catOffre),
                // array('data' => $iufm),
                // array('data' => $interdisc),
                // array('data' => $nouv_offreur),
                // array('data' => $prio_nat),
                // array('data' => $prio_aca),
                // array('data' => $hp),
                // array('data' => $vac),
                // array('data' => $taux),
                // array('data' => $ht2),
                array('data' => $r->cout_p_prest),
                array('data' => $r->cout_p_fonc),
                array('data' => $r->cout_p_excep),
                array('data' => $r->nb_groupe),
                array('data' => $r->nb_eff_groupe),
                array('data' => $r->duree_prev),
                // array('data' => $comment),
              );
  }

    $content['table'][] = array(
      '#type' => 'table',
      '#header' => $headers,
      '#rows' => $rows,
    );
    $content['table'][] = array(
      '#type' => 'pager',
    );

    // Don't cache this page.
    $content['#cache']['max-age'] = 0;

    return $content;
  }
}


function gbb_offres_nb_hp_form($form, &$form_state, $nb_hp, $co_omodu) {
  $form['f']['co_omodu']  = array('#type' => 'hidden','#value' => $co_omodu );
  $form['f']['nb_hp'] = array(
    '#type' => 'textfield', '#size' => 3,
    '#default_value' => (isset($nb_hp))? (int)$nb_hp: '0',
    '#ajax' => array(
      'callback' => 'gbb_offres_nb_hp_form_submit',
      'progress' => array('type' => 'throbber', 'message' => '')),);
  return $form;
}
function gbb_offres_nb_hp_form_submit($form, &$form_state) {
  $val = is_numeric($form_state['values']['nb_hp'])? $form_state['values']['nb_hp']:0;
  db_merge('gbb_gdiof_dafor')
    ->key(array('co_omodu' => $form_state['values']['co_omodu']))
    ->fields(array('nb_hp'  => $val,
  ))->execute();
}

function gbb_offres_position_form($form, &$form_state, $position, $co_omodu) {
  $form['f']['co_omodu']  = array('#type' => 'hidden','#value' => $co_omodu );
  $form['f']['position'] = array(
    '#type' => 'textfield', '#size' => 4,
    '#default_value' => (isset($position))? (int)$position : '0',
    '#ajax' => array(
      'callback' => 'gbb_offres_position_form_submit',
      'progress' => array('type' => 'throbber', 'message' => '')),);
  return $form;
}
function gbb_offres_position_form_submit($form, &$form_state) {
  $val = is_numeric($form_state['values']['position'])? $form_state['values']['position']:0;
  db_merge('gbb_gdiof_dafor')
    ->key(array('co_omodu' => $form_state['values']['co_omodu']))
    ->fields(array('position'  => $val,
  ))->execute();
}

function gbb_offres_nb_vac_form($form, &$form_state, $nb_vac, $co_omodu) {
  $form['f']['co_omodu']  = array('#type' => 'hidden','#value' => $co_omodu );
  $form['f']['nb_vac'] = array(
    '#type' => 'textfield', '#size' => 3,
    '#default_value' => (isset($nb_vac))? (int)$nb_vac: '0',
    '#ajax' => array(
      'callback' => 'gbb_offres_nb_vac_form_submit',
      'progress' => array('type' => 'throbber', 'message' => '')),);
  return $form;
}
function gbb_offres_nb_vac_form_submit($form, &$form_state) {
  $val = is_numeric($form_state['values']['nb_vac'])? $form_state['values']['nb_vac']:0;
  db_merge('gbb_gdiof_dafor')
    ->key(array('co_omodu' => $form_state['values']['co_omodu']))
    ->fields(array('nb_vac'  => $val,
  ))->execute();
}

function gbb_offres_taux_form($form, &$form_state, $taux, $co_omodu) {
  $form['f']['co_omodu']  = array('#type' => 'hidden','#value' => $co_omodu );
  $form['f']['taux'] = array(
    '#type' => 'select',
    '#options' => array('0'=>'0','27'=>'27','32'=>'32','35'=>'35','42'=>'42','52'=>'52','56'=>'56','59'=>'59','70'=>'70'),
    '#default_value' => (int)$taux,
    '#ajax' => array(
      'callback' => 'gbb_offres_taux_form_submit',
      'progress' => array('type' => 'throbber', 'message' => '')),);
  return $form;
}
function gbb_offres_taux_form_submit($form, &$form_state) {
  db_merge('gbb_gdiof_dafor')
    ->key(array('co_omodu' => $form_state['values']['co_omodu']))
    ->fields(array('taux'  => $form_state['values']['taux'],
  ))->execute();
}

function gbb_offres_ht2_form($form, &$form_state, $ht2, $co_omodu) {
  $form['f']['co_omodu']  = array('#type' => 'hidden','#value' => $co_omodu );
  $form['f']['ht2'] = array(
    '#type' => 'textfield', '#size' => 4,
    '#default_value' => (isset($ht2))? (int)$ht2: '0',
    '#ajax' => array(
      'callback' => 'gbb_offres_ht2_form_submit',
      'progress' => array('type' => 'throbber', 'message' => '')),);
  return $form;
}
function gbb_offres_ht2_form_submit($form, &$form_state) {
  $val = is_numeric($form_state['values']['ht2'])? $form_state['values']['ht2']:0;
  db_merge('gbb_gdiof_dafor')
    ->key(array('co_omodu' => $form_state['values']['co_omodu']))
    ->fields(array('ht2'  => $val,
  ))->execute();
}

function gbb_offres_hors_cdc_form($form, &$form_state, $hors_cdc, $co_omodu) {
  $form['f']['co_omodu']  = array('#type' => 'hidden','#value' => $co_omodu );
  $form['f']['hors_cdc'] = array(
    '#type' => 'checkbox', '#size' => 1,
    '#default_value' => $hors_cdc,
    '#ajax' => array(
      'callback' => 'gbb_offres_hors_cdc_form_submit',
      'progress' => array('type' => 'throbber', 'message' => '')),);
  return $form;
}
function gbb_offres_hors_cdc_form_submit($form, &$form_state) {
  db_merge('gbb_gdiof_dafor')
    ->key(array('co_omodu' => $form_state['values']['co_omodu']))
    ->fields(array('hors_cdc'  => $form_state['values']['hors_cdc'],
  ))->execute();
}

function gbb_offres_prio_nat_form($form, &$form_state, $prio_nat, $co_omodu) {
  $form['f']['co_omodu']  = array('#type' => 'hidden','#value' => $co_omodu );
  $form['f']['prio_nat'] = array(
    '#type' => 'checkbox', '#size' => 1,
    '#default_value' => $prio_nat,
    '#ajax' => array(
      'callback' => 'gbb_offres_prio_nat_form_submit',
      'progress' => array('type' => 'throbber', 'message' => '')),);
  return $form;
}
function gbb_offres_prio_nat_form_submit($form, &$form_state) {
  db_merge('gbb_gdiof_dafor')
    ->key(array('co_omodu' => $form_state['values']['co_omodu']))
    ->fields(array('prio_nat'  => $form_state['values']['prio_nat'],
  ))->execute();
}

function gbb_offres_prio_aca_form($form, &$form_state, $prio_aca, $co_omodu) {
  $form['f']['co_omodu']  = array('#type' => 'hidden','#value' => $co_omodu );
  $form['f']['prio_aca'] = array(
    '#type' => 'select',
    '#options' => array('0'=>'-',
    '11'=>'11',
    '12'=>'12',
    '13'=>'13',
    '21'=>'21',
    '22'=>'22',
    '23'=>'23',
    '24'=>'24',
    '31'=>'31',
    '32'=>'32',
    '33'=>'33',),
    '#default_value' => (is_numeric($prio_aca)? $prio_aca : '0'),
    '#ajax' => array(
      'callback' => 'gbb_offres_prio_aca_form_submit',
      'progress' => array('type' => 'throbber', 'message' => '')),);
  return $form;
}
function gbb_offres_prio_aca_form_submit($form, &$form_state) {
  db_merge('gbb_gdiof_dafor')
    ->key(array('co_omodu' => $form_state['values']['co_omodu']))
    ->fields(array('prio_aca'  => $form_state['values']['prio_aca'],
  ))->execute();
}

function gbb_offres_offre_new_form($form, &$form_state, $offre_new, $co_omodu) {
  $form['f']['co_omodu']  = array('#type' => 'hidden','#value' => $co_omodu );
  $form['f']['offre_new'] = array(
    '#type' => 'checkbox', '#size' => 1,
    '#default_value' => $offre_new,
    '#ajax' => array(
      'callback' => 'gbb_offres_offre_new_form_submit',
      'progress' => array('type' => 'throbber', 'message' => '')),);
  return $form;
}
function gbb_offres_offre_new_form_submit($form, &$form_state) {
  db_merge('gbb_gdiof_dafor')
    ->key(array('co_omodu' => $form_state['values']['co_omodu']))
    ->fields(array('offre_new'  => $form_state['values']['offre_new'],
  ))->execute();
}

function gbb_offres_comment_form($form, &$form_state, $comment, $co_omodu) {
  $form['f']['co_omodu']  = array('#type' => 'hidden','#value' => $co_omodu );
  $form['f']['comment'] = array(
    '#type' => 'textarea',
    '#cols' => 20, '#rows' => 2,
    '#default_value' => $comment,
    '#ajax' => array(
      'callback' => 'gbb_offres_comment_form_submit',
      'progress' => array('type' => 'throbber', 'message' => '')),);
  return $form;
}
function gbb_offres_comment_form_submit($form, &$form_state) {
  db_merge('gbb_gdiof_dafor')
    ->key(array('co_omodu' => $form_state['values']['co_omodu']))
    ->fields(array('comment' => $form_state['values']['comment'],
  ))->execute();
}

function gbb_offres_categories_form($form, &$form_state, $offre_cat, $co_omodu) {
  $form['f']['co_omodu']  = array('#type' => 'hidden','#value' => $co_omodu );
  $form['f']['offre_cat'] = array(
    '#type' => 'checkbox', '#size' => 1,
    // '#type' => 'select',
    // '#options' => array('0'=>'Choisir','AP_PubDes'=>'AnimPéda+PubDés',
                  // 'Recond'=>'Reconduction','OffreNouv'=>'Offre nouvelle'),
    '#default_value' => $offre_cat,
    '#ajax' => array(
      'callback' => 'gbb_offres_categories_form_submit',
      'progress' => array('type' => 'throbber', 'message' => '')),);
  return $form;
}
function gbb_offres_categories_form_submit($formV, &$form_state) {
  db_merge('gbb_gdiof_dafor')
    ->key(array('co_omodu' => $form_state['values']['co_omodu']))
    ->fields(array('offre_cat'  => $form_state['values']['offre_cat'],
  ))->execute();
}
function gbb_offres_interdisc_form($form, &$form_state, $interdisc, $co_omodu) {
  $form['f']['co_omodu']  = array('#type' => 'hidden','#value' => $co_omodu );
  $form['f']['interdisc'] = array(
    #'#type' => 'checkbox', '#size' => 1,
    '#type' => 'select',
    '#options' => array('0'=>'Choisir','sciences'=>'Sciences',
                  'humanites'=>'Humanités','autres'=>'Autres'),
    '#default_value' => $interdisc,
    '#ajax' => array(
      'callback' => 'gbb_offres_interdisc_form_submit',
      'progress' => array('type' => 'throbber', 'message' => '')),);
  return $form;
}
function gbb_offres_interdisc_form_submit($formV, &$form_state) {
  db_merge('gbb_gdiof_dafor')
    ->key(array('co_omodu' => $form_state['values']['co_omodu']))
    ->fields(array('interdisc'  => $form_state['values']['interdisc'],
  ))->execute();
}
function gbb_offres_iufm_form($form, &$form_state, $iufm, $co_omodu) {
  $form['f']['co_omodu']  = array('#type' => 'hidden','#value' => $co_omodu );
  $form['f']['iufm'] = array(
    #'#type' => 'checkbox', '#size' => 1,
    '#type' => 'select',
    '#options' => array('0'=>'Choisir','rectorat'=>'Rectorat','ESPE'=>'ESPE','Paris1'=>'Paris1',
                  'Paris3'=>'Paris3','Paris4'=>'Paris4','Paris5'=>'Paris5',
                  'Paris6'=>'Paris6','Paris7'=>'Paris7','Paris8'=>'Paris8',
                  'Paris10'=>'Paris10','CNAM'=>'CNAM','CANOPE'=>'CANOPE',
                  'Autres.'=>'Autres org'),
    '#default_value' => $iufm,
    '#ajax' => array(
      'callback' => 'gbb_offres_iufm_form_submit',
      'progress' => array('type' => 'throbber', 'message' => '')),);
  return $form;
}
function gbb_offres_iufm_form_submit($formV, &$form_state) {
  db_merge('gbb_gdiof_dafor')
    ->key(array('co_omodu' => $form_state['values']['co_omodu']))
    ->fields(array('iufm'  => $form_state['values']['iufm'],
  ))->execute();
}


function gbb_offres_nouv_offreur_form($form, &$form_state, $nouv_offreur, $co_omodu) {
  $form['f']['co_omodu']  = array('#type' => 'hidden','#value' => $co_omodu );
  $form['f']['nouv_offreur'] = array(
    '#type' => 'checkbox', '#size' => 1,
    '#default_value' => $nouv_offreur,
    '#ajax' => array(
      'callback' => 'gbb_offres_nouv_offreur_form_submit',
      'progress' => array('type' => 'throbber', 'message' => '')),);
  return $form;
}
function gbb_offres_nouv_offreur_form_submit($form, &$form_state) {
  db_merge('gbb_gdiof_dafor')
    ->key(array('co_omodu' => $form_state['values']['co_omodu']))
    ->fields(array('nouv_offreur'  => $form_state['values']['nouv_offreur'],
  ))->execute();
}


function gbb_offres_pub_des_form($form, &$form_state, $pub_des, $co_omodu) {
  $form['f']['co_omodu']  = array('#type' => 'hidden','#value' => $co_omodu );
  $form['f']['pub_des'] = array(
    '#type' => 'checkbox', '#size' => 1,
    '#default_value' => $pub_des,
    '#ajax' => array(
      'callback' => 'gbb_offres_pub_des_form_submit',
      'progress' => array('type' => 'throbber', 'message' => '')),);
  return $form;
}
function gbb_offres_pub_des_form_submit($form, &$form_state) {
  db_merge('gbb_gdiof_dafor')
    ->key(array('co_omodu' => $form_state['values']['co_omodu']))
    ->fields(array('pub_des'  => $form_state['values']['pub_des'],
  ))->execute();
}


function gbb_offres_anim_peda_form($form, &$form_state, $anim_peda, $co_omodu) {
  $form['f']['co_omodu']  = array('#type' => 'hidden','#value' => $co_omodu );
  $form['f']['anim_peda'] = array(
    '#type' => 'checkbox', '#size' => 1,
    '#default_value' => $anim_peda,
    '#ajax' => array(
      'callback' => 'gbb_offres_anim_peda_form_submit',
      'progress' => array('type' => 'throbber', 'message' => '')),);
  return $form;
}
function gbb_offres_anim_peda_form_submit($form, &$form_state) {
  db_merge('gbb_gdiof_dafor')
    ->key(array('co_omodu' => $form_state['values']['co_omodu']))
    ->fields(array('anim_peda'  => $form_state['values']['anim_peda'],
  ))->execute();
}

function gbb_offres_foad_form($form, &$form_state, $foad, $co_omodu) {
  $form['f']['co_omodu']  = array('#type' => 'hidden','#value' => $co_omodu );
  $form['f']['foad'] = array(
    '#type' => 'checkbox', '#size' => 1,
    '#default_value' => $foad,
    '#ajax' => array(
      'callback' => 'gbb_offres_foad_form_submit',
      'progress' => array('type' => 'throbber', 'message' => '')),);
  return $form;
}
function gbb_offres_foad_form_submit($form, &$form_state) {
  db_merge('gbb_gdiof_dafor')
    ->key(array('co_omodu' => $form_state['values']['co_omodu']))
    ->fields(array('foad'  => $form_state['values']['foad'],
  ))->execute();
}



