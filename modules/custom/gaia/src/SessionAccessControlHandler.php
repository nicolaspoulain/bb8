<?php

namespace Drupal\gaia;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Session entity.
 *
 * @see \Drupal\gaia\Entity\Session.
 */
class SessionAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\gaia\Entity\SessionInterface $entity */
    switch ($operation) {
      case 'view':
        // if (!$entity->isPublished()) {
          // return AccessResult::allowedIfHasPermission($account, 'view unpublished session entities');
        // }
        return AccessResult::allowedIfHasPermission($account, 'view published session entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit session entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete session entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add session entities');
  }

}
