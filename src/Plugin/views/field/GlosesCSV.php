<?php

/**
 * @file
 * Definition of Drupal\digitalia_muni_view_field\Plugin\views\field\GlosesCSV
 */

namespace Drupal\digitalia_muni_view_field\Plugin\views\field;

use Drupal\Core\Form\FormStateInterface;
use Drupal\taxonomy\Entity\Term;
use Drupal\views\Plugin\views\field\FieldPluginBase;
use Drupal\views\ResultRow;

/**
 * Field handler to flag the node type.
 *
 * @ingroup views_field_handlers
 *
 * @ViewsField("glosesscsv")
 */
class GlosesCSV extends FieldPluginBase {

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
    $herbal_entry = $this->getEntity($values);
    $items = $herbal_entry->get('field_gloses')->getValue();

    $result = "";
    foreach ($items as $value) {
      if ($result !== "") {
        $result .= " | ";
      }
      
      $lang_id = $value['language'];
      if ($lang_id) {
        $id = Term::load($lang_id);
        $result .= "'" . $id->getName() . "'";
      }
      $result .= ",";

      $type_id = $value['type'];
      if ($type_id) {
        $type = Term::load($type_id);
        $result .= "'" . $type->getName() . "'";
      }
      $result .= ",";

      $gloss = $value['gloss'];
      if ($gloss) {
        $result .= "'" . $gloss . "'";
      }
    }

    return $this->t($result);
  }

}
