<?php

declare(strict_types=1);

namespace Drupal\digitalia_muni_view_field\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\digitalia_muni_view_field\Plugin\Field\FieldType\GlossesItem;

/**
 * Plugin implementation of the 'digitalia_muni_field_glosses_key_value' formatter.
 *
 * @FieldFormatter(
 *   id = "digitalia_muni_field_glosses_key_value",
 *   label = @Translation("Key-value"),
 *   field_types = {"digitalia_muni_field_glosses"},
 * )
 */
final class GlossesKeyValueFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode): array {

    $element = [];

    foreach ($items as $delta => $item) {
      $table = [
        '#type' => 'table',
      ];

      // Language.
      if ($item->language) {
        $allowed_values = GlossesItem::allowedLanguageValues();

        $table['#rows'][] = [
          'data' => [
            [
              'header' => TRUE,
              'data' => [
                '#markup' => $this->t('Language'),
              ],
            ],
            [
              'data' => [
                '#markup' => $allowed_values[$item->language],
              ],
            ],
          ],
          'no_striping' => TRUE,
        ];
      }

      // Type.
      if ($item->type) {
        $allowed_values = GlossesItem::allowedTypeValues();

        $table['#rows'][] = [
          'data' => [
            [
              'header' => TRUE,
              'data' => [
                '#markup' => $this->t('Type'),
              ],
            ],
            [
              'data' => [
                '#markup' => $allowed_values[$item->type],
              ],
            ],
          ],
          'no_striping' => TRUE,
        ];
      }

      // Gloss.
      if ($item->gloss) {
        $table['#rows'][] = [
          'data' => [
            [
              'header' => TRUE,
              'data' => [
                '#markup' => $this->t('Gloss'),
              ],
            ],
            [
              'data' => [
                '#markup' => $item->gloss,
              ],
            ],
          ],
          'no_striping' => TRUE,
        ];
      }

      $element[$delta] = $table;
    }

    return $element;
  }

}
