<?php

namespace Drupal\sujit_module\Plugin\Field\FieldFormatter;

// Namespace for FieldFormatter.
// Used as baseclass.
use Drupal\Core\Field\FormatterBase;
// Interface for field.
use Drupal\Core\Field\FieldItemListInterface;
// Interface for form.
use Drupal\Core\Form\FormStateInterface;

/**
 * Define the "custom field formatter".
 *
 * @FieldFormatter(
 *   id = "custom_field_formatter",
 *   label = @Translation("Custom Field Formatter"),
 *   description = @Translation("Desc for Custom Field Formatter"),
 *   field_types = {
 *     "custom_field_type"
 *   }
 * )
 */
class FieldFormatter extends FormatterBase {
  // Extending the baseclass.

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return [
      'concat' => 'Concat with ',
    // Will return the defaultSettings value.
    ] + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    // Appears on setting of manage display.
    // Creating a form.
    $form['concat'] = [
    // Textfield type.
      '#type' => 'textfield',
    // Title.
      '#title' => 'Concatenate with',
    // Default value is set.
      '#default_value' => $this->getSetting('concat'),
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = [];
    // Will concatenate with @concat
    $summary[] = $this->t("concatenate with : @concat", ["@concat" => $this->getSetting('concat')]);
    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $element = [];

    foreach ($items as $delta => $item) {
      // Delta is for cardinality.
      $element[$delta] = [
      // Will return concat and value submitted in the frontend.
        '#markup' => $this->getSetting('concat') . $item->value,
      ];
    }
    return $element;
  }

}
