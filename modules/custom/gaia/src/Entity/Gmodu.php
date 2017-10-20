<?php

namespace Drupal\gaia\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Entity\ContentEntityInterface;

/**
 * Defines the Gmodu entity.
 *
 * @ingroup gaia
 *
 * @ContentEntityType(
 *   id = "gmodu",
 *   label = @Translation("Gmodu"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\gaia\GmoduListBuilder",
 *     "views_data" = "Drupal\gaia\Entity\GmoduViewsData",
 *
 *     "form" = {
 *       "default" = "Drupal\gaia\Form\GmoduForm",
 *       "add" = "Drupal\gaia\Form\GmoduForm",
 *       "edit" = "Drupal\gaia\Form\GmoduForm",
 *       "delete" = "Drupal\gaia\Form\GmoduDeleteForm",
 *     },
 *     "access" = "Drupal\gaia\GmoduAccessControlHandler",
 *     "route_provider" = {
 *       "html" = "Drupal\gaia\GmoduHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "gbb_gmodu",
 *   admin_permission = "administer gmodu entities",
 *   entity_keys = {
 *     "id" = "mid",
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/gmodu/{gmodu}",
 *     "add-form" = "/admin/structure/gmodu/add",
 *     "edit-form" = "/admin/structure/gmodu/{gmodu}/edit",
 *     "delete-form" = "/admin/structure/gmodu/{gmodu}/delete",
 *     "collection" = "/admin/structure/gmodu",
 *   },
 *   field_ui_base_route = "gmodu.settings"
 * )
 */

class Gmodu extends ContentEntityBase implements ContentEntityInterface {

  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {

    // Standard field, used as unique if primary index.
    $fields['mid'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('module ID'))
      ->setDescription(t('The ID of the gmodu entity.'))
      ->setReadOnly(TRUE);

    $fields['co_disp'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('co_disp'))
      ->setDescription(t('Code interne du dispositif'))
      ->setReadOnly(TRUE);

    $fields['co_modu'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('co_modu'))
      ->setDescription(t('Code du module'))
      ->setReadOnly(TRUE);

    $fields['co_type'] = BaseFieldDefinition::create('string')
      ->setLabel(t('co_type'))
      ->setDescription(t('Type du module'))
      ->setReadOnly(TRUE);

    $fields['lib'] = BaseFieldDefinition::create('string')
      ->setLabel(t('lib'))
      ->setDescription(t('Libelle court du module'))
      ->setReadOnly(TRUE);


    return $fields;
  }
}
?>
