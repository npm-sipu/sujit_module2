<?php

namespace Drupal\sujit_module\Event;

// Used as base class.
use Drupal\Component\EventDispatcher\Event;
// To get user details.
use Drupal\user\UserInterface;

/**
 * Event that is fired when a user logs in.
 */
class UserLoginEvent extends Event {
  // Extending the base class
  // This makes it easier for subscribers to reliably use our event name.
  const EVENT_NAME = 'sujit_module_user_login';

  /**
   * The user account.
   *
   * @var \Drupal\user\UserInterface
   */
  public $account;

  /**
   * Constructs the object.
   *
   * @param \Drupal\user\UserInterface $account
   *   The account of the user logged in.
   */
  public function __construct(UserInterface $account) {
    // Will return the user account.
    $this->account = $account;
  }

}
