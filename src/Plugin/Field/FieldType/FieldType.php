<?php

namespace Drupal\sujit_module\Plugin\Field\FieldType;

// Namespace.
// Used as baseclass.
use Drupal\Core\Field\FieldItemBase;
// Interface is used for storage.
use Drupal\Core\Field\FieldStorageDefinitionInterface;
// Interface is used for form.
use Drupal\Core\Form\FormStateInterface;
// Provides the definition for primitive data types.
use Drupal\Core\TypedData\DataDefinition;

/**
 * Define the "custom field type".
 *
 * @FieldType(
 *   id = "custom_field_type",
 *   label = @Translation("Custom Field Type"),
 *   description = @Translation("Desc for Custom Field Type"),
 *   category = @Translation("Text"),
 *   default_widget = "custom_field_widget",
 *   default_formatter = "custom_field_formatter",
 * )
 */
class FieldType extends FieldItemBase {
  // Extending base class.

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    // Creating a table in the database.
    return [
      'columns' => [
        'value' => [
          'type' => 'varchar',
          'length' => $field_definition->getSetting("length"),
        ],
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public static function defaultStorageSettings() {
    return [
      'length' => 255,
    // Default value for length is set to 255.
    ] + parent::defaultStorageSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function storageSettingsForm(array &$form, FormStateInterface $form_state, $has_data) {
    // Function for storage settings that appears when we add a field.
    $element = [];

    // Length for the field.
    $element['length'] = [
      '#type' => 'number',
    // Title.
      '#title' => t("Length of your text"),
    // Mandatory to be filled.
      '#required' => TRUE,
    // Will return the length value.
      '#default_value' => $this->getSetting("length"),
    ];
    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public static function defaultFieldSettings() {
    // Function to define a default field.
    return [
    // Default value is set.
      'moreinfo' => "More info default value",
    // This returns the default field setting.
    ] + parent::defaultFieldSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function fieldSettingsForm(array $form, FormStateInterface $form_state) {
    $element = [];
    $element['moreinfo'] = [
    // More info of type textfield.
      '#type' => 'textfield',
      '#title' => 'More information about this field',
      '#required' => TRUE,
    // Will return the default value of moreinfo.
      '#default_value' => $this->getSetting("moreinfo"),
    ];
    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    // Function to define field item properties.
    $properties['value'] = DataDefinition::create('string')->setLabel(t("Name"));

    return $properties;
  }

}
