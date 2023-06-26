<?php

namespace Drupal\sujit_module\Commands;

use Consolidation\OutputFormatters\StructuredData\RowsOfFields;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drush\Commands\DrushCommands;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Defines Drush commands for Sujit module.
 *
 * @package Drupal\sujit_module\Commands
 */
class SujitModuleCommands extends DrushCommands {

  /**
   * The entity type manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityManager;

  /**
   * Constructs a new SujitModuleCommands object.
   *
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entityTypeManager
   *   The entity type manager.
   */
  public function __construct(EntityTypeManagerInterface $entityTypeManager) {
    $this->entityManager = $entityTypeManager;
  }

  /**
   * Creates a new SujitModuleCommands object.
   *
   * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
   *   The container instance.
   *
   * @return \Drupal\sujit_module\Commands\SujitModuleCommands
   *   The instantiated SujitModuleCommands object.
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('entity_type.manager')
    );
  }

  /**
   * Returns the titles of all nodes of type "page".
   *
   * @command sujit-module:get-titles
   * @aliases sm-gt
   *
   * @return \Consolidation\OutputFormatters\StructuredData\RowsOfFields
   *   The titles of all nodes of type "page".
   *
   * @usage drush sujit-module:get-titles
   *   Returns the titles of all nodes of type "page".
   */
  public function getTitles() {
    $nodes = $this->entityManager->getStorage('node')->loadByProperties(['type' => 'page']);
    $rows = [];
    foreach ($nodes as $node) {
      $rows[] = [
        'id' => $node->id(),
        'title' => $node->getTitle(),
      ];
    }
    return new RowsOfFields($rows);
  }

}
