<?php

namespace Drupal\sujit_module;

// Namespace of custom service file.
use Drupal\Core\Config\ConfigFactory;

/**
 * Class CustomService.
 *
 * @package Drupal\sujit_module
 */
class CustomService {
  // Creating class.

  /**
   * Configuration Factory.
   *
   * @var \Drupal\Core\Config\ConfigFactory
   */
  protected $configFactory;

  /**
   * Constructor.
   */
  public function __construct(ConfigFactory $configFactory) {
    // Assigning the $configFactory variable.
    $this->configFactory = $configFactory;
  }

  /**
   * Gets my setting.
   *
   * @return string
   *   The name from the config form.
   */
  public function getName() {
    // To retrieve the 'NAME' value from the config form.
    $config = $this->configFactory->get('sujit_module.settings');
    // Return the name.
    return $config->get('NAME');
  }

}
