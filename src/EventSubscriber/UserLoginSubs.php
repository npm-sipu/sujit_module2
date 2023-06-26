<?php

namespace Drupal\sujit_module\EventSubscriber;

use Drupal\sujit_module\Event\UserLoginEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Drupal\Core\Database\Connection;
use Drupal\Core\Datetime\DateFormatterInterface;
use Drupal\Core\Messenger\MessengerInterface;

class UserLoginSubs implements EventSubscriberInterface {
  protected $database;
  protected $dateFormatter;
  protected $messenger;

  public function __construct(Connection $database, DateFormatterInterface $dateFormatter, MessengerInterface $messenger) {
    $this->database = $database;
    $this->dateFormatter = $dateFormatter;
    $this->messenger = $messenger;
  }

  public static function getSubscribedEvents() {
    return [
      UserLoginEvent::EVENT_NAME => 'onUserLogin',
    ];
  }

  public function onUserLogin(UserLoginEvent $event) {
    $account_created = $this->database->select('users_field_data', 'ud')
      ->fields('ud', ['created'])
      ->condition('ud.uid', $event->account->id())
      ->execute()
      ->fetchField();

    $this->messenger->addStatus(t('Welcome to the site, your account was created on %created_date.', [
      '%created_date' => $this->dateFormatter->format($account_created, 'long'),
    ]));
  }
}
