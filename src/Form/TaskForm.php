<?php

namespace Drupal\sujit_module\Form;

// Namespace.
// Using base classes.
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class creation.
 */
class TaskForm extends ConfigFormBase {

  // It gives form id.
  const RESULT = "sujit_module.settings";

  /**
   * To get form id.
   */
  public function getFormId() {
    return "sujit_module_settings";
  }

  /**
   * To get editable names.
   */
  protected function getEditableConfigNames() {
    // To get names.
    return [
      // Static result.
      static::RESULT,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config(static::RESULT);
    $form['helptext'] = [
      '#type' => 'textfield',
      '#title' => 'Help Text',
      '#default_value' => $config->get("helptext"),
    ];

    // Token support.
    if (\Drupal::moduleHandler()->moduleExists('token')) {
      $form['tokens'] = [
        '#title' => $this->t('Tokens'),
        '#type' => 'container',
      ];
      $form['tokens']['help'] = [
        '#theme' => 'token_tree_link',
        '#token_types' => [
          'node',
          'site',
        ],
        // '#token_types' => 'all'
        '#global_types' => FALSE,
        '#dialog' => TRUE,
      ];
    }

    return parent::buildForm($form, $form_state);
  }

  /**
   * Submit form.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // For submit option.
    // Static result.
    $config = $this->config(static::RESULT);
    // To collect values entered.
    $config->set("helptext", $form_state->getValue('helptext'));
    // Saves all fields.
    $config->save();
  }

}
