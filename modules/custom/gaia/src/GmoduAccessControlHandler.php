<?php

namespace Drupal\gaia;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Gmodu entity.
 *
 * @see \Drupal\gaia\Entity\Gmodu.
 */
class GmoduAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\gaia\Entity\GmoduInterface $entity */
    switch ($operation) {
      case 'view':
        // if (!$entity->isPublished()) {
          // return AccessResult::allowedIfHasPermission($account, 'view unpublished gmodu entities');
        // }
        return AccessResult::allowedIfHasPermission($account, 'view published gmodu entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit gmodu entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete gmodu entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add gmodu entities');
  }

}
