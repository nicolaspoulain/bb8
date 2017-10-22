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
    'field'  => array('id' => 'numeric',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'numeric'),
    'argument' => array('id' => 'numeric'),
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
  $data['gbb_gmodu']['lform'] = array( 'help' => t('Forme'),
  //{{
    'title'  => t('lform'),
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
  $data['gbb_gmodu_taxonomy']['table'] = array( 'group' => t('gbb_gmodu'),
  //{{
    'join' => array(
      'gbb_gmodu' => array(
        'left_field' => 'co_modu',
        'field' => 'co_modu',
      ),
    ),
  );
  //}}
  $data['gbb_gmodu_taxonomy']['tid'] = array( 'help' => t('taxonomy id'),
  //{{
    'title' => t('tid'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gmodu_taxonomy']['weight'] = array( 'help' => t('weight'),
  //{{
    'title' => t('weight'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['taxonomy_term_field_data_2']['table'] = array( 'group' => t('gbb_gmodu'),
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
  $data['taxonomy_term_field_data_2']['name'] = array( 'help' => t('Nom du terme de taxonomie'),
  //{{
    'title' => t('name'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['taxonomy_term_field_data_2']['vid'] = array( 'help' => t('Vocabulaire de taxonomie'),
  //{{
    'title' => t('vid'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['taxonomy_term_field_data_2']['description__value'] = array( 'help' => t('Nom abbrégé du terme de taxonomie'),
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
  //{{
    'title'  => t('co_etab_dem'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
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

  //{{ Spécial pour l'affichage des compteurs de sessions
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
        'extra' => 'gbb_session_sent.co_degre = gbb_gmodu.co_degre AND gbb_session_sent.convoc_sent=1',
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
  // session : sess_id d'une session en attente
  // ........................................................
  $data['gbb_session_attente']['table'] = array( 'group' => t('gbb_gmodu'),
    //{{
    'join' => array(
      'gbb_gmodu' => array(
        'table' => 'gbb_session',
        'left_field' => 'co_modu',
        'field' => 'co_modu',
        'extra' => 'gbb_session_attente.co_degre = gbb_gmodu.co_degre AND gbb_session_attente.en_attente=1',
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
  // session : sess_id d'une session en cours
  // ........................................................
  $data['gbb_session_encours']['table'] = array( 'group' => t('gbb_gmodu'),
  //{{
      'join' => array(
      'gbb_gmodu' => array(
        'table' => 'gbb_session',
        'left_field' => 'co_modu',
        'field' => 'co_modu',
        'extra' => 'gbb_session_encours.co_degre = gbb_gmodu.co_degre AND gbb_session_encours.en_attente=0 AND gbb_session_encours.convoc_sent=0',
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
        'left_table' => 'gbb_gdire',
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
        'left_field' => 'co_offre',
        'field' => 'co_offre',
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
  //}}
  $data['gbb_gresp_peda_moof']['nomu'] = array( 'help' => t('Nom respPéda module offre'),
    //{{
    'title' => t('nomuPeda'),
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
  $data['gbb_gmoof']['co_omodu'] = array( 'help' => t('Code module'),
    //{{
    'title' => t('co_omodu'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
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
  $data['gbb_gdiof']['co_orie'] = array( 'help' => t('Code orientation'),
    //{{
    'title' => t('co_orie'),
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
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
  );
  //}}
  $data['gbb_gdiof_dafor']['nb_vac'] = array( 'help' => t('Nbre vacations (dont ex-HSE)'),
    //{{
    'title' => t('nb_vac'),
    'field'  => array('id' => 'standard',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'string'),
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
  //}}


  return $data;
}

