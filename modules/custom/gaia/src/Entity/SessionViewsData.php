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
