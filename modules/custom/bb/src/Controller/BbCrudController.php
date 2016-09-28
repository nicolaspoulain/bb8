<?php

/**
 * @file
 * Contains \Drupal\bb\Form\BbCrudController
 */

namespace Drupal\bb\Controller;

class BbCrudController {

  /**
   * SEND MESSAGE to logger and message status bar
   *
   * @param string $severity
   *   info, error
   *
   * @param string $type
   *   message type (create, update, delete)
   *
   * @param array $entry
   *   An array containing all the fields used
   */
  public static function logAndDsm($severity = 'info', $type = 'Oups', $entry = array()) {

    if ($severity == 'info') {
    \Drupal::logger('BB')->info('%type --- %entry', array(
        '%type'  => $type,
        '%entry' => http_build_query($entry,'',', '),
      )
    );
    drupal_set_message( t('%type --- %entry', array(
        '%type'  => $type,
        '%entry' => http_build_query($entry,'',', '),
      )
    ));
    } elseif ($severity = 'error') {
    \Drupal::logger('BB')->error('%type --- %entry', array(
        '%type'  => $type,
        '%entry' => http_build_query($entry,'',', '),
      )
    );
    drupal_set_message(
      t('%type --- %entry', array(
        '%type'  => $type,
        '%entry' => http_build_query($entry,'',', '),
        )
      ),'error');
    };
  }

  /**
   * CREATE a new entry in the database.
   *
   * @param sring $table
   *   The table we are working on
   *
   * @param array $entry
   *   An array containing all the fields of the item to be updated.
   */
  public static function create($table = 'NaN', $entry) {
    // Build query
    $create = db_insert($table)
        ->fields($entry);

    // Execute query if possible
    try {
      $create->execute();
      self::logAndDsm('info', 'create', $entry); // Logger and message
      return TRUE;
    }
    // Message if query fails
    catch (\Exception $e) {
      self::logAndDsm('error', $e->getMessage, array($e->query_string));
      return FALSE;
    }
  }

  /**
   * UPDATE an entry in the database.
   *
   * @param array $entry
   *   An array containing all the fields of the item to be updated.
   *
   * @return int
   *   The number of updated rows.
   *
   * @see db_update()
   */
  public static function update($table = 'NaN', $entry, $condition) {
    // Build query
    $update = db_update($table)
      ->fields($entry);
    foreach ($condition as $field => $value) {
      $update->condition($field, $value);
    }

    try {
      $update->execute();
      self::logAndDsm('info', 'update', $entry);
      return TRUE;
    }
    catch (\Exception $e) {
      self::logAndDsm('error', $e->getMessage, array($e->query_string));
      return FALSE;
    }
  }

  /**
   * DELETE from the database using a filter array.
   *
   * @param string $table
   *   The table we are worrking on.
   *
   * @param array $entry
   *   An array containing all the fields used to search the entries in the
   *   table.
   *
   * @return object
   *   An object containing the loaded entries if found.
   */
  public static function delete($table = 'NaN', $entry = array()) {
    // Build query
    $delete = db_delete($table);
    foreach ($entry as $field => $value) {
      $delete->condition($field, $value);
    }

    try {
      $delete->execute();
      self::logAndDsm('info', 'delete', $entry);
      return TRUE;
    }
    catch (\Exception $e) {
      self::logAndDsm('error', $e->getMessage, array($e->query_string));
      return FALSE;
    }
  }


  /**
   * READ from the database using a filter array.
   *
   * @param string $table
   *   The table we are worrking on.
   *
   * @param array $entry
   *   An array containing all the fields used to search the entries in the
   *   table.
   *
   * @return object
   *   An object containing the loaded entries if found.
   */
  public static function load($table, $entry = array()) {
    // Build query
    $select = db_select($table,'t');
    $select->fields('t');
    foreach ($entry as $field => $value) {
      $select->condition($field, $value);
    }

    try {
      return $select->execute()->fetchAll();
    }
    catch (\Exception $e) {
      drupal_set_message(t('db_read failed. Message = %message, query= %query', array(
            '%message' => $e->getMessage(),
            '%query' => $e->query_string,
          )), 'error');
      return FALSE;
      self::logAndDsm('error', $e->getMessage, array($e->query_string));
      return FALSE;
    }
  }
}
