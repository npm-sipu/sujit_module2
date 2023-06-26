<?php

namespace Drupal\sujit_module\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Extending base class.
 */
class CustomModal extends ControllerBase {

  /**
   * Modallink funtion.
   */
  public function modalLink() {
    $build['#attached']['library'][] = 'core/drupal.dialog.ajax';
    $build = [
      '#markup' => '<a href="get-details" class="use-ajax" data-dialog-type="modal">Click here</a>',
    ];
    return $build;
  }

}
