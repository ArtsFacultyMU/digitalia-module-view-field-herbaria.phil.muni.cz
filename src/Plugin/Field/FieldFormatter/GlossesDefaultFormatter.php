<?php

declare(strict_types=1);

namespace Drupal\digitalia_muni_view_field\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\digitalia_muni_view_field\Plugin\Field\FieldType\GlossesItem;

/**
 * Plugin implementation of the 'digitalia_muni_field_glosses_default' formatter.
 *
 * @FieldFormatter(
 *   id = "digitalia_muni_field_glosses_default",
 *   label = @Translation("Default"),
 *   field_types = {"digitalia_muni_field_glosses"},
 * )
 */
final class GlossesDefaultFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings(): array {
    return ['foo' => 'bar'] + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state): array {
    $element['foo'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Foo'),
      '#default_value' => $this->getSetting('foo'),
    ];
    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary(): array {
    return [
      $this->t('Foo: @foo', ['@foo' => $this->getSetting('foo')]),
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode): array {
    $element = [];

    foreach ($items as $delta => $item) {

      if ($item->language) {
        $allowed_values = GlossesItem::allowedLanguageValues();
        $element[$delta]['language'] = [
          '#type' => 'item',
          '#title' => $this->t('Language'),
          '#markup' => $allowed_values[$item->language],
        ];
      }

      if ($item->type) {
        $allowed_values = GlossesItem::allowedTypeValues();
        $element[$delta]['type'] = [
          '#type' => 'item',
          '#title' => $this->t('Type'),
          '#markup' => $allowed_values[$item->type],
        ];
      }

      if ($item->gloss) {
        $element[$delta]['gloss'] = [
          '#type' => 'item',
          '#title' => $this->t('Gloss'),
          '#markup' => $item->gloss,
        ];
      }

    }

    return $element;
  }

}
