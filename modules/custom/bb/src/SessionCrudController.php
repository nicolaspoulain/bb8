<?php

/**
 * @file
 * Contains \Drupal\bb\CrudController
 */

namespace Drupal\bb;

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
    $select = db_select('gbb_aaa', 'b');
    $select->fields('b');

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
    $DBWriteStatus = db_update('gbb_aaa')
      ->fields($entry)
      ->condition('sessid', $entry['sessid'])
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
    
    \Drupal::logger('BB')->info(
      'UUU -%query - %username (id=%id) is programming a new module',
      array('%username' => $account->getUsername(), 
      '%id' => $account->id(),
      '%query' => $entry['sessid'],
    )
    );

    drupal_set_message(
      t('Your email address is @email- @DBWriteStatus', 
        array('@email' => $entry['sessid'],
        '@DBWriteStatus' => $DBWriteStatus)
      )
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
    $DBWriteStatus = db_insert('gbb_aaa')
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

    // Logging Framework. loggeur : Database Logging (dblog) [table watchdog]
    \Drupal::logger('BB')->info(
      'IIIII %username (id=%id) is programming a new module',
      array('%username' => $account->getUsername(), '%id' => $account->id())
    );

    drupal_set_message(
      t('Your email address is @email- @DBWriteStatus', 
      array('@email' => 'email',
      '@DBWriteStatus' => $DBWriteStatus)
      )
    );

    return TRUE;
  }

}
