<?php

/**
 * @file
 * Contains \Drupal\bb\Form\BbCrudController
 */

namespace Drupal\bb\Controller;

use Drupal\Core\Database\DatabaseExceptionWrapper;
use Drupal\Core\Database\Database;

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
  public static function logAndDsm($severity = 'info', $type = 'Oups', $table='none', $condition = array(), $entry = array(), $entry_old = array()) {

    if ($severity == 'info') {
      \Drupal::logger('BB')->info('%type (%table) %condition </br> %entry </br> %entry_old',
        array(
          '%type'  => $type,
          '%table' => $table,
          '%condition' => urldecode(http_build_query($condition,'',', ')),
          '%entry' => urldecode(http_build_query($entry,'',', ')),
          '%entry_old' => urldecode(http_build_query($entry_old,'',', ')),
        )
      );
    } elseif ($severity = 'error') {
      \Drupal::logger('BB')->error('%type ~~~ %entry',
        array(
          '%type'  => $type,
          '%entry' => http_build_query($condition,'',', '),
        )
      );
      drupal_set_message( t('%type ~~~ %entry',
        array(
          '%type'  => $type,
          '%entry' => http_build_query($condition,'',', '),
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
    // switch database (cf settings.php)
    \Drupal\Core\Database\Database::setActiveConnection('external');
    // Build query
    $create = db_insert($table)
        ->fields($entry);

    // Execute query if possible
    try {
      $id = $create->execute();
    }
    catch (\PDOException $e) {
      self::logAndDsm('error', 'Catch PDOException : '. (string) $e);
    }
    catch (DatabaseExceptionWrapper $e) {
      self::logAndDsm('error', 'Catch DatabaseExceptionWrapper : '. (string) $e);
    }
    catch (\Exception $e) {
      self::logAndDsm('error', 'Catch Exception : '. (string) $e);
    }

    \Drupal\Core\Database\Database::setActiveConnection();
    self::logAndDsm('info', 'create', $table, array(), $entry); // Logger and message
    return $id;
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
    // Get prec values for comparison
    $old = BbCrudController::load($table, $condition);
    $old = (array) $old[0];
    foreach ($entry as $field=>$value) {
      $entry_old[$field] = $old[$field];
    }
    $entry_old['Values']='OLD';

    // switch database (cf settings.php)
    \Drupal\Core\Database\Database::setActiveConnection('external');
    // Get a connection going
    $db = \Drupal\Core\Database\Database::getConnection();
    // Build update query
    $query = $db->update($table)->fields($entry);
    foreach ($condition as $field => $value) {
      $query->condition($field, $value);
    }
    try {
      $query->execute();
    }
    catch (\PDOException $e) {
      self::logAndDsm('error', 'Catch PDOException : '. (string) $e);
    }
    catch (DatabaseExceptionWrapper $e) {
      self::logAndDsm('error', 'Catch DatabaseExceptionWrapper : '. (string) $e);
    }
    catch (\Exception $e) {
      self::logAndDsm('error', 'Catch Exception : '. (string) $e);
    }

    self::logAndDsm('info', 'update', $table, $condition, $entry, $entry_old); // Logger and message
    \Drupal\Core\Database\Database::setActiveConnection();
    return TRUE;
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
  public static function delete($table = 'NaN', $condition = array()) {
    // switch database (cf settings.php)
    \Drupal\Core\Database\Database::setActiveConnection('external');
    // Build query
    $delete = db_delete($table);
    foreach ($condition as $field => $value) {
      $delete->condition($field, $value);
    }

    try {
      $delete->execute();
    }
    catch (\PDOException $e) {
      self::logAndDsm('error', 'Catch PDOException : '. (string) $e);
    }
    catch (DatabaseExceptionWrapper $e) {
      self::logAndDsm('error', 'Catch DatabaseExceptionWrapper : '. (string) $e);
    }
    catch (\Exception $e) {
      self::logAndDsm('error', 'Catch Exception : '. (string) $e);
    }

    self::logAndDsm('info', 'delete', $table, $condition);
    \Drupal\Core\Database\Database::setActiveConnection();
    return TRUE;
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
  public static function load($table, $condition = array()) {
    // switch database (cf settings.php)
    if ( !preg_match('/file/',$table) ) {
    \Drupal\Core\Database\Database::setActiveConnection('external');
    }
    // Build query
    $select = db_select($table,'t');
    $select->fields('t');
    foreach ($condition as $field => $value) {
      $select->condition($field, $value);
    }

    try {
      $result = $select->execute()->fetchAll();
    }
    catch (\PDOException $e) {
      self::logAndDsm('error', 'Catch PDOException : '. (string) $e);
    }
    catch (DatabaseExceptionWrapper $e) {
      self::logAndDsm('error', 'Catch DatabaseExceptionWrapper : '. (string) $e);
    }
    catch (\Exception $e) {
      self::logAndDsm('error', 'Catch Exception : '. (string) $e);
    }
    \Drupal\Core\Database\Database::setActiveConnection();
    return $result;
  }
}
