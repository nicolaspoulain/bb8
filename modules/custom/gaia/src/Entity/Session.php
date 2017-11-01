<?php
# vim: foldmarker={{,}} foldlevel=0 foldmethod=marker :

namespace Drupal\gaia\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Entity\ContentEntityInterface;

/**
 * Defines the Session entity.
 *
 * @ingroup gaia
 *
 * @ContentEntityType(
 *   id = "session",
 *   label = @Translation("Session"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\gaia\SessionListBuilder",
 *     "views_data" = "Drupal\gaia\Entity\SessionViewsData",
 *
 *     "form" = {
 *       "default" = "Drupal\gaia\Form\SessionForm",
 *       "add" = "Drupal\gaia\Form\SessionForm",
 *       "edit" = "Drupal\gaia\Form\SessionForm",
 *       "delete" = "Drupal\gaia\Form\SessionDeleteForm",
 *     },
 *     "access" = "Drupal\gaia\SessionAccessControlHandler",
 *     "route_provider" = {
 *       "html" = "Drupal\gaia\SessionHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "gbb_session",
 *   admin_permission = "administer session entities",
 *   entity_keys = {
 *     "id" = "sess_id",
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/session/{session}",
 *     "add-form" = "/admin/structure/session/add",
 *     "edit-form" = "/admin/structure/session/{session}/edit",
 *     "delete-form" = "/admin/structure/session/{session}/delete",
 *     "collection" = "/admin/structure/session",
 *   },
 *   field_ui_base_route = "session.settings"
 * )
 */

class Session extends ContentEntityBase implements ContentEntityInterface {

  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {

    // Standard field, used as unique if primary index.
    $fields['sess_id'] = BaseFieldDefinition::create('integer')
  //{{
      ->setLabel(t('session ID'))
      ->setDescription(t('The ID of the session entity.'))
      ->setReadOnly(TRUE);
  //}}
    $fields['co_degre'] = BaseFieldDefinition::create('integer')
  //{{
      ->setLabel(t('co_degre'))
      ->setDescription(t('The degre of the session entity.'))
      ->setReadOnly(TRUE);
  //}}
    $fields['co_modu'] = BaseFieldDefinition::create('integer')
  //{{
      ->setLabel(t('co_modu'))
      ->setDescription(t('The module of the session entity.'))
      ->setReadOnly(TRUE);
  //}}
    $fields['status'] = BaseFieldDefinition::create('list_integer')
  //{{
      ->setLabel(t('Status'))
      ->setDescription(t('Statut de la session'))
      ->setSettings(array(
        'allowed_values' => array(
          '0' => 'pause',
          '1' => 'play',
          '2' => 'flag',
          '3' => 'sent',
        ),
      ))
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'string',
        'weight' => -4,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);
  //}}
    $fields['groupe'] = BaseFieldDefinition::create('integer')
  //{{
      ->setLabel(t('groupe'))
      ->setDescription(t('The groupe of the session entity.'))
      ->setReadOnly(TRUE);
  //}}
    $fields['co_lieu'] = BaseFieldDefinition::create('string')
  //{{
      ->setLabel(t('co_lieu'))
      ->setDescription(t('The co_lieu of the session entity.'))
      ->setReadOnly(TRUE);
  //}}
    $fields['co_resp'] = BaseFieldDefinition::create('integer')
  //{{
      ->setLabel(t('co_resp'))
      ->setDescription(t('The co_resp of the session entity.'))
      ->setReadOnly(TRUE);
  //}}
    $fields['duree_a_payer'] = BaseFieldDefinition::create('decimal')
  //{{
      ->setLabel(t('duree_a_payer'))
      ->setDescription(t('The duree a payer of the session entity.'))
      ->setReadOnly(TRUE);
  //}}
    $fields['date'] = BaseFieldDefinition::create('string')
  //{{
      ->setLabel(t('date'))
      ->setDescription(t('date'))
      ->setSettings(array(
        'max_length' => 20,
      ))
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'string_textfield',
        'settings' => array(
          'size' => 15,
        ),
        'weight' => -4,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);
  //}}
    $fields['date_ts'] = BaseFieldDefinition::create('timestamp')
  //{{
      ->setLabel(t('Date TS'))
      ->setDescription(t('Date de session (timestamp)'))
      ->setSettings(array(
        // 'datetime_type' => 'date',
      ))
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'datetime_timestamp',
        'weight' => -4,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);
  //}}
    $fields['horaires'] = BaseFieldDefinition::create('string')
  //{{
      ->setLabel(t('Horaires'))
      ->setDescription(t('Horaires de session'))
      ->setSettings(array(
        'max_length' => 20,
      ))
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'string_textfield',
        'settings' => array(
          'size' => 15,
        ),
        'weight' => -4,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);
  //}}
    $fields['LE_etat'] = BaseFieldDefinition::create('boolean')
  //{{
      ->setLabel(t('LE_etat'))
      ->setDescription(t('Liste émargement rendue'))
      ->setDisplayOptions('view', array(
        'type' => 'unicode-yes-no',
        'weight' => -4,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'boolean_checkbox',
        'settings' => [
          'display_label' => TRUE,
        ],
        'weight' => -4,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);
  //}}
    $fields['type_paiement'] = BaseFieldDefinition::create('string')
  //{{
      ->setLabel(t('type_paiement'))
      ->setDescription(t('type_paiement'))
      ->setSettings(array(
        'max_length' => 20,
      ))
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'string_textfield',
        'settings' => array(
          'size' => 15,
        ),
        'weight' => -4,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);
  //}}
    $fields['paiement_etat'] = BaseFieldDefinition::create('boolean')
  //{{
      ->setLabel(t('paiement_etat'))
      ->setDescription(t('Paiement lancé'))
      ->setDisplayOptions('view', array(
        'type' => 'unicode-yes-no',
        'weight' => -4,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'boolean_checkbox',
        'settings' => [
          'display_label' => TRUE,
        ],
        'weight' => -4,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);
  //}}
    $fields['ficand'] = BaseFieldDefinition::create('boolean')
  //{{
      ->setLabel(t('ficand'))
      ->setDescription(t('ficand'))
      ->setDisplayOptions('view', array(
        'type' => 'unicode-yes-no',
        'weight' => -4,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'boolean_checkbox',
        'settings' => [
          'display_label' => TRUE,
        ],
        'weight' => -4,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);
  //}}

    return $fields;
  }
}
?>
