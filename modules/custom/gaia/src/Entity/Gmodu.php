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

    $fields['co_anmo'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('co_anmo'))
      ->setDescription(t('Code annulation du module'))
      ->setReadOnly(TRUE);

    $fields['co_degre'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('co_degre'))
      ->setDescription(t('Degré du module'))
      ->setReadOnly(TRUE);

    $fields['co_type'] = BaseFieldDefinition::create('string')
      ->setLabel(t('co_type'))
      ->setDescription(t('Type du module'))
      ->setReadOnly(TRUE);

    $fields['lib'] = BaseFieldDefinition::create('string')
      ->setLabel(t('lib'))
      ->setDescription(t('Libelle court du module'))
      ->setReadOnly(TRUE);

    $fields['lcont'] = BaseFieldDefinition::create('string')
      ->setLabel(t('lcont'))
      ->setDescription(t('Contenu littéral du module'))
      ->setReadOnly(TRUE);

    $fields['lpeda'] = BaseFieldDefinition::create('string')
      ->setLabel(t('lpeda'))
      ->setDescription(t('Objectif pédagogique du module'))
      ->setReadOnly(TRUE);

    $fields['lmoda'] = BaseFieldDefinition::create('string')
      ->setLabel(t('lmoda'))
      ->setDescription(t('Modalité du module'))
      ->setReadOnly(TRUE);

    $fields['lform'] = BaseFieldDefinition::create('string')
      ->setLabel(t('lform'))
      ->setDescription(t('Forme du module'))
      ->setReadOnly(TRUE);

    $fields['lcibl'] = BaseFieldDefinition::create('string')
      ->setLabel(t('lcibl'))
      ->setDescription(t('Public cible'))
      ->setReadOnly(TRUE);

    $fields['dt_crea'] = BaseFieldDefinition::create('string')
      ->setLabel(t('dt_crea'))
      ->setDescription(t('Date création'))
      ->setReadOnly(TRUE);

    $fields['co_cibl'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('co_cibl'))
      ->setDescription(t('Code du public cible'))
      ->setReadOnly(TRUE);

    $fields['co_etab_dem'] = BaseFieldDefinition::create('string')
      ->setLabel(t('co_etab_dem'))
      ->setDescription(t('RNE de l etablissement demandeur'))
      ->setReadOnly(TRUE);

    $fields['co_prna'] = BaseFieldDefinition::create('string')
      ->setLabel(t('co_prna'))
      ->setDescription(t('Code Priorite national'))
      ->setReadOnly(TRUE);

    $fields['co_prac'] = BaseFieldDefinition::create('string')
      ->setLabel(t('co_prac'))
      ->setDescription(t('Code Priorite academique'))
      ->setReadOnly(TRUE);

    $fields['cout_p_prest'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('cout_p_prest'))
      ->setDescription(t('Coût prévisionnel de prestation par groupe'))
      ->setReadOnly(TRUE);

    $fields['cout_p_fonc'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('cout_p_fonc'))
      ->setDescription(t('Coût prévisionnel de fonctionnement par groupe'))
      ->setReadOnly(TRUE);

    $fields['cout_p_excep'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('cout_p_excep'))
      ->setDescription(t('Coût prévisionnel des frais exceptionnels'))
      ->setReadOnly(TRUE);

    $fields['nb_groupe'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('nb_groupe'))
      ->setDescription(t('Nombre de groupes possibles'))
      ->setReadOnly(TRUE);

    $fields['nb_eff_groupe'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('nb_eff_groupe'))
      ->setDescription(t('Effectif par groupe'))
      ->setReadOnly(TRUE);

    $fields['duree_prev'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('duree_prev'))
      ->setDescription(t('Duree prevue'))
      ->setReadOnly(TRUE);

    $fields['nb_place_prev'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('nb_place_prev'))
      ->setDescription(t('Nombre de places prévues'))
      ->setReadOnly(TRUE);

    $fields['nb_h_interv'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('nb_h_interv'))
      ->setDescription(t('Nombre heures intervention'))
      ->setReadOnly(TRUE);



    return $fields;
  }
}
?>
