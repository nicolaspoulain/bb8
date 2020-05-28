<?php

namespace Drupal\offres\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\bb\Controller\BbCrudController;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Controller
 */
class OffresController extends ControllerBase {

  /**
   * Render a list of entries in the database.
   */
  public function list() {
    $content = [];
    $gets =\Drupal::request()->query->all();
    $nomu = $gets['nomu'];
    $co_orie = $gets['co_orie'];
    $co_tpla = $gets['co_tpla'];
    $co_camp = $gets['co_camp'];
    $co_offreur = $gets['co_offreur'];
    $annee   = $gets['annee'];
    if (! strlen($annee)>0) {
      $annee = 2020;
    }


    $content['filtres'] = \Drupal::formBuilder()->getForm('Drupal\offres\Form\FiltresForm', $r->comment, $r->co_omodu, $annee);

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
    'ecarte'         => array('data' => t('Ecartée'), 'class' => 'jaune'),
    'ptrim'         => array('data' => t('Prem. trim'), 'class' => 'jaune'),
    'hybridable'         => array('data' => t('Hybridable'), 'class' => 'jaune'),
    'echange'         => array('data' => t('Echange coll.'), 'class' => 'jaune'),
    'commbis'         => array('data' => t('Commentaires'), 'class' => 'jaune'),
    'offre_cat'    => array('data' => t('AP ou Pub Dés'), 'class' => 'jaune'),
    'prox'         => array('data' => t('Form de prox'), 'class' => 'jaune'),
    'entm'         => array('data' => t('Entrée métier'), 'class' => 'jaune'),
    'intm'         => array('data' => t('Inter métier'), 'class' => 'jaune'),
    'fofo'         => array('data' => t('Fo de fo'), 'class' => 'jaune'),
    'iufm'         => array('data' => t('Offreur'), 'class' => 'jaune'),
    'interdisc'    => array('data' => t('Interdisc'), 'class' => 'jaune'),
    'nouv_offreur' => array('data' => t('Nouv. offreur'), 'class' => 'jaune'),
    'prio_nat'     => array('data' => t('Priorité Nationale'), 'class' => 'jaune'),
    // 'prio_aca'     => array('data' => t('Pr Aca'), 'class' => 'jaune'),
    'prio_paf'     => array('data' => t('Pr PAF (1D,2D)'), 'class' => 'jaune'),
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
    $count = 50;

    $query = db_select('gbb_gdiof', 'd');
    $query ->leftjoin('gbb_gmoof', 'm', 'd.co_offre = m.co_offre');
    $query ->leftjoin('gbb_gdiof_dafor', 'dd', 'm.co_omodu = dd.co_omodu');
    $query ->leftjoin('gbb_gresp', 'r', 'd.co_resp = r.co_resp AND r.co_degre = 2');
    $query ->leftjoin('gbb_gresp', 'r2', 'm.co_resp = r2.co_resp AND r2.co_degre = 2');
    // $query ->condition('d.no_offre', '20190000', '>');
    if (strlen($nomu)>0)    $query ->condition('r.nomu', $nomu, 'like');
    if (strlen($co_orie)>0) $query ->condition('d.co_orie', $co_orie, 'like');
    if (strlen($co_tpla)>0) $query ->condition('d.co_tpla', $co_tpla, 'like');
    if (strlen($co_offreur)>0) $query ->condition('d.co_offreur', $co_offreur."%", 'like');
    if (strlen($annee)>0) $query ->condition('d.no_offre', $annee."0000", '>');
    if ($co_camp=='FIL') $query ->condition('r.nomu', 'mouttapa', 'like');
    if ($co_camp=='PAF') $query ->condition('r.nomu', 'mouttapa', 'not like');
    $query ->fields('m', array(
      'libl', 'co_omodu', 'nb_groupe', 'duree_prev','nb_eff_groupe', 'co_moda',
      'cout_p_excep', 'cout_p_prest', 'cout_p_fonc',
    ));
    $query ->fields('d', array(
      'no_offre', 'co_tpla', 'co_orie','co_offreur','co_camp',
    ));
    $query ->fields('dd', array(
      'nb_hp','nb_vac','taux','ht2','iufm', 'nouv_offreur',
      'prio_nat','prio_aca', 'offre_cat','interdisc', 'comment','position',
      'prio_paf','prox','entm','intm','fofo',
      'ecarte', 'commbis', 'hybridable', 'echange','ptrim',
      // 'offre_new', 'pub_des','anim_peda', 'foad',
    ));
    $query ->fields('r', array('nomu'));
    $query ->addfield('d', 'libl', 'libdispo');
    $query ->addField('r2', 'nomu', 'nomu2');
    $query ->distinct();
    $pager = $query->extend('Drupal\Core\Database\Query\PagerSelectExtender')->limit($count);

  $rows = array();
  foreach ($result = $pager->execute()->fetchAll() as $r) {
    // $comment = render(drupal_get_form('gbb_offres_comment_form', // $r->comment, $r->co_omodu)) ;
    $position = \Drupal::formBuilder()->getForm('Drupal\offres\Form\PositionForm', $r->position, $r->co_omodu);
    $offre_cat = \Drupal::formBuilder()->getForm('Drupal\offres\Form\OffreCatForm', $r->offre_cat, $r->co_omodu);

    $prox = \Drupal::formBuilder()->getForm('Drupal\offres\Form\ProxForm', $r->prox, $r->co_omodu);
    $entm = \Drupal::formBuilder()->getForm('Drupal\offres\Form\EntmForm', $r->entm, $r->co_omodu);
    $intm = \Drupal::formBuilder()->getForm('Drupal\offres\Form\IntmForm', $r->intm, $r->co_omodu);
    $fofo = \Drupal::formBuilder()->getForm('Drupal\offres\Form\FofoForm', $r->fofo, $r->co_omodu);

    $iufm = \Drupal::formBuilder()->getForm('Drupal\offres\Form\IufmForm', $r->iufm, $r->co_omodu);
    $commbis = \Drupal::formBuilder()->getForm('Drupal\offres\Form\CommbisForm', $r->commbis, $r->co_omodu);
    $echange = \Drupal::formBuilder()->getForm('Drupal\offres\Form\EchangeForm', $r->echange, $r->co_omodu);
    $ecarte = \Drupal::formBuilder()->getForm('Drupal\offres\Form\EcarteForm', $r->ecarte, $r->co_omodu);
    $ptrim = \Drupal::formBuilder()->getForm('Drupal\offres\Form\PtrimForm', $r->ptrim, $r->co_omodu);
    $hybridable = \Drupal::formBuilder()->getForm('Drupal\offres\Form\HybridableForm', $r->hybridable, $r->co_omodu);
    $interdisc = \Drupal::formBuilder()->getForm('Drupal\offres\Form\InterdiscForm', $r->interdisc, $r->co_omodu);
    $nouv_offreur = \Drupal::formBuilder()->getForm('Drupal\offres\Form\NouvOffreurForm', $r->nouv_offreur, $r->co_omodu);
    $prio_nat = \Drupal::formBuilder()->getForm('Drupal\offres\Form\PrioNatForm', $r->prio_nat, $r->co_omodu, $r->co_tpla, $r->co_orie);
    // $prio_aca = \Drupal::formBuilder()->getForm('Drupal\offres\Form\PrioAcaForm', $r->prio_aca, $r->co_omodu);
    $prio_paf = \Drupal::formBuilder()->getForm('Drupal\offres\Form\PrioPafForm', $r->prio_paf, $r->co_omodu);
    $nb_hp = \Drupal::formBuilder()->getForm('Drupal\offres\Form\NbHpForm', $r->nb_hp, $r->co_omodu);
    $nb_vac = \Drupal::formBuilder()->getForm('Drupal\offres\Form\NbVacForm', $r->nb_vac, $r->co_omodu);
    $taux = \Drupal::formBuilder()->getForm('Drupal\offres\Form\TauxForm', $r->taux, $r->co_omodu);
    $ht2 = \Drupal::formBuilder()->getForm('Drupal\offres\Form\Ht2Form', $r->ht2, $r->co_omodu);
    $comment = \Drupal::formBuilder()->getForm('Drupal\offres\Form\CommentForm', $r->comment, $r->co_omodu);

    $titre = $r->libl;
    $class = "normal";
    if ($titre=="") {
      $titre = $r->libdispo;
      $class = "red";
    };

    $rows[] = array(
      'nomu'         => array('data' => $r->nomu),
      'co_tpla'      => array('data' => $r->co_tpla),
      'co_orie'      => array('data' => $r->co_orie),
      'co_offreur'   => array('data' => $r->co_offreur),
      'position'     => array('data' => $position),
      'no_offre'     => array('data' => Link::fromTextAndUrl($r->no_offre.' / '.$r->co_omodu, Url::fromUri('https://daforbb.scola.ac-paris.fr/bb8/web/detailsOffre?co_omodu='.$r->co_omodu)), "class"=>$class),
      'libl'         => array('data' => $titre, "class"=>$class),
      'nomu2'        => array('data' => $r->nomu2),
      'co_moda'      => array('data' => ($r->co_moda=="S")? "OUI" : '-'),
      'ecarte'              => array('data' => $ecarte),
      'ptrim'              => array('data' => $ptrim),
      'hybridable'          => array('data' => $hybridable),
      'echange'             => array('data' => $echange),
      'commbis'             => array('data' => $commbis),
      'offre_cat'    => array('data' => $offre_cat),
      'prox'         => array('data' => $prox),
      'entm'         => array('data' => $entm),
      'intm'         => array('data' => $intm),
      'fofo'         => array('data' => $fofo),
      'iufm'         => array('data' => $iufm),
      'intedisc'     => array('data' => $interdisc),
      'nouv_offreur' => array('data' => $nouv_offreur),
      'prio_nat'     => array('data' => $prio_nat),
      // 'prio_aca'     => array('data' => $prio_aca),
      'prio_paf'     => array('data' => $prio_paf),
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
      '#sticky' => true,
      // '#attributes' => array('class' => array('sticky-header')),
    );

  $content['table'][] = array(
      '#type' => 'pager',
    );

    // Don't cache this page.
    $content['#cache']['max-age'] = 0;

    return $content;
  }
}

