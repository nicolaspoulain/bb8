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
  public static function logAndDsm($severity = 'info', $type = 'Oups', $table='none', $condition = array(), $entry = array()) {

    if ($severity == 'info') {
    \Drupal::logger('BB')->info('%type (%table) %condition </br> %entry', array(
        '%type'  => $type,
        '%table' => $table,
        // '%condition' => urldecode(http_build_query($condition,'',', ')),
        '%condition' => urldecode(http_build_query($condition,'',', ')),
        '%entry' => urldecode(http_build_query($entry,'',', ')),
      )
    );
    drupal_set_message( t('%type:%table ~ %condition // %entry', array(
        '%type'  => $type,
        '%table' => $table,
        '%condition' => urldecode(http_build_query($condition,'',', ')),
        '%entry' => urldecode(http_build_query($entry,'',', ')),
      )
    ));
    } elseif ($severity = 'error') {
    \Drupal::logger('BB')->error('%type ~~~ %entry', array(
        '%type'  => $type,
        '%entry' => http_build_query($entry,'',', '),
      )
    );
    drupal_set_message(
      t('%type ~~~ %entry', array(
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
    // switch database (cf settings.php)
    \Drupal\Core\Database\Database::setActiveConnection('external');
    // Build query
    $create = db_insert($table)
        ->fields($entry);

    // Execute query if possible
    try {
      $create->execute();
    }
    catch (\PDOException $e) {
      self::logAndDsm('error', 'Catch PDOException : '. (string) $e, NULL, NULL, NULL);
    }
    catch (DatabaseExceptionWrapper $e) {
      self::logAndDsm('error', 'Catch DatabaseExceptionWrapper : '. (string) $e, NULL, NULL, NULL);
    }
    catch (\Exception $e) {
      self::logAndDsm('error', 'Catch Exception : '. (string) $e, NULL, NULL, NULL);
    }

    \Drupal\Core\Database\Database::setActiveConnection();
    self::logAndDsm('info', 'create', $table, $condition, $entry); // Logger and message
    return TRUE;
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
    // switch database (cf settings.php)
    \Drupal\Core\Database\Database::setActiveConnection('external');

    // Get prec values for comparison
    $old = BbCrudController::load($table, $condition);
    $old = (array) $old[0];
    foreach ($entry as $field=>$value) {
      $entry_old[$field.'x'] = $old[$field];
    }
    // Build update query
    $query = \Drupal::database()->update($table)->fields($entry);
    foreach ($condition as $field => $value) {
      $query->condition($field, $value);
    }
    try {
      $query->execute();
    }
    catch (\PDOException $e) {
      self::logAndDsm('error', 'Catch PDOException : '. (string) $e, NULL, NULL, NULL);
    }
    catch (DatabaseExceptionWrapper $e) {
      self::logAndDsm('error', 'Catch DatabaseExceptionWrapper : '. (string) $e, NULL, NULL, NULL);
    }
    catch (\Exception $e) {
      self::logAndDsm('error', 'Catch Exception : '. (string) $e, NULL, NULL, NULL);
    }

    self::logAndDsm('info', 'update', $table, $condition, array_merge($entry,$entry_old)); // Logger and message
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
      self::logAndDsm('error', 'Catch PDOException : '. (string) $e, NULL, NULL, NULL);
    }
    catch (DatabaseExceptionWrapper $e) {
      self::logAndDsm('error', 'Catch DatabaseExceptionWrapper : '. (string) $e, NULL, NULL, NULL);
    }
    catch (\Exception $e) {
      self::logAndDsm('error', 'Catch Exception : '. (string) $e, NULL, NULL, NULL);
    }

    self::logAndDsm('info', 'delete', $table, $condition, NULL);
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
    \Drupal\Core\Database\Database::setActiveConnection('external');
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
      self::logAndDsm('error', 'Catch PDOException : '. (string) $e, NULL, NULL, NULL);
    }
    catch (DatabaseExceptionWrapper $e) {
      self::logAndDsm('error', 'Catch DatabaseExceptionWrapper : '. (string) $e, NULL, NULL, NULL);
    }
    catch (\Exception $e) {
      self::logAndDsm('error', 'Catch Exception : '. (string) $e, NULL, NULL, NULL);
    }
    \Drupal\Core\Database\Database::setActiveConnection();
    return $result;
  }
}
