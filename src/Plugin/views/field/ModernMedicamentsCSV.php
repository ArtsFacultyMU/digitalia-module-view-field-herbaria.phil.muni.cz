<?php

/**
 * @file
 * Definition of Drupal\digitalia_muni_view_field\Plugin\views\field\ModernMedicamentsCSV
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
 * @ViewsField("modernmedicamentscsv")
 */
class ModernMedicamentsCSV extends FieldPluginBase {

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
    $items = $herbal_entry->get('field_botanical_identification')->getValue();

    $result = "";
    foreach ($items as $value) {
      if ($result !== "") {
        $result .= " | ";
      }
      
      $plant_id = $value['plant'];
      if ($plant_id) {
        $plant = Term::load($plant_id);
        $result .= "'" . $plant->getName() . "'";
      }
      $result .= ",";

      $certainty_id = $value['certainty'];
      if ($certainty_id) {
        $certainty = Term::load($certainty_id);
        $result .= "'" . $certainty->getName() . "'";
      }
      $result .= ",";

      $user_id = $value['user'];
      if ($user_id) {
        $user = Node::load($user_id);
        $result .= "'" . $user->getTitle() . "'";
      }
      $result .= ",";

      $note = $value['note'];
      if ($note) {
        $result .= "'" . $note . "'";
      }
    }

    return $this->t($result);
  }

}
