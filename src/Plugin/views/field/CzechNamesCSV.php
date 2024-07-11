<?php

/**
 * @file
 * Definition of Drupal\digitalia_muni_view_field\Plugin\views\field\CzechNamesCSV
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
 * @ViewsField("czechnamescsv")
 */
class CzechNamesCSV extends FieldPluginBase {

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
    $medicament = $this->getEntity($values);
    $items = $medicament->get('field_czech_name_identification')->getValue();

    $result = "";
    foreach ($items as $value) {
      if ($result !== "") {
        $result .= " | ";
      }
      
      $name_id = $value['value'];
      if ($name_id) {
        $id = Term::load($name_id);
        $result .= "'" . $id->getName() . "'";
      }
      $result .= ",";

      $certainty_id = $value['value1'];
      if ($certainty_id) {
        $certainty = Term::load($certainty_id);
        $result .= "'" . $certainty->getName() . "'";
      }
      $result .= ",";

      $user_id = $value['value2'];
      if ($user_id) {
        $user = Node::load($user_id);
        $result .= "'" . $user->getTitle() . "'";
      }
      $result .= ",";

      $note = $value['value3'];
      if ($note) {
        $result .= "'" . $note . "'";
      }
    }

    return $this->t($result);
  }

}
