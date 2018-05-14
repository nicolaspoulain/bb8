<?php

namespace Drupal\offres\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\bb\Controller\BbCrudController;

/**
 * Controller
 */
class OffresController extends ControllerBase {

  /**
   * Render a list of entries in the database.
   */
  public function list() {
    $content = [];

    $content['message'] = [
      '#markup' => $this->t('À propos de «Position» : Pour chaque orientation, classer les offres de 1 (indispensable) à 500 (non retenue). Ex-aequo autorisés.'),
    ];

    $headers = array(
    'nomu'         => t('Interloc dispo'),
    'co_tpla'      => t('Type de Plan'),
    'co_orie'      => t('Code orie'),
    'co_offreur'   => t('Code offr'),
    'position'     => array('data' => t('Posit°'), 'class' => 'jaune'),
    'no_offre'     => t('No Offre/ Code Module'),
    'libl'         => t('Titre'),
    'nomu2'        => t('Resp. péda.'),
    'co_moda'      => t('Hybr'),
    'offre_cat'    => array('data' => t('AP ou Pub Dés'), 'class' => 'jaune'),
    'iufm'         => array('data' => t('Offreur'), 'class' => 'jaune'),
    'interdisc'    => array('data' => t('Interdisc'), 'class' => 'jaune'),
    'nouv_offreur' => array('data' => t('Nouv. offreur'), 'class' => 'jaune'),
    'prio_nat'     => array('data' => t('Pr Nat'), 'class' => 'jaune'),
    'prio_aca'     => array('data' => t('Pr Aca'), 'class' => 'jaune'),
    'nb_hp'        => array('data' => t('Nbre HP'), 'class' => 'jaune'),
    'nb_vac'       => array('data' => t('Nbre vac.'), 'class' => 'jaune'),
    'taux'         => array('data' => t('Taux vac.'), 'class' => 'jaune'),
    'ht2'          => array('data' => t('HT2'), 'class' => 'jaune'),
    'cout_p_prest'   => t('Coût prest'),
    'cout_p_fonc'    => t('Coût fonc'),
    'cout_p_excep'   => t('Coût excep'),
    'nb_groupe'    => t('Nbre groupe'),
    'nb_eff_groupe'=> t('Effectif groupe'),
    'duree_prev'   => t('Duree prév. (h)'),
    'comment'      => array('data' => t('&nbsp;&nbsp;&nbsp;Observations&nbsp;&nbsp;&nbsp;'), 'class' => 'jaune'),
    // inutilisés : 'offre_new', 'foad', 'pub_des', 'anim_peda'
    );

    // switch database (cf settings.php)
    \Drupal\Core\Database\Database::setActiveConnection('external');
    // Build query
    $count = 12;

    $query = db_select('gbb_gdiof', 'd');
    $query ->leftjoin('gbb_gmoof', 'm', 'd.co_offre = m.co_offre');
    $query ->leftjoin('gbb_gdiof_dafor', 'dd', 'm.co_omodu = dd.co_omodu');
    $query ->leftjoin('gbb_gresp', 'r', 'd.co_resp = r.co_resp AND r.co_degre = 2');
    $query ->leftjoin('gbb_gresp', 'r2', 'm.co_resp = r2.co_resp AND r2.co_degre = 2');
    $query ->condition('d.no_offre', '20180000', '>');
    $query ->fields('m', array(
      'libl', 'co_omodu', 'nb_groupe', 'duree_prev','nb_eff_groupe', 'co_moda',
      'cout_p_excep', 'cout_p_prest', 'cout_p_fonc',
    ));
    $query ->fields('d', array(
      'no_offre', 'co_tpla', 'co_orie','co_offreur',
    ));
    $query ->fields('dd', array(
      'nb_hp','nb_vac','taux','ht2','iufm', 'nouv_offreur',
      'prio_nat','prio_aca', 'offre_cat','interdisc', 'comment','position',
      // 'offre_new', 'pub_des','anim_peda', 'foad',
    ));
    $query ->fields('r', array('nomu'));
    $query ->addField('r2', 'nomu', 'nomu2');
    $query ->distinct();
    $pager = $query->extend('Drupal\Core\Database\Query\PagerSelectExtender')->limit($count);

  $rows = array();
  foreach ($result = $pager->execute()->fetchAll() as $r) {
    // $comment = render(drupal_get_form('gbb_offres_comment_form', // $r->comment, $r->co_omodu)) ;
    $position = \Drupal::formBuilder()->getForm('Drupal\offres\Form\PositionForm', $r->position, $r->co_omodu);
    $offre_cat = \Drupal::formBuilder()->getForm('Drupal\offres\Form\OffreCatForm', $r->offre_cat, $r->co_omodu);
    $iufm = \Drupal::formBuilder()->getForm('Drupal\offres\Form\IufmForm', $r->iufm, $r->co_omodu);
    $interdisc = \Drupal::formBuilder()->getForm('Drupal\offres\Form\InterdiscForm', $r->interdisc, $r->co_omodu);
    $nouv_offreur = \Drupal::formBuilder()->getForm('Drupal\offres\Form\NouvOffreurForm', $r->nouv_offreur, $r->co_omodu);
    $prio_nat = \Drupal::formBuilder()->getForm('Drupal\offres\Form\PrioNatForm', $r->prio_nat, $r->co_omodu);
    $prio_aca = \Drupal::formBuilder()->getForm('Drupal\offres\Form\PrioAcaForm', $r->prio_aca, $r->co_omodu);
    $nb_hp = \Drupal::formBuilder()->getForm('Drupal\offres\Form\NbHpForm', $r->nb_hp, $r->co_omodu);
    $nb_vac = \Drupal::formBuilder()->getForm('Drupal\offres\Form\NbVacForm', $r->nb_vac, $r->co_omodu);
    $taux = \Drupal::formBuilder()->getForm('Drupal\offres\Form\TauxForm', $r->taux, $r->co_omodu);
    $ht2 = \Drupal::formBuilder()->getForm('Drupal\offres\Form\Ht2Form', $r->ht2, $r->co_omodu);
    $comment = \Drupal::formBuilder()->getForm('Drupal\offres\Form\CommentForm', $r->comment, $r->co_omodu);

    $rows[] = array(
      'nomu'         => array('data' => $r->nomu),
      'co_tpla'      => array('data' => $r->co_tpla),
      'co_orie'      => array('data' => $r->co_orie),
      'co_offreur'   => array('data' => $r->co_offreur),
      'position'     => array('data' => $position),
      'no_offre'     => array('data' => $r->no_offre.' / '.$r->co_omodu),
      'libl'         => array('data' => $r->libl),
      'nomu2'        => array('data' => $r->nomu2),
      'co_moda'      => array('data' => ($r->co_moda=="S")? "OUI" : '-'),
      'offre_cat'    => array('data' => $offre_cat),
      'iufm'         => array('data' => $iufm),
      'intedisc'     => array('data' => $interdisc),
      'nouv_offreur' => array('data' => $nouv_offreur),
      'prio_nat'     => array('data' => $prio_nat),
      'prio_aca'     => array('data' => $prio_aca),
      'nb_hp'        => array('data' => $nb_hp),
      'nb_vac'       => array('data' => $nb_vac),
      'taux'         => array('data' => $taux),
      'ht2'          => array('data' => $ht2),
      'cout_p_prest' => array('data' => $r->cout_p_prest),
      'cout_p_fonc'  => array('data' => $r->cout_p_fonc),
      'cout_p_excep' => array('data' => $r->cout_p_excep),
      'nb_groupe'    => array('data' => $r->nb_groupe),
      'nb_eff_groupe'=> array('data' => $r->nb_eff_groupe),
      'duree_prev'   => array('data' => $r->duree_prev),
      'comment'      => array('data' => $comment),
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

