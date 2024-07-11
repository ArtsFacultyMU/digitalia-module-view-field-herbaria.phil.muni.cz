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
}
