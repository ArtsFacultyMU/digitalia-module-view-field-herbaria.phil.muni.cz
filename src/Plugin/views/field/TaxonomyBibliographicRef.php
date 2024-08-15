<?php

/**
 * @file
 * Definition of Drupal\digitalia_muni_view_field\Plugin\views\field\TaxonomyBibliographicRef
 */

namespace Drupal\digitalia_muni_view_field\Plugin\views\field;

use Drupal\Core\Form\FormStateInterface;
use Drupal\node\Entity\Node;
use Drupal\taxonomy\Entity\Term;
use Drupal\views\Plugin\views\field\FieldPluginBase;
use Drupal\views\ResultRow;

/**
 * Field handler to flag the node type.
 *
 * @ingroup views_field_handlers
 *
 * @ViewsField("taxonomybibliographicref")
 */
class TaxonomyBibliographicRef extends FieldPluginBase {

  /**
   * @{inheritdoc}
   */
  public function query() {
    // Leave empty to avoid a query on this field.
  }

  /**
   * Define the available options
   * @return array
   */
  protected function defineOptions() {
    $options = parent::defineOptions();
    return $options;
  }

  /**
   * Provide the options form.
   */
  public function buildOptionsForm(&$form, FormStateInterface $form_state) {
    parent::buildOptionsForm($form, $form_state);
  }

  /**
   * @{inheritdoc}
   */
  public function render(ResultRow $values) {
    $row = $this->getEntity($values);
    $items = $row->get('field_bibliography')->getValue();

    $urlregex = "(https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|www\.[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9]+\.[^\s]{2,}|www\.[a-zA-Z0-9]+\.[^\s]{2,})";
    $result = "";

    foreach ($items as $value) {
      $result .= "<p>";

      $item = $value['reference'];
      if ($item) {
        if (is_string($item)) {
          $ref = Node::load($item);
        } else {
          $ref = Node::load($item->id());
        }
        $result .= $ref->field_citation->processed;
      }

      $note = $value['note'];
      if ($note) {
        $result .= " " . preg_replace_callback($urlregex, function($matches) {
          $url = $matches[0];
          return '<a href="' . $url . '" target="_blank">' . $url . '</a>';
        }, $note);
      }

      $result .= "</p>";
    }
    return $this->t($result);
  }

}
