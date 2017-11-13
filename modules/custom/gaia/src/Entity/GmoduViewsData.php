<?php
# vim: foldmarker={{,}} foldlevel=0 foldmethod=marker :

namespace Drupal\gaia\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Gmodu entities.
 */
class GmoduViewsData extends EntityViewsData {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    // Additional information for Views integration, such as table joins, can be
    // put here.

    // ********************************************************
    // * gbb_gmodu ** et toutes ses colonnes + sessions spéciales
    // ********************************************************
    $data['gbb_nprna']['table'] = array( 'group' => t('gbb_gmodu'),
    //{{ *** GBB_NPRNA intégré
      'join' => array(
        'gbb_gmodu' => array(
          'left_field' => 'co_prna',
          'field' => 'co_prna',
        ),
      ),
    );
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
    $data['gbb_nprac']['table'] = array( 'group' => t('gbb_gmodu'),
    //{{ *** GBB_NPRAC intégré
      'join' => array(
        'gbb_gmodu' => array(
          'left_field' => 'co_prac',
          'field' => 'co_prac',
        ),
      ),
    );
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


    return $data;
  }

}
