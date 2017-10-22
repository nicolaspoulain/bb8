<?php
# vim: foldmarker={{,}} foldlevel=0 foldmethod=marker :

namespace Drupal\gaia\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Session entities.
 */
class SessionViewsData extends EntityViewsData {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    // Additional information for Views integration, such as table joins

  // ********************************************************
  // * gbb_session **  et toutes ses colonnes
  // ********************************************************

  $data['gbb_session']['sess_id'] = array( 'help' => t('Identifiant de la session'),
    //{{
    'title' => t('sess_id'),
    'field'  => array('id' => 'numeric',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'numeric'),
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
  $data['gbb_session']['ficand'] = array( 'help' => t('La session est Ficand BOOL'),
    //{{
    'title' => t('ficand'),
    'field'  => array('id' => 'numeric',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'numeric'),
  );
  //}}
  $data['gbb_session']['co_lieu'] = array( 'help' => t('Code lieu (RNE)'),
  //{{
    'title' => t('co_lieu'),
    'field'  => array('id' => 'numeric',),
    'sort'   => array('id' => 'standard'),
    'filter' => array('id' => 'numeric'),
  );
  //}}
  $data['gbb_session']['co_lieu'] = array( // RELATIONSHIP : GBB_NETAB_DAFOR
  //{{
    'title' => t('Établissement'),
    'help' => t('Établissement'),
    'relationship' => array(
      // Views name of the table to join to for the relationship.
      'base' => 'gbb_netab_dafor',
      // Database field name in the other table to join on.
      'base field' => 'co_lieu',
      'id' => 'standard',
      // Default label for relationship in the UI.
      'label' => t('Établissement'),
    ),
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
  $data['gbb_session']['co_resp'] = array( // RELATIONSHIP : GBB_GRESP_DAFOR
  //{{
    'title' => t('Formateur'),
    'help' => t('Formateur'),
    'relationship' => array(
      // Views name of the table to join to for the relationship.
      'base' => 'gbb_gresp_dafor',
      // Database field name in the other table to join on.
      'base field' => 'co_resp',
      'id' => 'standard',
      // Default label for relationship in the UI.
      'label' => t('Formateur'),
    ),
  );
  //}}


    return $data;
  }

}
