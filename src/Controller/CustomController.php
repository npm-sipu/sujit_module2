<?php

namespace Drupal\sujit_module\Controller;

// Namespace of this file.
// Use of ControllerBase.
use Drupal\Core\Controller\ControllerBase;
use Drupal\sujit_module\CustomService;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Use of our custom service.
 */
class CustomController extends ControllerBase {

  /**
   * CustomService.
   *
   * @var \Drupal\sujit_module\CustomService
   */
  protected $customService;

  /**
   * Create function.
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('sujit_module.custom_service')
    );
  }

  /**
   * Construct function.
   */
  public function __construct(CustomService $customService) {
    $this->customService = $customService;
  }

  /**
   * Function hello.
   */
  public function hello() {
    // Defining function.
    // Calling our service.
    $data = $this->customService->getName();
    return [
      // Setting theme for this file.
      '#theme' => 'new_template',
      // The rendered name from config form.
      '#markup' => $data,
      // For color.
      '#hexcode' => '#f7f7f7',
    ];
  }

}
