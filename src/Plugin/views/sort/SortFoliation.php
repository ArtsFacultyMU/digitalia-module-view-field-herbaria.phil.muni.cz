<?php
namespace Drupal\digitalia_muni_view_field\Plugin\views\sort;

use Drupal\views\Plugin\views\sort\SortPluginBase;

/**
 * Basic sort handler for Foliation.
 *
 * @ViewsSort("sortfoliation")
 */
class SortFoliation extends SortPluginBase {
  public function query() {
    $this->ensureMyTable();
   
    $sql = "COALESCE(CAST(REGEXP_SUBSTR($this->tableAlias.$this->realField, '\\\\d+') AS UNSIGNED), 0)";
    
    $this->query->addOrderBy(NULL, // enter null if formula
      $sql, // The field or formula to sort on
      $this->options['order'], // Either ASC or DESC
      $this->realField // alias
    );
  }
}
