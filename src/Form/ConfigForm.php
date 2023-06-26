<?php

namespace Drupal\sujit_module\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class ConfigForm extends ConfigFormBase {

  const RESULT = "sujit_module.settings";

  public function getFormId() {
    return "sujit_module_settings";
  }

  protected function getEditableConfigNames() {
    return [
      static::RESULT,
    ];
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config(static::RESULT);

    $form['NAME'] = [
      '#type' => 'textfield',
      '#title' => '<span>NAME</span>',
      '#attached' => [
        'library' => [
          'sujit_module/sujit_module_styles',
        ],
      ],
      '#default_value' => $config->get("NAME"),
    ];

    $form['Age'] = [
      '#type' => 'textfield',
      '#title' => 'Age',
      '#default_value' => $config->get("Age"),
    ];

    $form['Place'] = [
      '#type' => 'textfield',
      '#title' => 'Place',
      '#default_value' => $config->get("Place"),
    ];

    $form['Phone'] = [
      '#type' => 'textfield',
      '#title' => 'Phone',
      '#default_value' => $config->get("Phone"),
    ];

    $form['Gender'] = [
      '#type' => 'select',
      '#title' => 'Gender',
      '#options' => [
        'other' => 'other',
        'male' => 'Male',
        'female' => 'Female',
      ],
      '#default_value' => $config->get("Gender"),
    ];

    return parent::buildForm($form, $form_state);
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = $this->config(static::RESULT);

    $config->set("NAME", $form_state->getValue('NAME'));
    $config->set("Age", $form_state->getValue('Age'));
    $config->set("Place", $form_state->getValue('Place'));
    $config->set("Phone", $form_state->getValue('Phone'));
    $config->set("Gender", $form_state->getValue('Gender'));

    $config->save();
  }

}
