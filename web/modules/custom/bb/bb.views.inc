<?php
# vim: foldmarker={{,}} foldlevel=0 foldmethod=marker :

/**
 * Implement hook_views_data().
 *
 * Describe gbb tables so that it can be used by views
 *
 * Pour les handlers (filed, sort, filter..)
 * https://api.drupal.org/api/drupal/core%21modules%21views%21views.api.php/function/hook_views_data/8
 */


function bb_views_data() {

  $data = array();
  $gaia_db = 'external';

  // ********************************************************
  // * gbb_gmodu ** et toutes ses colonnes + sessions spéciales
  // ********************************************************
  //{{

  $data['gbb_gmodu']['table'] = array( 'group' => t('gbb_gmodu'),
  //{{
    'base' => array(
      'database' => $gaia_db,
      'field' => 'co_modu',
      'title' => t('GaiaBB'),
      'help'  => t('Tables du module GaiaBB.'),
    ),
  );
  //}}

  $data['gbb_gmodu']['co_modu'] = array( 'help' => t('Code du module'),
  //{{
    'title'  => t('co_modu'),
    'field'  => array('id' => 'numeric',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'numeric'),
    'argument' => array('id' => 'numeric'),
  );
  //}}
  $data['gbb_gmodu']['co_degre'] = array( 'help' => t('Code degré'),
  //{{
    'title'  => t('co_degre'),
    'field'  => array('id' => 'numeric',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'numeric'),
    'argument' => array('id' => 'numeric'),
  );
  //}}
  $data['gbb_gmodu']['co_anmo'] = array( 'help' => t('Code annulation module'),
  //{{
    'title'  => t('co_anmo'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gmodu']['lib'] = array( 'help' => t('Libellé'),
  //{{
    'title'  => t('lib'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gmodu']['lcont'] = array( 'help' => t('Contenu litteral'),
  //{{
    'title'  => t('lcont'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gmodu']['lpeda'] = array( 'help' => t('Objectif pedagogique'),
  //{{
    'title'  => t('lpeda'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gmodu']['lmoda'] = array( 'help' => t('Modalité'),
  //{{
    'title'  => t('lmoda'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gmodu']['lcomm'] = array( 'help' => t('Commentaires (hashtag)'),
  //{{
    'title'  => t('lcomm'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gmodu']['lform'] = array( 'help' => t('Forme'),
  //{{
    'title'  => t('lform'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gmodu']['co_moda'] = array( 'help' => t('Code Modalité'),
    //{{
    'title' => t('co_moda'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_nmoda']['table'] = array( 'group' => t('gbb_gmodu'),
  //{{
    'join' => array(
      'gbb_gmodu' => array(
        'left_field' => 'co_moda',
        'field' => 'co_moda',
      ),
    ),
  );
  //}}
  $data['gbb_nmoda']['lib_court'] = array( 'help' => t('Modalité : libellé court'),
  //{{
    'title' => t('nmoda.lib_court'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gmodu']['cout_p_fonc'] = array( 'help' => t('Coût prévisionnel de fonctionnement par groupe'),
  //{{
    'title'  => t('cout_p_fonc'),
    'field'  => array('id' => 'numeric',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'numeric'),
  );
  //}}
  $data['gbb_gmodu']['cout_p_prest'] = array( 'help' => t('Coût prévisionnel de prestation par groupe'),
  //{{
    'title'  => t('cout_p_prest'),
    'field'  => array('id' => 'numeric',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'numeric'),
  );
  //}}
  $data['gbb_gmodu']['cout_p_excep'] = array( 'help' => t('Coût prévisionnel des frais exceptionnels'),
  //{{
    'title'  => t('cout_p_excep'),
    'field'  => array('id' => 'numeric',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'numeric'),
  );
  //}}
  $data['gbb_gmodu']['nb_groupe'] = array( 'help' => t('Nombre de groupes possible'),
  //{{
    'title'  => t('nb_groupe'),
    'field'  => array('id' => 'numeric',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'numeric'),
    'argument' => array('id' => 'numeric'),
  );
  //}}
  $data['gbb_gmodu']['nb_eff_groupe'] = array( 'help' => t('Effectif par groupe'),
  //{{
    'title'  => t('nb_eff_groupe'),
    'field'  => array('id' => 'numeric',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'numeric'),
    'argument' => array('id' => 'numeric'),
  );
  //}}
  $data['gbb_gmodu']['duree_prev'] = array( 'help' => t('Duree prevue'),
  //{{
    'title'  => t('duree_prev'),
    'field'  => array('id' => 'numeric',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'numeric'),
    'argument' => array('id' => 'numeric'),
  );
  //}}
  $data['gbb_gmodu']['nb_place_prev'] = array( 'help' => t('Nombre de places prevues'),
  //{{
    'title'  => t('nb_place_prev'),
    'field'  => array('id' => 'numeric',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'numeric'),
    'argument' => array('id' => 'numeric'),
  );
  //}}
  $data['gbb_gmodu']['nb_h_interv'] = array( 'help' => t('Nombre heures intervention'),
  //{{
    'title'  => t('nb_h_interv'),
    'field'  => array('id' => 'numeric',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'numeric'),
    'argument' => array('id' => 'numeric'),
  );
  //}}
  $data['gbb_gmodu_plus']['table'] = array( 'group' => t('gbb_gmodu'),
  //{{
    'join' => array(
      'gbb_gmodu' => array(
        'left_field' => 'co_modu',
        'field' => 'co_modu',
        'extra' => 'gbb_gmodu_plus.co_degre = gbb_gmodu.co_degre',
      ),
    ),
  );
  //}}
  $data['gbb_gmodu_plus']['color'] = array( 'help' => t('color'),
  //{{
    'title' => t('color'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gmodu_plus']['rpedacolor'] = array( 'help' => t('rpedacolor'),
  //{{
    'title' => t('rpedacolor'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gmodu_plus']['rorgacolor'] = array( 'help' => t('rorgacolor'),
  //{{
    'title' => t('rorgacolor'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gmodu_plus']['semestre'] = array( 'help' => t('semestre'),
  //{{
    'title' => t('semestre'),
    'field'  => array('id' => 'numeric',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'numeric'),
    'argument' => array('id' => 'numeric'),
  );
  //}}
  $data['gbb_gmodu_plus']['prioritaire'] = array( 'help' => t('prioritaire'),
  //{{
    'title' => t('prioritaire'),
    'field'  => array('id' => 'numeric',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'numeric'),
    'argument' => array('id' => 'numeric'),
  );
  //}}
  $data['gbb_gmodu_plus']['reforme'] = array( 'help' => t('reforme'),
  //{{
    'title' => t('reforme'),
    'field'  => array('id' => 'numeric',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'numeric'),
    'argument' => array('id' => 'numeric'),
  );
  //}}
  $data['gbb_gmodu_plus']['organisation'] = array( 'help' => t('organisation'),
  //{{
    'title' => t('organisation'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gmodu_plus']['thematique'] = array( 'help' => t('thematique orange'),
  //{{
    'title' => t('thematique orange'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gmodu_plus']['prio_nat'] = array( 'help' => t('prio_nat orange'),
  //{{
    'title' => t('prio_nat orange'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_nprna_orange']['table'] = array( 'group' => t('gbb_gmodu'),
  //{{
    'join' => array(
      'gbb_gmodu' => array(
        'table' => 'gbb_nprna',
        'left_table' => 'gbb_gmodu_plus',
        'left_field' => 'prio_nat',
        'field' => 'co_prna',
      ),
    ),
  );
  //}}
  $data['gbb_nprna_orange']['lib_court'] = array( 'help' => t('Priorite nationale : libellé court (orange)'),
  //{{
    'title' => t('nprna_orange.lib_court'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_nprna_orange']['lib_long'] = array( 'help' => t('Priorite nationale : libellé long (orange)'),
  //{{
    'title' => t('nprna_orange.lib_long'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gmodu_taxonomy']['table'] = array( 'group' => t('gbb_gmodu'),
  //{{
    'join' => array(
      'gbb_gmodu' => array(
        'left_field' => 'co_modu',
        'field' => 'co_modu',
        'extra' => 'gbb_gmodu_taxonomy.co_degre = gbb_gmodu.co_degre',
      ),
    ),
  );
  //}}
  $data['gbb_gmodu_taxonomy']['tid'] = array( 'help' => t('taxonomy id'),
  //{{
    'title' => t('tid'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'numeric'),
  );
  //}}
  $data['gbb_gmodu_taxonomy']['weight'] = array( 'help' => t('weight'),
  //{{
    'title' => t('weight'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'numeric'),
    'argument' => array('id' => 'numeric'),
  );
  //}}
  $data['gbb_gmodu_taxonomy']['type'] = array( 'help' => t('type'),
  //{{
    'title' => t('type'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}

  $data['gbb_grcoof_gdisp']['table'] = array( 'group' => t('gbb_gdisp'),
    'join' => array(
      'gbb_gmodu' => array(
        'table' => 'gbb_grcoof',
        'left_table' => 'gbb_gdisp',
        'left_field' => 'co_offreur',
        'field' => 'code',
      ),
    ),
  );
    $data['gbb_grcoof_gdisp']['groupe'] = array( 'help' => t('Groupe code_offreur'),
  //{{
    'title' => t('groupe co_offreur'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
    $data['gbb_grcoof_gdisp']['entree'] = array( 'help' => t('Entree code_offreur'),
  //{{
    'title' => t('Entree co_offreur'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
    $data['gbb_grcoof_gdisp']['axe'] = array( 'help' => t('Axe code_offreur'),
  //{{
    'title' => t('axe co_offreur'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
    $data['gbb_grcoof_gdisp']['prio'] = array( 'help' => t('Prio code_offreur'),
  //{{
    'title' => t('prio co_offreur'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}

  $data['gbb_gmofl']['table'] = array( 'group' => t('gbb_gmodu'),
  //{{
    'join' => array(
      'gbb_gmodu' => array(
        'left_field' => 'co_modu',
        'field' => 'co_modu',
        'extra' => 'gbb_gmodu.co_degre = 1',
      ),
    ),
  );
  //}}
  $data['gbb_gmofl']['lib'] = array( 'help' => t('Libellé'),
  //{{
    'title' => t('lib gmofl'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gmofl']['co_lieu'] = array( 'help' => t('Co_lieu : RNE circo filtre'),
  //{{
    'title' => t('co_lieu'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_netab_gmofl']['table'] = array( 'group' => t('gbb_gmodu'),
  //{{
    'join' => array(
      'gbb_gmodu' => array(
        'table' => 'gbb_netab',
        'left_table' => 'gbb_gmofl',
        'left_field' => 'co_lieu',
        'field' => 'co_lieu',
      ),
    ),
  );
  //}}
  $data['gbb_netab_gmofl']['denom_comp'] = array( 'help' => t('gmofl filtre circo denom_comp'),
  //{{
    'title' => t('gmofl_denom_comp'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_netab_gmofl']['denom_princ'] = array( 'help' => t('gmofl filtre circo denom_princ'),
  //{{
    'title' => t('gmofl_denom_princ'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}

  $data['taxonomy_term_field_data_ng']['table'] = array( 'group' => t('gbb_gmodu'),
  //{{
    'join' => array(
      'gbb_gmodu' => array(
        'table' => 'taxonomy_term_field_data',
        'left_table' => 'gbb_gmodu_taxonomy',
        'left_field' => 'tid',
        'field' => 'tid',
      ),
    ),
  );
  //}}
  $data['taxonomy_term_field_data_ng']['tid'] = array( 'help' => t('Terme de taxonomie NG'),
  //{{
    'title' => t('tid NG'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'numeric'),
    'argument' => array('id' => 'numeric'),
  );
  //}}
  $data['taxonomy_term_field_data_ng']['name'] = array( 'help' => t('nom de l elt de taxonomie NG'),
  //{{
    'title' => t('name NG'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['taxonomy_term_field_data_ng']['weight'] = array( 'help' => t('Poids du terme de taxonomie'),
  //{{
    'title' => t('weight ng'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['taxonomy_term__field_co_orie']['table'] = array( 'group' => t('gbb_gmodu'),
  //{{
    'join' => array(
      'gbb_gmodu' => array(
        'table' => 'taxonomy_term__field_co_orie',
        'left_table' => 'gbb_gmodu_taxonomy',
        'left_field' => 'tid',
        'field' => 'entity_id',
      ),
    ),
  );
  //}}
  $data['taxonomy_term__field_co_orie']['field_co_orie_value'] = array( 'help' => t('Co_orie du terme de taxonomie NG'),
  //{{
    'title' => t('co_orie taxo'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['taxonomy_term__field_plan']['table'] = array( 'group' => t('gbb_gmodu'),
  //{{
    'join' => array(
      'gbb_gmodu' => array(
        'table' => 'taxonomy_term__field_plan',
        'left_table' => 'gbb_gmodu_taxonomy',
        'left_field' => 'tid',
        'field' => 'entity_id',
      ),
    ),
  );
  //}}
  $data['taxonomy_term__field_plan']['field_plan_value'] = array( 'help' => t('Plan du terme de taxonomie NG'),
  //{{
    'title' => t('plan taxo'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['taxonomy_term__field_dom_disc']['table'] = array( 'group' => t('gbb_gmodu'),
  //{{
    'join' => array(
      'gbb_gmodu' => array(
        'table' => 'taxonomy_term__field_dom_disc',
        'left_table' => 'gbb_gmodu_taxonomy',
        'left_field' => 'tid',
        'field' => 'entity_id',
      ),
    ),
  );
  //}}
  $data['taxonomy_term__field_dom_disc']['field_dom_disc_value'] = array( 'help' => t('Dom_disc du terme de taxonomie NG'),
  //{{
    'title' => t('dom_disc taxo'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}


  $data['taxonomy_term_data_dafor']['table'] = array( 'group' => t('gbb_gmodu'),
  //{{
    'join' => array(
      'gbb_gmodu' => array(
        'table' => 'taxonomy_term_data',
        'left_table' => 'gbb_gmodu_taxonomy',
        'left_field' => 'tid',
        'field' => 'tid',
      ),
    ),
  );
  //}}
  $data['taxonomy_term_data_dafor']['vid'] = array( 'help' => t('Vocabulaire de taxonomie'),
  //{{
    'title' => t('vid'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'numeric'),
    'argument' => array('id' => 'numeric'),
  );
  //}}
  $data['taxonomy_term_data_dafor']['name'] = array( 'help' => t('nom de l elt de taxonomie'),
  //{{
    'title' => t('name'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['taxonomy_term_data_dafor']['description'] = array( 'help' => t('description de l elt de taxonomie'),
  //{{
    'title' => t('description'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['taxonomy_term_data_dafor']['name'] = array( 'help' => t('nom de l elt de taxonomie'),
  //{{
    'title' => t('name'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['taxonomy_vocabulary_dafor']['table'] = array( 'group' => t('gbb_gmodu'),
  //{{
    'join' => array(
      'gbb_gmodu' => array(
        'table' => 'taxonomy_vocabulary',
        'left_table' => 'taxonomy_term_data_dafor',
        'left_field' => 'vid',
        'field' => 'vid',
      ),
    ),
  );
  //}}
  $data['taxonomy_vocabulary_dafor']['name'] = array( 'help' => t('Nom du vocabulaire de taxonomie'),
  //{{
    'title' => t('taxonomy_vocabulary.name'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['taxonomy_vocabulary_dafor']['weight'] = array( 'help' => t('weight du vocabulaire de taxonomie'),
  //{{
    'title' => t('taxonomy_vocabulary.weight'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'numeric'),
    'argument' => array('id' => 'numeric'),
  );
  //}}





  $data['taxonomy_term_field_data']['table'] = array( 'group' => t('gbb_gmodu'),
  //{{
    'join' => array(
      'gbb_gmodu' => array(
        // 'table' => 'taxonomy_term_data',
        'left_table' => 'gbb_gmodu_taxonomy',
        'left_field' => 'tid',
        'field' => 'tid',
      ),
    ),
  );
  //}}
  $data['taxonomy_term_field_data']['name'] = array( 'help' => t('Nom du terme de taxonomie'),
  //{{
    'title' => t('name'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['taxonomy_term_field_data']['vid'] = array( 'help' => t('Vocabulaire de taxonomie'),
  //{{
    'title' => t('vid'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'numeric'),
    'argument' => array('id' => 'numeric'),
  );
  //}}
  $data['taxonomy_term_field_data']['description__value'] = array( 'help' => t('Nom abbrégé du terme de taxonomie'),
  //{{
    'title' => t('description__value'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gmodu']['co_prna'] = array( 'help' => t('Priorite nationale : code'),
  //{{ *** GBB_NPRNA intégré
    'title'  => t('co_prna'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  $data['gbb_nprna']['table'] = array( 'group' => t('gbb_gmodu'),
  //{{
    'join' => array(
      'gbb_gmodu' => array(
        'left_field' => 'co_prna',
        'field' => 'co_prna',
      ),
    ),
  );
  //}}
  $data['gbb_nprna']['lib_court'] = array( 'help' => t('Priorite nationale : libellé court'),
  //{{
    'title' => t('nprna.lib_court'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_nprna']['lib_long'] = array( 'help' => t('Priorite nationale : libellé long'),
  //{{
    'title' => t('nprna.lib_long'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  //}}
  $data['gbb_gmodu']['co_prac'] = array( 'help' => t('Priorite academique : code'),
  //{{ *** GBB_NPRAC intégré
    'title'  => t('co_prac'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  // ........................................................
  // gbb_nprac * intégré directement dans les champs de gbb_gmodu
  // ........................................................
  $data['gbb_nprac']['table'] = array( 'group' => t('gbb_gmodu'),
  //{{
    'join' => array(
      'gbb_gmodu' => array(
        'left_field' => 'co_prac',
        'field' => 'co_prac',
      ),
    ),
  );
  //}}
  $data['gbb_nprac']['lib_court'] = array( 'help' => t('Priorite nationale : libellé court'),
  //{{
    'title' => t('nprac.lib_court'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_nprac']['lib_long'] = array( 'help' => t('Priorite nationale : libellé long'),
  //{{
    'title' => t('nprac.lib_long'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  //}}



  $data['gbb_gmodu']['lcibl'] = array( 'help' => t('Cible litterale'),
  //{{
    'title'  => t('lcibl'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gmodu']['co_cibl'] = array( 'help' => t('Code du public cible'),
  //{{
    'title'  => t('co_cibl'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gmodu']['co_etab_dem'] = array( 'help' => t('RNE de l etablissement demandeur'),
  //{{ *** GBB_NETAB_DAFOR intégré
    'title'  => t('co_etab_dem'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  // ........................................................
  // gbb_netab_dafor * intégré directement dans les champs de gbb_gmodu
  // ........................................................
  $data['gbb_netab_modu']['table'] = array( 'group' => t('gbb_gmodu'),
    'join' => array(
      'gbb_gmodu' => array(
        'table' => 'gbb_netab',
        'left_field' => 'co_etab_dem',
        'field' => 'co_lieu',
      ),
    ),
  );
  $data['gbb_netab_modu']['cp'] = array( 'help' => t('cp'),
  //{{
    'title' => t('netab.cp'),
    'field'  => array('id' => 'numeric',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'numeric'),
    'argument' => array('id' => 'numeric'),
  );
  //}}
  $data['gbb_netab_modu']['denom_comp'] = array( 'help'   => t('Nom établissement'),
    //{{
    'title'  => t('netab.Nom'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_netab_modu']['sigle'] = array( 'help'   => t('Sigle'),
    //{{
    'title'  => t('netab.Sigle'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  //}}



  $data['gbb_gmodu']['dt_crea'] = array( 'help' => t('Date création'),
  //{{
    'title'  => t('dt_crea'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  //{{ Responsable ORGA    pour un module (co_tres=2)
  $data['gbb_gdire_orga']['table'] = array( 'group' => t('gbb_gdire_orga'),
    'join' => array(
      'gbb_gmodu' => array(
        'table' => 'gbb_gdire',
        'left_field' => 'co_modu',
        'field' => 'co_modu',
        'extra' => 'gbb_gdire_orga.co_degre = gbb_gmodu.co_degre AND gbb_gdire_orga.co_tres=2',
      ),
    ),
  );
  $data['gbb_gresp_orga']['table'] = array( 'group' => t('gbb_gmodu'),
    'join' => array(
      'gbb_gmodu' => array(
        'table' => 'gbb_gresp',
        'left_table' => 'gbb_gdire_orga',
        'left_field' => 'co_resp',
        'field' => 'co_resp',
        'extra' => 'gbb_gresp_orga.co_degre = gbb_gmodu.co_degre',
      ),
    ),
  );
  //}}
  $data['gbb_gresp_orga']['nomu'] = array( 'help' => t('Nom du responsable organisationnel'),
    //{{
    'title' => t('gresp.nomu orga'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gresp_orga']['prenom'] = array( 'help' => t('Prénom du responsable organisationnel'),
    //{{
    'title' => t('gresp.prenom orga'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gresp_orga']['qualite'] = array( 'help' => t('Qualité du responsable organisationnel'),
    //{{
    'title' => t('gresp.qualite orga'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  //{{ Responsable PEDA    pour un module (co_tres=3)
  $data['gbb_gdire_peda']['table'] = array( 'group' => t('gdire_peda'),
    'join' => array(
      'gbb_gmodu' => array(
        'table' => 'gbb_gdire',
        'left_field' => 'co_modu',
        'field' => 'co_modu',
        'extra' => 'gbb_gdire_peda.co_degre = gbb_gmodu.co_degre AND gbb_gdire_peda.co_tres=3',
      ),
    ),
  );
  $data['gbb_gresp_peda']['table'] = array( 'group' => t('gbb_gmodu'),
    'join' => array(
      'gbb_gmodu' => array(
        'table' => 'gbb_gresp',
        'left_table' => 'gbb_gdire_peda',
        'left_field' => 'co_resp',
        'field' => 'co_resp',
        'extra' => 'gbb_gresp_peda.co_degre = gbb_gmodu.co_degre',
      ),
    ),
  );
  //}}
  $data['gbb_gresp_peda']['nomu'] = array( 'help' => t('Nom du responsable pédagogique'),
    //{{
    'title' => t('gresp.nomu peda'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gresp_peda']['prenom'] = array( 'help' => t('Prénom du responsable pédagogique'),
    //{{
    'title' => t('gresp.prenom peda'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gresp_peda']['qualite'] = array( 'help' => t('Qualité du responsable pédagogique'),
    //{{
    'title' => t('gresp.qualite peda'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}

  //{{ Spécial pour l'affichage des compteurs de sessions
  // ........................................................
  // session : sess_id d'une session en cours
  // ........................................................
  $data['gbb_session_encours']['table'] = array( 'group' => t('gbb_gmodu'),
  //{{
      'join' => array(
      'gbb_gmodu' => array(
        'table' => 'gbb_session',
        'left_field' => 'co_modu',
        'field' => 'co_modu',
        // 'extra' => 'gbb_session_encours.co_degre = gbb_gmodu.co_degre AND gbb_session_encours.en_attente=0 AND gbb_session_encours.convoc_sent=0',
        'extra' => 'gbb_session_encours.co_degre = gbb_gmodu.co_degre AND gbb_session_encours.status=0',
      ),
    ),
  );
  //}}
  $data['gbb_session_encours']['sess_id'] = array( 'help' => t('Identifiant de la session enCours'),
    //{{
    'title' => t('sess_id_enCours'),
    'field'  => array('id' => 'numeric',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'numeric'),
  );
  //}}
  // ........................................................
  // session : sess_id d'une session en attente
  // ........................................................
  $data['gbb_session_attente']['table'] = array( 'group' => t('gbb_gmodu'),
    //{{
    'join' => array(
      'gbb_gmodu' => array(
        'table' => 'gbb_session',
        'left_field' => 'co_modu',
        'field' => 'co_modu',
        // 'extra' => 'gbb_session_attente.co_degre = gbb_gmodu.co_degre AND gbb_session_attente.en_attente=1',
        'extra' => 'gbb_session_attente.co_degre = gbb_gmodu.co_degre AND gbb_session_attente.status=1',
      ),
    ),
  );
  //}}
  $data['gbb_session_attente']['sess_id'] = array( 'help' => t('Identifiant de la session attente'),
    //{{
    'title' => t('sess_id_attente'),
    'field'  => array('id' => 'numeric',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'numeric'),
  );
  //}}
  // ........................................................
  // session : sess_id d'une session drapeau
  // ........................................................
  $data['gbb_session_flag']['table'] = array( 'group' => t('gbb_gmodu'),
    //{{
      'join' => array(
      'gbb_gmodu' => array(
        'table' => 'gbb_session',
        'left_field' => 'co_modu',
        'field' => 'co_modu',
        'extra' => 'gbb_session_flag.co_degre = gbb_gmodu.co_degre AND gbb_session_flag.status=2',
      ),
    ),
  );
  //}}
  $data['gbb_session_flag']['sess_id'] = array( 'help' => t('Identifiant de la session flag'),
    //{{
    'title' => t('sess_id_flag'),
    'field'  => array('id' => 'numeric',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'numeric'),
  );
  //}}
  // ........................................................
  // session : sess_id d'une session envoyée
  // ........................................................
  $data['gbb_session_sent']['table'] = array( 'group' => t('gbb_gmodu'),
    //{{
      'join' => array(
      'gbb_gmodu' => array(
        'table' => 'gbb_session',
        'left_field' => 'co_modu',
        'field' => 'co_modu',
        // 'extra' => 'gbb_session_sent.co_degre = gbb_gmodu.co_degre AND gbb_session_sent.convoc_sent=1',
        'extra' => 'gbb_session_sent.co_degre = gbb_gmodu.co_degre AND gbb_session_sent.status=3',
      ),
    ),
  );
  //}}
  $data['gbb_session_sent']['sess_id'] = array( 'help' => t('Identifiant de la session sent'),
    //{{
    'title' => t('sess_id_sent'),
    'field'  => array('id' => 'numeric',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'numeric'),
  );
  //}}
  // ........................................................
  // session : sess_id d'une session formateur envoyé
  // ........................................................
  $data['gbb_session_formateur_sent']['table'] = array( 'group' => t('gbb_gmodu'),
    //{{
      'join' => array(
      'gbb_gmodu' => array(
        'table' => 'gbb_session',
        'left_field' => 'co_modu',
        'field' => 'co_modu',
        'extra' => 'gbb_session_formateur_sent.co_degre = gbb_gmodu.co_degre AND gbb_session_formateur_sent.status=4',
      ),
    ),
  );
  //}}
  $data['gbb_session_formateur_sent']['sess_id'] = array( 'help' => t('Identifiant de la session formateur sent'),
    //{{
    'title' => t('sess_id_formateur_sent'),
    'field'  => array('id' => 'numeric',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'numeric'),
  );
  //}}
  // ........................................................
  // session : sess_id d'une session stagiaires envoyé
  // ........................................................
  $data['gbb_session_stagiaires_sent']['table'] = array( 'group' => t('gbb_gmodu'),
    //{{
      'join' => array(
      'gbb_gmodu' => array(
        'table' => 'gbb_session',
        'left_field' => 'co_modu',
        'field' => 'co_modu',
        'extra' => 'gbb_session_stagiaires_sent.co_degre = gbb_gmodu.co_degre AND gbb_session_stagiaires_sent.status=5',
      ),
    ),
  );
  //}}
  $data['gbb_session_stagiaires_sent']['sess_id'] = array( 'help' => t('Identifiant de la session stagiaires sent'),
    //{{
    'title' => t('sess_id_stagiaires_sent'),
    'field'  => array('id' => 'numeric',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'numeric'),
  );
  //}}
  // ........................................................
  // session : sess_id d'une session DE
  // ........................................................
  $data['gbb_session_de']['table'] = array( 'group' => t('gbb_gmodu'),
    //{{
      'join' => array(
      'gbb_gmodu' => array(
        'table' => 'gbb_session',
        'left_field' => 'co_modu',
        'field' => 'co_modu',
        'extra' => 'gbb_session_de.co_degre = gbb_gmodu.co_degre AND gbb_session_de.status=6',
      ),
    ),
  );
  //}}
  $data['gbb_session_de']['sess_id'] = array( 'help' => t('Identifiant de la session DE'),
    //{{
    'title' => t('sess_id_de'),
    'field'  => array('id' => 'numeric',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'numeric'),
  );
  //}}
  // ........................................................
  // session : sess_id d'une session en traitement
  // ........................................................
  $data['gbb_session_en_tmt']['table'] = array( 'group' => t('gbb_gmodu'),
    //{{
      'join' => array(
      'gbb_gmodu' => array(
        'table' => 'gbb_session',
        'left_field' => 'co_modu',
        'field' => 'co_modu',
        'extra' => 'gbb_session_en_tmt.co_degre = gbb_gmodu.co_degre AND gbb_session_en_tmt.status=7',
      ),
    ),
  );
  //}}
  $data['gbb_session_en_tmt']['sess_id'] = array( 'help' => t('Identifiant de la session en traitement'),
    //{{
    'title' => t('sess_id_en_tmt'),
    'field'  => array('id' => 'numeric',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'numeric'),
  );
  //}}
  // ........................................................
  // session : sess_id d'une session en demande inspecteur
  // ........................................................
  $data['gbb_session_inspecteur']['table'] = array( 'group' => t('gbb_gmodu'),
    //{{
      'join' => array(
      'gbb_gmodu' => array(
        'table' => 'gbb_session',
        'left_field' => 'co_modu',
        'field' => 'co_modu',
        'extra' => 'gbb_session_inspecteur.co_degre = gbb_gmodu.co_degre AND gbb_session_inspecteur.status=11',
      ),
    ),
  );
  //}}
  $data['gbb_session_inspecteur']['sess_id'] = array( 'help' => t('Identifiant de la session en demande inspecteur'),
    //{{
    'title' => t('sess_id_inspecteur'),
    'field'  => array('id' => 'numeric',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'numeric'),
  );
  //}}
  // ........................................................
  // session : sess_id d'une session a probleme inspecteur
  // ........................................................
  $data['gbb_session_inspecteur_red']['table'] = array( 'group' => t('gbb_gmodu'),
    //{{
      'join' => array(
      'gbb_gmodu' => array(
        'table' => 'gbb_session',
        'left_field' => 'co_modu',
        'field' => 'co_modu',
        'extra' => 'gbb_session_inspecteur_red.co_degre = gbb_gmodu.co_degre AND gbb_session_inspecteur_red.status=12',
      ),
    ),
  );
  //}}
  $data['gbb_session_inspecteur_red']['sess_id'] = array( 'help' => t('Identifiant de la session à problème inspecteur'),
    //{{
    'title' => t('sess_id_inspecteur_red'),
    'field'  => array('id' => 'numeric',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'numeric'),
  );
  //}}
  //}}
  //{{ Resp ORGA ou PEDA   filtre pour module (co_tres=2 OU 3)
  // Pour le FILTRE de la grand liste views admin/structure/views/view/liste_modules
    //{{
  $data['gbb_gdire_orga_peda']['table'] = array( 'group' => t('gbb_gdire_orga_peda'),
    'join' => array(
      'gbb_gmodu' => array(
        'table' => 'gbb_gdire',
        'left_field' => 'co_modu',
        'field' => 'co_modu',
        'extra' => 'gbb_gdire_orga_peda.co_degre = gbb_gmodu.co_degre AND (gbb_gdire_orga_peda.co_tres=2 OR gbb_gdire_orga_peda.co_tres=3)',
      ),
    ),
  );
  //}}
  $data['gbb_gresp_orga_peda']['table'] = array( 'group' => t('gbb_gmodu'),
    //{{
    'join' => array(
      'gbb_gmodu' => array(
        'table' => 'gbb_gresp',
        'left_table' => 'gbb_gdire_orga_peda',
        'left_field' => 'co_resp',
        'field' => 'co_resp',
        'extra' => 'gbb_gresp_orga_peda.co_degre = gbb_gmodu.co_degre',
      ),
    ),
  );
  //}}
  $data['gbb_gresp_orga_peda']['resp_filter'] = array(
    //{{
    'title' => t('CUSTOM responsable orga/peda'),
    'filter' => array(
      'title' => t('CUSTOM responsable orga OU péda'),
      'help' => t('Fltre les stages où toto est resp péda OU orga'),
      'field' => 'nomu',
      'id' => 'string'
    ),
  );
  //}}
  //}}
  //}}

  // ********************************************************
  // * gbb_gdisp ** et toutes ses colonnes
  // ********************************************************
  //{{
  $data['gbb_gdire']['table'] = array( 'group' => t('gbb_gdire'),
  //{{
    'join' => array(
      'gbb_gmodu' => array(
        'table' => 'gbb_gdire',
        'left_field' => 'co_modu',
        'field' => 'co_modu',
        'extra' => 'gbb_gdire.co_degre = gbb_gmodu.co_degre AND gbb_gdire.co_tres=3',
      ),
    ),
  );
  //}}

  $data['gbb_gdisp']['table'] = array( 'group' => t('gbb_gdisp'),
  //{{
    'join' => array(
      'gbb_gmodu' => array(
        // 'left_table' => 'gbb_gdire',
        'left_field' => 'co_disp',
        'field' => 'co_disp',
        'extra' => 'gbb_gdisp.co_degre = gbb_gmodu.co_degre',
      ),
    ),
  );
  //}}
  $data['gbb_gdisp']['id_disp'] = array( 'title' => t('id_disp'),
  //{{
    'help' => t('Identifiant du dispositif'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gdisp']['lib'] = array( 'title' => t('lib'),
  //{{
    'help' => t('Libellé du dispositif'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gdisp']['co_camp'] = array( 'title' => t('co_camp'),
  //{{
    'help' => t('Code campagne'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gdisp']['co_them'] = array( 'title' => t('co_them'),
  //{{
    'help' => t('Code thematique'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gdisp']['gestionnaire'] = array( 'title' => t('gestionnaire'),
  //{{
    'help' => t('Gestionnaire'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gdisp']['co_offreur'] = array( 'title' => t('co_offreur'),
  //{{
    'help' => t('Code offreur'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gdisp']['co_tcan'] = array( 'title' => t('co_tcan'),
  //{{
    'help' => t('Code type candidature'),
    'field'  => array('id' => 'numeric',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'numeric'),
    'argument' => array('id' => 'numeric'),
  );
  //}}
  //{{ *** GBB_NTCAN intégré
  $data['gbb_ntcan']['table'] = array( 'group' => t('gbb_gdisp'),
    'join' => array(
      'gbb_gmodu' => array(
        'left_table' => 'gbb_gdisp',
        'left_field' => 'co_tcan',
        'field' => 'co_tcan',
      ),
    ),
  );
  //}}
  $data['gbb_ntcan']['lib_court'] = array( 'help' => t('Type candidature : libellé court'),
  //{{
    'title' => t('ntcan.lib_court'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_ntcan']['lib_long'] = array( 'help' => t('Type candidature : libellé long'),
  //{{
    'title' => t('ntcan.lib_long'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gdisp']['co_tpla'] = array( 'title' => t('co_tpla'),
  //{{
    'help' => t('Code type plan'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gdisp']['co_orie'] = array( 'title' => t('co_orie'),
  //{{
    'help' => t('Code orientation'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  //{{ *** GBB_NOIRE intégré
  $data['gbb_norie']['table'] = array( 'group' => t('gbb_gdisp'),
    'join' => array(
      'gbb_gmodu' => array(
        'left_table' => 'gbb_gdisp',
        'left_field' => 'co_orie',
        'field' => 'co_orie',
      ),
    ),
  );
  //}}
  $data['gbb_norie']['lib_court'] = array( 'help' => t('Orientation : libellé court'),
  //{{
    'title' => t('norie.lib_court'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_norie']['lib_long'] = array( 'help' => t('Orientation : libellé long'),
  //{{
    'title' => t('norie.lib_long'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gdisp']['lobjt'] = array( 'title' => t('lobjt'),
  //{{
    'help' => t('Objectif litteral'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_nobjt']['table'] = array( 'group' => t('gbb_gdisp'),
  //{{
    'join' => array(
      'gbb_gmodu' => array(
        'left_table' => 'gbb_gdisp',
        'left_field' => 'co_objt',
        'field' => 'co_objt',
      ),
    ),
  );
  //}}
  $data['gbb_nobjt']['lib_court'] = array( 'help' => t('Objectif : libellé court'),
  //{{
    'title' => t('nobjt.lib_court'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gdisp']['co_andi'] = array( 'title' => t('co_andi'),
  //{{
    'help' => t('Code annulation dispo'),
    'field'  => array('id' => 'numeric',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'numeric'),
  );
  //}}
  //}}

  // ********************************************************
  // * gbb_session **  et toutes ses colonnes
  // ********************************************************
  //{{

  $data['gbb_session']['table'] = array( 'group' => t('gbb_session'),
    //{{
    'join' => array(
      'gbb_gmodu' => array(
        'table' => 'gbb_session',
        'left_field' => 'co_modu',
        'field' => 'co_modu',
        'extra' => 'gbb_session.co_degre = gbb_gmodu.co_degre',
      ),
    ),
  );
  //}}
  $data['gbb_session']['co_modu'] = array( 'help' => t('coode module de la session'),
    //{{
    'title' => t('co_modu'),
    'field'  => array('id' => 'numeric',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'numeric'),
  );
  //}}
  $data['gbb_session']['sess_id'] = array( 'help' => t('Identifiant de la session'),
    //{{
    'title' => t('sess_id'),
    'field'  => array('id' => 'numeric',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'numeric'),
  );
  //}}
  $data['gbb_session']['date_ts'] = array( 'help' => t('Date TS'),
    //{{
    'title' => t('date_ts'),
    'field'  => array('id' => 'date',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'date'),
  );
  //}}
  $data['gbb_session']['date'] = array( 'help' => t('Date'),
    //{{
    'title' => t('date'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_session']['horaires'] = array( 'help' => t('Horaires'),
    //{{
    'title' => t('horaires'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_session']['type_paiement'] = array( 'help' => t('Type de paiement'),
    //{{
    'title' => t('type_paiement'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_session']['LE_etat'] = array( 'help' => t('Liste émargement rendue (0/1)'),
    //{{
    'title' => t('LE_etat'),
    'field'  => array('id' => 'numeric',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'numeric'),
  );
  //}}
  $data['gbb_session']['paiement_etat'] = array( 'help' => t('Paiement demandé (0/1)'),
    //{{
    'title' => t('paiement_etat'),
    'field'  => array('id' => 'numeric',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'numeric'),
  );
  //}}
  $data['gbb_session']['groupe'] = array( 'help' => t('Groupe'),
    //{{
    'title' => t('groupe'),
    'field'  => array('id' => 'numeric',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'numeric'),
  );
  //}}
  $data['gbb_session']['duree_a_payer'] = array( 'help' => t('Duree à payer'),
    //{{
    'title' => t('duree_a_payer'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_session']['duree_prevue'] = array( 'help' => t('Durée prévue'),
    //{{
    'title' => t('duree_prevue'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_session']['session_alert'] = array( 'help' => t('Changement important sur la session BOOL'),
    //{{
    'title' => t('session_alert'),
    'field'  => array('id' => 'numeric',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'numeric'),
  );
  //}}
  $data['gbb_session']['convoc_sent'] = array( 'help' => t('La convocation a été envoyée BOOL'),
    //{{
    'title' => t('convoc_sent'),
    'field'  => array('id' => 'numeric',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'numeric'),
  );
  //}}
  $data['gbb_session']['en_attente'] = array( 'help' => t('La session est en attente BOOL'),
    //{{
    'title' => t('en_attente'),
    'field'  => array('id' => 'numeric',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'numeric'),
  );
  //}}
  $data['gbb_session']['status'] = array( 'help' => t('0=>Play, 1=>EnAttente, 2=>Alerte, 3=>Envoyé'),
    //{{
    'title' => t('status'),
    'field'  => array('id' => 'numeric',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'numeric'),
  );
  //}}
  $data['gbb_session']['de_info'] = array( 'help' => t('Info textuelle pour DE-DAFOR'),
    //{{
    'title' => t('de_info'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_session']['ficand'] = array( 'help' => t('La session est Ficand BOOL'),
    //{{
    'title' => t('ficand'),
    'field'  => array('id' => 'numeric',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'numeric'),
  );
  //}}
  $data['gbb_session']['co_lieu'] = array( 'help' => t('Code lieu (RNE)'),
  //{{ *** GBB_NETAB_DAFOR intégré
    'title' => t('co_lieu'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  $data['gbb_netab_dafor_session']['table'] = array( 'group' => t('gbb_session'),
    'join' => array(
      'gbb_gmodu' => array(
        'table' => 'gbb_netab_dafor',
        'left_table' => 'gbb_session',
        'left_field' => 'co_lieu',
        'field' => 'co_lieu',
      ),
    ),
  );
  //}}
  $data['gbb_netab_dafor_session']['denom_comp'] = array( 'help' => t('Nom Etablissement'),
  //{{
    'title' => t('denom_comp'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_netab_dafor_session']['sigle'] = array( 'help' => t('Sigle (CLG, LYC,...)'),
  //{{
    'title' => t('sigle'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_session']['co_resp'] = array( 'help' => t('Id formateur'),
  //{{
    'title' => t('co_resp'),
    'field'  => array('id' => 'numeric',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'numeric'),
  );
  //}}
  //{{ *** GBB_GRESP_DAFOR intégré
  $data['gbb_gresp_dafor_peda']['nomu'] = array( 'help' => t('Nom du formateur'),
    'title' => t('nomu'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gresp_dafor_peda']['table'] = array( 'group' => t('gbb_session'),
  //{{
    'join' => array(
      'gbb_gmodu' => array(
        'table' => 'gbb_gresp_dafor',
        'left_table' => 'gbb_session',
        'left_field' => 'co_resp',
        'field' => 'co_resp',
        // 'extra' => 'gbb_gresp_dafor_peda.co_degre = gbb_gmodu.co_degre',
      ),
    ),
  );
  //}}
  $data['gbb_gresp_dafor_peda']['prenom'] = array( 'help'   => t('Prenom du formateur'),
    //{{
    'title'  => t('prenom'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gresp_dafor_peda']['tel'] = array( 'help'   => t('telephone du formateur'),
    //{{
    'title'  => t('tel'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gresp_dafor_peda']['mel'] = array( 'help'   => t('Email du formateur'),
    //{{
    'title'  => t('mel'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  //{{ *** GBB_GRESP_PLUS intégré
  $data['gbb_gresp_plus']['table'] = array( 'group' => t('gbb_session'),
    'join' => array(
      'gbb_gmodu' => array(
        'table' => 'gbb_gresp_plus',
        'left_table' => 'gbb_session',
        'left_field' => 'co_resp',
        'field' => 'co_resp',
        // 'extra' => 'gbb_gresp_plus.co_degre = gbb_gmodu.co_degre',
      ),
    ),
  );
  //}}
  $data['gbb_gresp_plus']['resp_dafor'] = array( 'help'   => t('Resp DAFOR du formateur'),
    //{{
    'title'  => t('resp_dafor'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gresp_plus']['decharge'] = array( 'help'   => t('Décharge du formateur'),
    //{{
    'title'  => t('Décharge'),
    'field'  => array('id' => 'numeric',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'numeric'),
  );
  //}}
  $data['gbb_gresp_plus']['discipline'] = array( 'help'   => t('Discipline du formateur'),
    //{{
    'title'  => t('Discipline'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gresp_plus']['grade'] = array( 'help'   => t('Grade du formateur'),
    //{{
    'title'  => t('grade'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gresp_plus']['divers'] = array( 'help'   => t('Divers rensignements sur le formateur'),
    //{{
    'title'  => t('divers'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gresp_plus']['statut'] = array( 'help'   => t('Statut du formateur (ESPE...)'),
    //{{
    'title'  => t('statut'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gresp_plus']['disc_exercice'] = array( 'help'   => t('Discipline d exercice'),
    //{{
    'title'  => t('disc_exercice'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gresp_plus']['disc_interv'] = array( 'help'   => t('Discipline d intervention'),
    //{{
    'title'  => t('disc_interv'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gresp_plus']['champ_interv'] = array( 'help'   => t('Champ d intervention'),
    //{{
    'title'  => t('champ_interv'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gresp_plus']['transv_interv'] = array( 'help'   => t('Domaine transversal d intervention'),
    //{{
    'title'  => t('transv_interv'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gresp_plus']['resp_dafor'] = array( 'help'   => t('resp_dafor'),
    //{{
    'title'  => t('resp_dafor'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  //{{ *** GBB_GRESP_PERIODIC intégré
  $data['gbb_gresp_periodic']['table'] = array( 'group' => t('gbb_session'),
    'join' => array(
      'gbb_gmodu' => array(
        'table' => 'gbb_gresp_periodic',
        'left_table' => 'gbb_session',
        'left_field' => 'co_resp',
        'field' => 'co_resp',
        // 'extra' => 'gbb_gresp_plus.co_degre = gbb_gmodu.co_degre',
      ),
    ),
  );
  //}}
  $data['gbb_gresp_periodic']['period'] = array( 'help' => t('Période scolaire'),
  //{{
    'title'  => t('Période'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gresp_periodic']['type'] = array( 'help' => t('Type d\'info'),
  //{{
    'title'  => t('Type d\'info'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gresp_periodic']['val'] = array( 'help' => t('Valeur'),
  //{{
    'title'  => t('Valeur'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  //}}

  // ********************************************************
  // * gbb_gcamo + gpers ** et toutes ses colonnes
  // ********************************************************
  //{{
  $data['gbb_gcamo']['table'] = array( 'group' => t('gbb_gcamo'),
  //{{
    'join' => array(
      'gbb_gmodu' => array(
        'left_field' => 'co_modu',
        'field' => 'co_modu',
      ),
    ),
  );
  //}}
  $data['gbb_gpers']['table'] = array( 'group' => t('gbb_gcamo'),
  //{{
    'join' => array(
      'gbb_gmodu' => array(
        'left_table' => 'gbb_gcamo',
        'left_field' => 'no_matr',
        'field' => 'no_matr',
        'extra' => 'gbb_gpers.co_degre = gbb_gmodu.co_degre',
      ),
    ),
  );
  //}}
  $data['gbb_gaffe']['table'] = array( 'group' => t('gbb_gcamo'),
  //{{
    'join' => array(
      'gbb_gmodu' => array(
        'left_table' => 'gbb_gpers',
        'left_field' => 'no_matr',
        'field' => 'no_matr',
        'extra' => 'gbb_gaffe.co_degre = gbb_gmodu.co_degre',
      ),
    ),
  );
  //}}
  $data['gbb_netab_affe']['table'] = array( 'group' => t('gbb_gcamo'),
  //{{
    'join' => array(
      'gbb_gmodu' => array(
        'table' => 'gbb_netab',
        'left_table' => 'gbb_gaffe',
        'left_field' => 'co_lieu',
        'field' => 'co_lieu',
      ),
    ),
  );
  //}}


  $data['gbb_netab_affe']['sigle'] = array( 'help' => t('Sigle etab affectation'),
  //{{
    'title'  => t('sigle'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_netab_affe']['denom_comp'] = array( 'help' => t('Nom etab affectation'),
  //{{
    'title'  => t('denom_comp'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gaffe']['flag_princ'] = array( 'help' => t('Flag affectation principale O/N'),
  //{{
    'title'  => t('flag_princ'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gaffe']['co_lieu'] = array( 'help' => t('Code lieu affectation'),
  //{{
    'title'  => t('gaffe.co_lieu'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gaffe']['flag_princ'] = array( 'help' => t('Flag affectation principale O/N'),
  //{{
    'title'  => t('flag_princ'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}

  $data['gbb_gcamo']['no_matr'] = array( 'help' => t('No matricule candidat retenu'),
  //{{
    'title' => t('no_matr'),
    'field'  => array('id' => 'numeric',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'numeric'),
  );
  //}}
  $data['gbb_gcamo']['retenu'] = array( 'help' => t('Retenu R/N'),
  //{{
    'title'  => t('retenu'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gpers']['nomu'] = array( 'help' => t('Nom du candidat retenu'),
  //{{
    'title'  => t('nomu'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gpers']['prenom'] = array( 'help' => t('Prénom du candidat retenu'),
  //{{
    'title'  => t('prenom'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gpers']['co_disrec'] = array( 'help' => t('Code disc. de recrutement'),
  //{{
    'title'  => t('co_disrec'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gpers']['mel'] = array( 'help' => t('Email de la personne'),
  //{{
    'title'  => t('mel'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gpers']['co_posi'] = array( 'help' => t('Code position'),
  //{{
    'title'  => t('co_posi'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  //}}

  // ********************************************************
  // * gbb_gsess + gconv ** et toutes ses colonnes
  // ********************************************************
  //{{
  $data['gbb_gsess']['table'] = array( 'group' => t('gbb_gsess'),
  //{{
    'join' => array(
      'gbb_gmodu' => array(
        'left_field' => 'co_modu',
        'field' => 'co_modu',
        'extra' => 'gbb_gsess.co_degre = gbb_gmodu.co_degre',
      ),
    ),
  );
  //}}
  $data['gbb_gconv']['table'] = array( 'group' => t('gbb_gsess'),
  //{{
    'join' => array(
      'gbb_gmodu' => array(
        'left_table' => 'gbb_gsess',
        'left_field' => 'no_sess',
        'field' => 'no_sess',
        // 'extra' => 'gbb_gconv.co_degre = gbb_gsess.co_degre',
      ),
    ),
  );
  //}}
  $data['gbb_gpers_sess']['table'] = array( 'group' => t('gbb_gsess'),
  //{{
    'join' => array(
      'gbb_gmodu' => array(
        'table' => 'gbb_gpers',
        'left_table' => 'gbb_gconv',
        'left_field' => 'no_matr',
        'field' => 'no_matr',
        'extra' => 'gbb_gpers_sess.co_degre = gbb_gmodu.co_degre',
      ),
    ),
  );
  //}}

  $data['gbb_gsess']['no_sess'] = array( 'help' => t('no_sess'),
  //{{
    'title' => t('no_sess'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gsess']['dt_deb'] = array( 'help' => t('Date début'),
  //{{
    'title' => t('dt_deb'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gsess']['dt_fin'] = array( 'help' => t('Date fin'),
  //{{
    'title' => t('dt_fin'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gsess']['hm_deb'] = array( 'help' => t('Heure début'),
  //{{
    'title' => t('hm_deb'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gsess']['hm_fin'] = array( 'help' => t('Heure fin'),
  //{{
    'title' => t('hm_fin'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gsess']['nb_hr'] = array( 'help' => t('Nbre d heures'),
  //{{
    'title' => t('nb_hr'),
    'field'  => array('id' => 'numeric',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'numeric'),
    'argument' => array('id' => 'numeric'),
  );
  //}}
  $data['gbb_gsess']['no_groupe'] = array( 'help' => t('Numéro de groupe'),
  //{{
    'title' => t('no_groupe'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gsess']['co_lieu'] = array( 'help' => t('Code lieu'),
  //{{
    'title' => t('co_lieu'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gsess']['commentaire'] = array( 'help' => t('Commentaire'),
  //{{
    'title' => t('commentaire'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gsess']['observation'] = array( 'help' => t('Observation'),
  //{{
    'title' => t('observation'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gpers_sess']['nomu'] = array( 'help' => t('nomu'),
  //{{
    'title' => t('nomu'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gpers_sess']['prenom'] = array( 'help' => t('prenom'),
  //{{
    'title' => t('prenom'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gpers_sess']['mel'] = array( 'help' => t('mail de la personne'),
  //{{
    'title' => t('mel'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  //}}

  // ********************************************************
  // * gbb_netab_dafor ** et toutes ses colonnes
  // ********************************************************
  //{{
  $data['gbb_netab_dafor']['table'] = array( 'group' => t('gbb_netab_dafor'),
  //{{
    'base' => array(
      'database' => $gaia_db,
      'field' => 'co_lieu',
      'title' => t('GaiaBB Etab'),
      'help'  => t('Tables du module GaiaBB.'),
      // 'extra' => 'gbb_netab_dafor.co_lieu NOT LIKE "0"',
    ),
  );
  //}}

  $data['gbb_netab_dafor']['co_lieu'] = array( 'help' => t('Code etablissement'),
  //{{
    'title'  => t('co_lieu'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_netab_dafor']['denom_comp'] = array( 'help'   => t('Nom établissement'),
    //{{
    'title'  => t('Nom'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_netab_dafor']['sigle'] = array( 'help'   => t('Sigle'),
    //{{
    'title'  => t('Sigle'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_netab_dafor']['cp'] = array( 'help'   => t('Code postal'),
    //{{
    'title'  => t('Code postal'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_netab_dafor']['adr'] = array( 'help'   => t('Adresse'),
    //{{
    'title'  => t('Adresse'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_netab_dafor']['mel'] = array( 'help'   => t('Mel'),
    //{{
    'title'  => t('Mel'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_netab_dafor']['tel'] = array( 'help'   => t('Tel'),
    //{{
    'title'  => t('Tel'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  //}}

  // ********************************************************
  // * gbb_gresp_dafor ** et toutes ses colonnes
  // ********************************************************
  //{{
  $data['gbb_gresp_dafor']['table'] = array( 'group' => t('gbb_gresp_dafor'),
  //{{ *** GBB_GRESP_PLUS intégré
    'base' => array(
      'database' => $gaia_db,
      'field' => 'co_resp',
      'title' => t('GaiaBB Formateurs'),
      'help'  => t('Tables du module GaiaBB.'),
    ),
  );
  $data['gbb_gresp_plus']['table'] = array( 'group' => t('gbb_gresp_dafor'),
    'join' => array(
      'gbb_gresp_dafor' => array(
        'left_field' => 'co_resp',
        'field' => 'co_resp',
      ),
    ),
  );
  $data['gbb_gresp_periodic']['table'] = array( 'group' => t('gbb_gresp_dafor'),
  //{{
    'join' => array(
      'gbb_gresp_dafor' => array(
        'left_field' => 'co_resp',
        'field' => 'co_resp',
      ),
    ),
  );
  //}}

  $data['gbb_gresp_dafor']['co_resp'] = array( 'help' => t('Identifiant du formateur'),
  //{{
    'title'  => t('ID formateur'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gresp_dafor']['nomu'] = array( 'help'   => t('Nom'),
    //{{
    'title'  => t('Nom'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gresp_dafor']['prenom'] = array( 'help'   => t('Prenom'),
    //{{
    'title'  => t('Prenom'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gresp_dafor']['qualite'] = array( 'help'   => t('Qualité'),
    //{{
    'title'  => t('Qualité'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gresp_dafor']['mel'] = array( 'help'   => t('Mel'),
    //{{
    'title'  => t('Mel'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gresp_dafor']['tel'] = array( 'help'   => t('Tel'),
    //{{
    'title'  => t('Tel'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  //}}
  //}}

  // ********************************************************
  // * gbb_gmoof ** et toutes ses colonnes
  // ********************************************************
  //{{
  $data['gbb_gmoof']['table'] = array( 'group' => t('gbb_gmoof'),
  //{{ *** GBB_DIOF intégré
    'base' => array(
      'database' => $gaia_db,
      'field' => 'co_offre',
      'title' => t('GaiaBB Offres'),
      'help'  => t('Tables du module GaiaBB.'),
    ),
  );
  $data['gbb_gdiof']['table'] = array( 'group' => t('gbb_gmoof'),
    'join' => array(
      'gbb_gmoof' => array(
        'left_field' => 'co_offre',
        'field' => 'co_offre',
      ),
    ),
  );
  $data['gbb_gdiof_dafor']['table'] = array( 'group' => t('gbb_gmoof'),
    'join' => array(
      'gbb_gmoof' => array(
        'left_field' => 'co_omodu',
        'field' => 'co_omodu',
      ),
    ),
  );
  $data['gbb_gresp_peda_moof']['table'] = array( 'group' => t('gbb_gmoof'),
    'join' => array(
      'gbb_gmoof' => array(
        'table' => 'gbb_gresp',
        'left_field' => 'co_resp',
        'field' => 'co_resp',
        'extra' => 'gbb_gresp_peda_moof.co_degre = 2'
      ),
    ),
  );
  $data['gbb_grcoof']['table'] = array( 'group' => t('gbb_gmoof'),
    'join' => array(
      'gbb_gmoof' => array(
        'table' => 'gbb_grcoof',
        'left_table' => 'gbb_gdiof',
        'left_field' => 'co_offreur',
        'field' => 'code',
      ),
    ),
  );
  $data['gbb_netab_moof']['table'] = array( 'group' => t('gbb_gmoof'),
    'join' => array(
      'gbb_gmoof' => array(
        'table' => 'gbb_netab',
        'left_field' => 'co_etab_dem',
        'field' => 'co_lieu',
      ),
    ),
  );
  $data['gbb_nobjt_diof']['table'] = array( 'group' => t('gbb_gmoof'),
  //{{
    'join' => array(
      'gbb_gmoof' => array(
        'table' => 'gbb_nobjt',
        'left_table' => 'gbb_gdiof',
        'left_field' => 'co_objt',
        'field' => 'co_objt',
      ),
    ),
  );
  //}}
  $data['gbb_nobjt_diof']['lib_court'] = array( 'help' => t('Objectif : libellé court'),
  //{{
    'title' => t('nobjt.lib_court'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gresp_orga_diof']['table'] = array( 'group' => t('gbb_gmoof'),
    'join' => array(
      'gbb_gmoof' => array(
        'table' => 'gbb_gresp',
        'left_table' => 'gbb_gdiof',
        'left_field' => 'co_resp',
        'field' => 'co_resp',
        'extra' => 'gbb_gresp_orga_diof.co_degre = 2'
      ),
    ),
  );
    $data['gbb_grcoof']['groupe'] = array( 'help' => t('Groupe code_offreur'),
  //{{
    'title' => t('groupe co_offreur'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
    $data['gbb_grcoof']['entree'] = array( 'help' => t('Entree code_offreur'),
  //{{
    'title' => t('Entree co_offreur'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
    $data['gbb_grcoof']['axe'] = array( 'help' => t('Axe code_offreur'),
  //{{
    'title' => t('axe co_offreur'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
    $data['gbb_grcoof']['prio'] = array( 'help' => t('Prio code_offreur'),
  //{{
    'title' => t('prio co_offreur'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}

  //{{ *** GBB_NOIRE intégré
  $data['gbb_norie_gdiof']['table'] = array( 'group' => t('gbb_gmoof'),
    'join' => array(
      'gbb_gmoof' => array(
        'table' => 'gbb_norie',
        'left_table' => 'gbb_gdiof',
        'left_field' => 'co_orie',
        'field' => 'co_orie',
      ),
    ),
  );
  //}}
  $data['gbb_norie_gdiof']['lib_court'] = array( 'help' => t('Orientation : libellé court'),
  //{{
    'title' => t('norie.lib_court'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_norie_gdiof']['lib_long'] = array( 'help' => t('Orientation : libellé long'),
  //{{
    'title' => t('norie.lib_long'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  //}}
  $data['gbb_gresp_peda_moof']['nomu'] = array( 'help' => t('Nom respPéda module offre'),
    //{{
    'title' => t('nomuPeda'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gresp_peda_moof']['prenom'] = array( 'help' => t('Prénom respPéda module offre'),
    //{{
    'title' => t('prenomPeda'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gresp_peda_moof']['qualite'] = array( 'help' => t('QUalite respPéda module offre'),
    //{{
    'title' => t('qualite'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gresp_peda_moof']['organ'] = array( 'help' => t('Organisme respPéda module offre'),
    //{{
    'title' => t('organ'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gresp_orga_diof']['nomu'] = array( 'help' => t('Nom respOrga dispo offre'),
    //{{
    'title' => t('nomuOrga'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gresp_orga_diof']['prenom'] = array( 'help' => t('Prénom respOrga dispo offre'),
    //{{
    'title' => t('prenomOrga'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gresp_orga_diof']['qualite'] = array( 'help' => t('Qualité respOrga dispo offre'),
    //{{
    'title' => t('qualite'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gresp_orga_diof']['organ'] = array( 'help' => t('Organ respOrga dispo offre'),
    //{{
    'title' => t('organ'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_netab_moof']['denom_comp'] = array( 'help' => t('Denomination complémentaire etablissement'),
    //{{
    'title' => t('denom_comp'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_netab_moof']['sigle'] = array( 'help' => t('Sigle etablissement'),
    //{{
    'title' => t('sigle'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_netab_moof']['cp'] = array( 'help' => t('CP etablissement'),
    //{{
    'title' => t('cp'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gmoof']['co_omodu'] = array( 'help' => t('Code module'),
    //{{
    'title' => t('co_omodu'),
    'field'  => array('id' => 'numeric',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'numeric'),
    'argument' => array('id' => 'numeric'),
  );
  //}}
  $data['gbb_gmoof']['libl'] = array( 'help' => t('Libellé long'),
    //{{
    'title' => t('libl'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gmoof']['lcibl'] = array( 'help' => t('Cible'),
    //{{
    'title' => t('cibl'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gmoof']['lform'] = array( 'help' => t('Forme'),
    //{{
    'title' => t('lform'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gmoof']['duree_prev'] = array( 'help' => t('Durée prévue'),
    //{{
    'title' => t('duree_prev'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gmoof']['nb_eff_groupe'] = array( 'help' => t('Effectif groupe'),
    //{{
    'title' => t('nb_eff_groupe'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gmoof']['nb_place_prev'] = array( 'help' => t('Nb places prévues'),
    //{{
    'title' => t('nb_place_prev'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gmoof']['nb_groupe'] = array( 'help' => t('Nbre de groupes'),
    //{{
    'title' => t('nb_groupe'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gmoof']['cout_p_prest'] = array( 'help' => t('Cout prev de prest'),
    //{{
    'title' => t('cout_p_prest'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gmoof']['cout_p_fonc'] = array( 'help' => t('Cout prev de fonc'),
    //{{
    'title' => t('cout_p_fonc'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gmoof']['cout_p_excep'] = array( 'help' => t('Cout prev excep'),
    //{{
    'title' => t('cout_p_excep'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gmoof']['lcont'] = array( 'help' => t('Lcont'),
    //{{
    'title' => t('lcont'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gmoof']['lpeda'] = array( 'help' => t('Libellé pédagogique'),
    //{{
    'title' => t('lpeda'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gmoof']['lmoda'] = array( 'help' => t('Modalité'),
    //{{
    'title' => t('lmoda'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gmoof']['co_moda'] = array( 'help' => t('Code Modalité'),
    //{{
    'title' => t('co_moda'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_nmoda_moof']['table'] = array( 'group' => t('gbb_gmoof'),
  //{{
    'join' => array(
      'gbb_gmoof' => array(
        'table' => 'gbb_nmoda',
        'left_field' => 'co_moda',
        'field' => 'co_moda',
      ),
    ),
  );
  //}}
  $data['gbb_nmoda_moof']['lib_court'] = array( 'help' => t('Modalité : libellé court'),
  //{{
    'title' => t('nmoda.lib_court'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gmoof']['lcomm'] = array( 'help' => t('Commentaires (GAIA)'),
    //{{
    'title' => t('lcomm'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gmoof']['dt_crea'] = array( 'help' => t('Date création'),
    //{{
    'title' => t('dt_crea'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gmoof']['co_etab_dem'] = array( 'help' => t('RNE etab demandeur'),
    //{{
    'title' => t('co_etab_dem'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gdiof']['co_camp'] = array( 'help' => t('Code campagne'),
    //{{
    'title' => t('co_camp'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gdiof']['co_tpla'] = array( 'help' => t('Code type plan'),
    //{{
    'title' => t('co_tpla'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gdiof']['co_offreur'] = array( 'title' => t('co_offreur'),
  //{{
    'help' => t('Code offreur'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gdiof']['co_orie'] = array( 'help' => t('Code orientation'),
    //{{
    'title' => t('co_orie'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gdiof']['lobjt'] = array( 'help' => t('Objectif du didpositif offre'),
    //{{
    'title' => t('lobjt'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gdiof']['libl'] = array( 'help' => t('Libellé du didpositif offre'),
    //{{
    'title' => t('libl'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gdiof']['cle'] = array( 'help' => t('Clé de l offre'),
    //{{
    'title' => t('cle'),
    'field'  => array('id' => 'numeric',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'numeric'),
    'argument' => array('id' => 'numeric'),
  );
  //}}
  $data['gbb_gdiof']['no_offre'] = array( 'help' => t('Numéro de l offre'),
    //{{
    'title' => t('no_offre'),
    'field'  => array('id' => 'numeric',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'numeric'),
    'argument' => array('id' => 'numeric'),
  );
  //}}
  $data['gbb_gdiof_dafor']['nb_hp'] = array( 'help' => t('Heures Poste, sur décharge'),
    //{{
    'title' => t('nb_hp'),
    'field'  => array('id' => 'numeric',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'numeric'),
    'argument' => array('id' => 'numeric'),
  );
  //}}
  $data['gbb_gdiof_dafor']['nb_vac'] = array( 'help' => t('Nbre vacations (dont ex-HSE)'),
    //{{
    'title' => t('nb_vac'),
    'field'  => array('id' => 'numeric',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'numeric'),
    'argument' => array('id' => 'numeric'),
  );
  //}}
  $data['gbb_gdiof_dafor']['nb_gr'] = array( 'help' => t('nombre de groupes prévus'),
    //{{
    'title' => t('nb_gr'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gdiof_dafor']['hors_cdc'] = array( 'help' => t('Hors CDC'),
    //{{
    'title' => t('hors_cdc'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gdiof_dafor']['fofo'] = array( 'help' => t('Formation de formateurs'),
    //{{
    'title' => t('fofo'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gdiof_dafor']['prio_nat'] = array( 'help' => t('Priorité nationale'),
    //{{
    'title' => t('prio_nat'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gdiof_dafor']['prio_aca'] = array( 'help' => t('Priorité académique'),
    //{{
    'title' => t('prio_aca'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gdiof_dafor']['prio_paf'] = array( 'help' => t('Priorité PAF'),
    //{{
    'title' => t('prio_paf'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gdiof_dafor']['offre_cat'] = array( 'help' => t('AP ou Pub Des'),
    //{{
    'title' => t('offre_cat'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gdiof_dafor']['offre_new'] = array( 'help' => t('Offre Nouvelle (p/r an dernier)'),
    //{{
    'title' => t('offre_new'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gdiof_dafor']['comment'] = array( 'help' => t('Observations'),
    //{{
    'title' => t('Comment'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gdiof_dafor']['interdisc'] = array( 'help' => t('interdisc'),
    //{{
    'title' => t('interdisc'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gdiof_dafor']['iufm'] = array( 'help' => t('Offreur specifique)'),
    //{{
    'title' => t('iufm'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gdiof_dafor']['nouv_offreur'] = array( 'help' => t('Nouv. ofreur (O/N)'),
    //{{
    'title' => t('nouv_offreur'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gdiof_dafor']['pub_des'] = array( 'help' => t('Public désigné'),
    //{{
    'title' => t('pub_des'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gdiof_dafor']['position'] = array( 'help' => t('Position'),
    //{{
    'title' => t('position'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gdiof_dafor']['taux'] = array( 'help' => t('taux'),
    //{{
    'title' => t('taux'),
    'field'  => array('id' => 'numeric',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'numeric'),
    'argument' => array('id' => 'numeric'),
  );
  //}}
  $data['gbb_gdiof_dafor']['prio_nat'] = array( 'help' => t('prio_nat'),
    //{{
    'title' => t('prio_nat tabjaune'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gdiof_dafor']['intm'] = array( 'help' => t('intm'),
    //{{
    'title' => t('intm'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gdiof_dafor']['prox'] = array( 'help' => t('prox'),
    //{{
    'title' => t('prox'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gdiof_dafor']['entm'] = array( 'help' => t('entm'),
    //{{
    'title' => t('entm'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gdiof_dafor']['ht2'] = array( 'help' => t('ht2'),
    //{{
    'title' => t('ht2'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gdiof_dafor']['anim_peda'] = array( 'help' => t('anim_peda'),
    //{{
    'title' => t('anim_peda'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gdiof_dafor']['ecarte'] = array( 'help' => t('ecarte'),
    //{{
    'title' => t('ecarte'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gdiof_dafor']['ptrim'] = array( 'help' => t('ptrim'),
    //{{
    'title' => t('ptrim'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gdiof_dafor']['oral'] = array( 'help' => t('oral'),
    //{{
    'title' => t('oral'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gdiof_dafor']['coint'] = array( 'help' => t('coint'),
    //{{
    'title' => t('co-intervention'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gdiof_dafor']['coe'] = array( 'help' => t('coe'),
    //{{
    'title' => t('chef d oeuvre'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gdiof_dafor']['evalu'] = array( 'help' => t('evalu'),
    //{{
    'title' => t('evaluation'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gdiof_dafor']['apl'] = array( 'help' => t('apl'),
    //{{
    'title' => t('apl anim peda lycée'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gdiof_dafor']['hybridable'] = array( 'help' => t('hybridable'),
    //{{
    'title' => t('hybridable'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gdiof_dafor']['echange'] = array( 'help' => t('echange'),
    //{{
    'title' => t('echange'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gdiof_dafor']['commbis'] = array( 'help' => t('commbis'),
    //{{
    'title' => t('commbis'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  //}}


  return $data;
}
