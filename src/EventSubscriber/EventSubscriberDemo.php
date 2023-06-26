<?php

namespace Drupal\sujit_module\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Drupal\Core\Config\ConfigEvents;
use Drupal\Core\Config\ConfigCrudEvent;
use Drupal\Core\Messenger\MessengerInterface;

class EventSubscriberDemo implements EventSubscriberInterface {
  protected $messenger;

  public function __construct(MessengerInterface $messenger) {
    $this->messenger = $messenger;
  }

  public static function getSubscribedEvents() {
    $events[ConfigEvents::SAVE][] = ['configSave', -100];
    $events[ConfigEvents::DELETE][] = ['configDelete', 100];
    return $events;
  }

  public function configSave(ConfigCrudEvent $event) {
    $config = $event->getConfig();
    $this->messenger->addMessage('Saved config: ' . $config->getName());
  }

  public function configDelete(ConfigCrudEvent $event) {
    $config = $event->getConfig();
    $this->messenger->addMessage('Deleted config: ' . $config->getName());
  }
}
