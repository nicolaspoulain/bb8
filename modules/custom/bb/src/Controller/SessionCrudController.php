<?php

/**
 * @file
 * Contains \Drupal\bb\Form\SessionCrudController
 */

namespace Drupal\bb\Controller;

class SessionCrudController {

  /**
   * READ from the database using a filter array.
   *
   * @param array $entry
   *   An array containing all the fields used to search the entries in the
   *   table.
   *
   * @return object
   *   An object containing the loaded entries if found.
   */
  public static function load($entry = array()) {
    // the following is for "SELECT * FROM bb AS b"
    $select = db_select('gbb_session', 's');
    $select->leftJoin('gbb_netab_dafor', 'e', 'e.co_lieu = s.co_lieu');
    $select->leftjoin('gbb_gresp_dafor', 'r',
                             'r.co_resp=s.co_resp AND r.co_degre=s.co_degre');
    $select->fields('s')
           ->fields('e', array('denom_comp', 'sigle'))
           ->fields('r', array('co_resp', 'nomu', 'prenom'))
           ->range(0,5);

    // Add each field and value as a condition to this query.
    foreach ($entry as $field => $value) {
      $select->condition($field, $value);
    }
    // Return the result in object format.
    return $select->execute()->fetchAll();
  }
  
  /**
   * Update an entry in the database.
   *
   * @param array $entry
   *   An array containing all the fields of the item to be updated.
   *
   * @return int
   *   The number of updated rows.
   *
   * @see db_update()
   */
  public static function update($entry) {
    try {
      // db_update()...->execute() returns the status of update process
    $DBWriteStatus = db_update('gbb_session')
      ->fields($entry)
      ->condition('sess_id', $entry['sess_id'])
      ->execute();
    }
    catch (\Exception $e) {
      drupal_set_message(t('db_update failed. Message = %message, query= %query', array(
            '%message' => $e->getMessage(),
            '%query' => $e->query_string,
          )), 'error');
      return FALSE;
    }

    $account = \Drupal::currentUser();
    // Logging Framework. loggeur : Database Logging (dblog) [table watchdog]

    $message = 'Session %sessid modifiée';

    \Drupal::logger('BB')->info(
      $message, array(
        '%sessid' => $entry['sessid'],
      )
    );

    drupal_set_message( t($message . ' par %username', array(
        '%sessid' => $entry['sessid'],
        '%username' => $account->getUsername(), 
      ))
    );

    return TRUE;
  }
  /**
   * Insert an entry in the database.
   *
   * @param array $entry
   *   An array containing all the fields of the item to be updated.
   *
   * @return int
   *   The number of updated rows.
   *
   * @see db_update()
   */
  public static function insert($entry) {
    try {
      // db_update()...->execute() returns the status of update process
    $DBWriteStatus = db_insert('gbb_session')
      ->fields($entry)
      ->execute();
    }
    catch (\Exception $e) {
      drupal_set_message(t('db_update failed. Message = %message, query= %query', array(
            '%message' => $e->getMessage(),
            '%query' => $e->query_string,
          )), 'error');
      return FALSE;
    }

    $account = \Drupal::currentUser();

    $message = 'Nouvelle session créee';

    // Logging Framework. loggeur : Database Logging (dblog) [table watchdog]
    \Drupal::logger('BB')->info( $message);

    drupal_set_message( t($message . ' par %username', array(
        '%username' => $account->getUsername(), 
      ))
    );

    return TRUE;
  }

}
