<?php

declare(strict_types=1);

namespace Drupal\digitalia_muni_view_field\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\digitalia_muni_view_field\Plugin\Field\FieldType\GlossesItem;

/**
 * Plugin implementation of the 'digitalia_muni_field_glosses_table' formatter.
 *
 * @FieldFormatter(
 *   id = "digitalia_muni_field_glosses_table",
 *   label = @Translation("Table"),
 *   field_types = {"digitalia_muni_field_glosses"},
 * )
 */
final class GlossesTableFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode): array {
    if ($items->isEmpty()) {
      return [];
    }

    # $header[] = '#';
    $header[] = $this->t('Language', [], ['context' => 'Glosses']);
    $header[] = $this->t('Type', [], ['context' => 'Glosses']);
    $header[] = $this->t('Gloss');

    $table = [
      '#type' => 'table',
      '#header' => $header,
      '#cache'  => [
        'contexts' => ['languages:language_interface', 'languages:language_content'],
      ],
    ];

    foreach ($items as $delta => $item) {
      $row = [];

      # $row[]['#markup'] = $delta + 1;

      if ($item->language) {
        $allowed_values = GlossesItem::allowedLanguageValues();
        $row[]['#markup'] = $allowed_values[$item->language];
      }
      else {
        $row[]['#markup'] = '';
      }

      if ($item->type) {
        $allowed_values = GlossesItem::allowedTypeValues();
        $row[]['#markup'] = $allowed_values[$item->type];
      }
      else {
        $row[]['#markup'] = '';
      }

      $row[]['#markup'] = $item->gloss;

      $table[$delta] = $row;
    }

    return [$table];
  }

}
