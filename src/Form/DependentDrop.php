<?php

namespace Drupal\sujit_module\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class DependentDrop extends FormBase {

  public function getFormId() {
    return 'dependent_dropdown_Form';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $options = $this->getLocationOptions();
    $category = $form_state->getValue('category') ?: 'none';
    $state = $form_state->getValue('state') ?: 'none';

    $form['category'] = [
      '#type' => 'select',
      '#title' => 'Category',
      '#options' => $options,
      '#default_value' => $category,
      '#ajax' => [
        'callback' => '::dropdownCallback',
        'wrapper' => 'field-container',
        'event' => 'change',
      ],
    ];

    $form['state'] = [
      '#type' => 'select',
      '#title' => 'State',
      '#options' => static::getStateOptions($category),
      '#default_value' => !empty($form_state->getValue('state')) ? $form_state->getValue('state') : 'none',
      '#prefix' => '<div id="field-container"',
      '#suffix' => '</div>',
      '#ajax' => [
        'callback' => '::dropdownCallback',
        'wrapper' => 'district-container',
        'event' => 'change',
      ],
    ];

    $form['district'] = [
      '#type' => 'select',
      '#title' => 'District',
      '#options' => static::getDistrictOptions($state),
      '#default_value' => !empty($form_state->getValue('district')) ? $form_state->getValue('district') : '',
      '#prefix' => '<div id="district-container"',
      '#suffix' => '</div>',
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => 'Submit',
    ];

    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $trigger = (string) $form_state->getTriggeringElement()['#value'];
    if ($trigger != 'submit') {
      $form_state->setRebuild();
    }
  }

  public function dropdownCallback(array &$form, FormStateInterface $form_state) {
    $triggering_element = $form_state->getTriggeringElement();
    $triggering_element_name = $triggering_element['#name'];

    if ($triggering_element_name === 'category') {
      return $form['state'];
    }
    elseif ($triggering_element_name === 'state') {
      return $form['district'];
    }
  }

  public function getLocationOptions() {
    return [
      'none' => '-none-',
      'country1' => 'Country 1',
      'country2' => 'Country 2',
    ];
  }

  public function getStateOptions($category) {
    switch ($category) {
      case 'country1':
        $options = [
          'state1' => 'State 1',
          'state2' => 'State 2',
        ];
        break;

      case 'country2':
        $options = [
          'state3' => 'State 3',
          'state4' => 'State 4',
        ];
        break;

      default:
        $options = ['none' => '-none-'];
        break;
    }
    return $options;
  }

  public function getDistrictOptions($state) {
    switch ($state) {
      case 'state1':
        $options = [
          'district1' => 'District 1',
          'district2' => 'District 2',
        ];
        break;

      case 'state2':
        $options = [
          'district3' => 'District 3',
          'district4' => 'District 4',
        ];
        break;

      case 'state3':
        $options = [
          'district5' => 'District 5',
          'district6' => 'District 6',
        ];
        break;

      case 'state4':
        $options = [
          'district7' => 'District 7',
          'district8' => 'District 8',
        ];
        break;

      default:
        $options = ['none' => '-none-'];
        break;
    }
    return $options;
  }

}
