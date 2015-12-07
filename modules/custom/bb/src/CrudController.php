<?php

/**
 * @file
 * Contains \Drupal\bb\CrudController
 */

namespace Drupal\bb;

class CrudController {

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
}
