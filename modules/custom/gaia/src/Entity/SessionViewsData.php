<?php

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

    $data['session']['co_modu'] = array( 'help' => t('Code module de sess'),
      //{{
      'title' => t('co_modu'),
      'field'  => array('id' => 'numeric',),
      'sort'   => array('id' => 'standard'),
      'filter' => array('id' => 'numeric'),
    );
    //}}
    $data['session']['sess_id'] = array( 'help' => t('Identifiant de sess'),
      //{{
      'title' => t('sess_id'),
      'field'  => array('id' => 'numeric',),
      'sort'   => array('id' => 'standard'),
      'filter' => array('id' => 'numeric'),
    );
    //}}
    $data['session']['type_paiement'] = array( 'help' => t('Type paiement de sess'),
      //{{
      'title' => t('type_paiement'),
      'field'  => array('id' => 'standard',),
      'sort'   => array('id' => 'standard'),
      'filter' => array('id' => 'string'),
    );
    //}}
    $data['session']['paiement_etat'] = array( 'help' => t('Paiement demandé (0/1)'),
      //{{
      'title' => t('paiement_etat'),
      'field'  => array('id' => 'numeric',),
      'sort'   => array('id' => 'standard'),
      'filter' => array('id' => 'numeric'),
    );
    //}}
    $data['session']['groupe'] = array( 'help' => t('Groupe'),
      //{{
      'title' => t('groupe'),
      'field'  => array('id' => 'numeric',),
      'sort'   => array('id' => 'standard'),
      'filter' => array('id' => 'numeric'),
    );
    //}}
    $data['session']['duree_a_payer'] = array( 'help' => t('Duree à payer'),
      //{{
      'title' => t('duree_a_payer'),
      'field'  => array('id' => 'standard',),
      'sort'   => array('id' => 'standard'),
      'filter' => array('id' => 'string'),
    );
    //}}
    $data['session']['ficand'] = array( 'help' => t('sess est Ficand BOOL'),
      //{{
      'title' => t('ficand'),
      'field'  => array('id' => 'numeric',),
      'sort'   => array('id' => 'standard'),
      'filter' => array('id' => 'numeric'),
    );
    //}}

    return $data;
  }

}
