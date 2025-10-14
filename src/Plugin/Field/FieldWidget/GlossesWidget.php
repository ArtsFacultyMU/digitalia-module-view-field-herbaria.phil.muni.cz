<?php

declare(strict_types=1);

namespace Drupal\digitalia_muni_view_field\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\digitalia_muni_view_field\Plugin\Field\FieldType\GlossesItem;
use Symfony\Component\Validator\ConstraintViolationInterface;

/**
 * Defines the 'digitalia_muni_field_glosses' field widget.
 *
 * @FieldWidget(
 *   id = "digitalia_muni_field_glosses",
 *   label = @Translation("Glosses"),
 *   field_types = {"digitalia_muni_field_glosses"},
 * )
 */
final class GlossesWidget extends WidgetBase {

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
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state): array {

    $element['language'] = [
      '#type' => 'select',
      '#title' => $this->t('Language', [], ['context' => 'Glosses']),
      '#options' => ['' => $this->t('- None -', [], ['context' => 'Glosses'])] + GlossesItem::allowedLanguageValues(),
      '#default_value' => $items[$delta]->language ?? NULL,
    ];

    $element['type'] = [
      '#type' => 'select',
      '#title' => $this->t('Type', [], ['context' => 'Glosses']),
      '#options' => ['' => $this->t('- None -', [], ['context' => 'Glosses'])] + GlossesItem::allowedTypeValues(),
      '#default_value' => $items[$delta]->type ?? NULL,
    ];

    $element['gloss'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Gloss'),
      '#default_value' => $items[$delta]->gloss ?? NULL,
      '#size' => 20,
    ];

    $element['#theme_wrappers'] = ['container', 'form_element'];
    $element['#attributes']['class'][] = 'container-inline';
    $element['#attributes']['class'][] = 'digitalia-muni-field-glosses-elements';
    $element['#attached']['library'][] = 'digitalia_muni_view_field/digitalia_muni_field_glosses';

    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public function errorElement(array $element, ConstraintViolationInterface $error, array $form, FormStateInterface $form_state): array|bool {
    $element = parent::errorElement($element, $error, $form, $form_state);
    if ($element === FALSE) {
      return FALSE;
    }
    $error_property = explode('.', $error->getPropertyPath())[1];
    return $element[$error_property];
  }

  /**
   * {@inheritdoc}
   */
  public function massageFormValues(array $values, array $form, FormStateInterface $form_state): array {
    foreach ($values as $delta => $value) {
      if ($value['language'] === '') {
        $values[$delta]['language'] = NULL;
      }
      if ($value['type'] === '') {
        $values[$delta]['type'] = NULL;
      }
      if ($value['gloss'] === '') {
        $values[$delta]['gloss'] = NULL;
      }
    }
    return $values;
  }

}
