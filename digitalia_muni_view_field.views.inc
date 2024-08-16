<?php

/**
 * @file
 * Primary module hooks for digitalia_muni_view_field module.
 */

/**
 * Implements hook_views_data().
 */

/**
 * Implements hook_views_data_alter().
 */
function digitalia_muni_view_field_views_data_alter(array &$data) {
  //\Drupal::logger('data view field')->notice(print_r($data, True));
  //var_dump($data);
  $data['node']['modernmedicamentscsv'] = array(
    'title' => t('Modern names of medicaments CSV'),
    'group' => t('Content'),
    'field' => array(
      'title' => t('Modern names of medicaments CSV'),
      'help' => t('Digitalia muni view field'),
      'id' => 'modernmedicamentscsv',
    ),
  );
  $data['node']['glosesscsv'] = array(
    'title' => t('Herbal entry gloses CSV'),
    'group' => t('Content'),
    'field' => array(
      'title' => t('Herbal entry gloses CSV'),
      'help' => t('Digitalia muni view field'),
      'id' => 'glosesscsv',
    ),
  );
  $data['node']['bibliographicref'] = array(
    'title' => t('Formated bibliographic reference'),
    'group' => t('Content'),
    'field' => array(
      'title' => t('Formated bibliographic reference'),
      'help' => t('Digitalia muni view field'),
      'id' => 'bibliographicref',
    ),
  );
  $data['node']['bibliographicrefcsv'] = array(
    'title' => t('Formated bibliographic reference for CSV'),
    'group' => t('Content'),
    'field' => array(
      'title' => t('Formated bibliographic reference for CSV'),
      'help' => t('Digitalia muni view field'),
      'id' => 'bibliographicrefcsv',
    ),
  );
  $data['taxonomy_term_data']['bibliographicref'] = array(
    'title' => t('Formated bibliographic reference'),
    'group' => t('Taxonomy term'),
    'field' => array(
      'title' => t('Formated bibliographic reference'),
      'help' => t('Digitalia muni view field'),
      'id' => 'bibliographicref',
    ),
  );
  $data['taxonomy_term_data']['taxonomybibliographicrefcsv'] = array(
    'title' => t('Formated bibliographic reference for CSV'),
    'group' => t('Taxonomy term'),
    'field' => array(
      'title' => t('Formated bibliographic reference for CSV'),
      'help' => t('Digitalia muni view field'),
      'id' => 'taxonomybibliographicrefcsv',
    ),
  );
  $data['node__field_foliation']['work_in_manuscript'] = array(
    'title' => t('Custom folition sort'),
    'group' => t('Content'),
    'help' => t('Sort by first numeric value in foliation notation'),
    'sort' => array(
      'field' => 'field_foliation_value', // column name in node__field_foliation table?
      'id' => 'sortfoliation',
    ),
  );
}
