<?php

declare(strict_types=1);

namespace Drupal\digitalia_muni_view_field\Plugin\Field\FieldType;

use Drupal\Component\Utility\Random;
use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Defines the 'digitalia_muni_field_glosses' field type.
 *
 * @FieldType(
 *   id = "digitalia_muni_field_glosses",
 *   label = @Translation("Glosses"),
 *   description = @Translation("Digitalia n-field for representing glosses and their language and their type of recording."),
 *   default_widget = "digitalia_muni_field_glosses",
 *   default_formatter = "digitalia_muni_field_glosses_default",
 * )
 */
final class GlossesItem extends FieldItemBase {

  /**
   * {@inheritdoc}
   */
  public static function defaultFieldSettings(): array {
    $settings = ['bar' => 'example'];
    return $settings + parent::defaultFieldSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function fieldSettingsForm(array $form, FormStateInterface $form_state): array {
    $settings = $this->getSettings();

    $element['bar'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Bar'),
      '#default_value' => $settings['bar'],
    ];

    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public function isEmpty(): bool {
    return $this->language === NULL && $this->type === NULL && $this->gloss === NULL;
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition): array {

    $properties['language'] = DataDefinition::create('string')
      ->setLabel(t('Language'));
    $properties['type'] = DataDefinition::create('string')
      ->setLabel(t('Type'));
    $properties['gloss'] = DataDefinition::create('string')
      ->setLabel(t('Gloss'));

    return $properties;
  }

  /**
   * {@inheritdoc}
   */
  public function getConstraints(): array {
    $constraints = parent::getConstraints();

    $options['language']['AllowedValues'] = array_keys(GlossesItem::allowedLanguageValues());

    $options['type']['AllowedValues'] = array_keys(GlossesItem::allowedTypeValues());

    $options['gloss']['NotBlank'] = [];

    $constraint_manager = \Drupal::typedDataManager()->getValidationConstraintManager();
    $constraints[] = $constraint_manager->create('ComplexData', $options);
    // Add more constraints here if needed.
    return $constraints;
  }

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition): array {

    $columns = [
      'language' => [
        'type' => 'varchar',
        'length' => 255,
      ],
      'type' => [
        'type' => 'varchar',
        'length' => 255,
      ],
      'gloss' => [
        'type' => 'varchar',
        'length' => 255,
      ],
    ];

    $schema = [
      'columns' => $columns,
      // @DCG Add indexes here if necessary.
    ];

    return $schema;
  }

  /**
   * {@inheritdoc}
   */
  public static function generateSampleValue(FieldDefinitionInterface $field_definition): array {

    $random = new Random();

    $values['language'] = array_rand(self::allowedLanguageValues());

    $values['type'] = array_rand(self::allowedTypeValues());

    $values['gloss'] = $random->word(mt_rand(1, 255));

    return $values;
  }

  /**
   * Returns allowed values for 'language' sub-field.
   */
  public static function allowedLanguageValues(): array {
    return [
      'Czech' => t('Czech'),
      'Old Czech' => t('Old Czech'),
      'German' => t('German'),
      'Latin' => t('Latin'),
      'Polish' => t('Polish'),
    ];
  }

  /**
   * Returns allowed values for 'type' sub-field.
   */
  public static function allowedTypeValues(): array {
    return [
      'Transcription' => t('Transcription'),
      'Transliteration' => t('Transliteration'),
    ];
  }

}
