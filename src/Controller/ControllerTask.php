<?php

namespace Drupal\sujit_module\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Extending base class.
 */
class ControllerTask extends ControllerBase {

  /**
   * Function.
   */
  public function nodeTitle(Node $node) {
    if (!empty($node)) {
      $title = $node->getTitle();
      return [
        '#markup' => $title,
      ];
    }
    else {
      throw new NotFoundHttpException();
    }
  }

  /**
   * Function.
   */
  public function titleCallback(Node $node) {
    $prepend_text = "node of ";
    return $prepend_text . $node->getTitle();
  }

  /**
   * Limit access to the clone according to their restricted state.
   *
   * @param \Drupal\Core\Session\AccountInterface $account
   *   The account object.
   * @param int $node
   *   The node id.
   *
   * @return \Drupal\Core\Access\AccessResultAllowed|\Drupal\Core\Access\AccessResultForbidden
   *   If allowed, AccessResultAllowed isAllowed() will be TRUE. If forbidden,
   *   isForbidden() will be TRUE.
   */
  public function cloneNode(AccountInterface $account, $node) {
    $node = Node::load($node);
    $type_id = $node->bundle();
    if ($account->hasPermission("clone $type_id contents")) {
      $result = AccessResult::allowed();
    }
    else {
      $result = AccessResult::forbidden();
    }
    $result->addCacheableDependency($node);

    return $result;
  }

}
