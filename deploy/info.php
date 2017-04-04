<?php

/////////////////////////////////////////////////////////////////////////////
// General information
/////////////////////////////////////////////////////////////////////////////

$app['basename'] = 'elasticsearch';
$app['version'] = '1.0.3';
$app['release'] = '1';
$app['vendor'] = 'WikiSuite';
$app['packager'] = 'eGloo';
$app['license'] = 'GPLv3';
$app['license_core'] = 'LGPLv3';
$app['description'] = lang('elasticsearch_app_description');

/////////////////////////////////////////////////////////////////////////////
// App name and categories
/////////////////////////////////////////////////////////////////////////////

$app['name'] = lang('elasticsearch_app_name');
$app['category'] = lang('base_category_server');
$app['subcategory'] = 'Search';

/////////////////////////////////////////////////////////////////////////////
// Controllers
/////////////////////////////////////////////////////////////////////////////

$app['controllers']['elasticsearch']['title'] = $app['name'];
$app['controllers']['settings']['title'] = lang('base_settings');
$app['controllers']['policy']['title'] = lang('base_app_policy');

/////////////////////////////////////////////////////////////////////////////
// Packaging
/////////////////////////////////////////////////////////////////////////////

$app['core_requires'] = array(
    'adminer-elasticsearch',
    'app-elasticsearch-plugin-core',
    'elasticsearch',
    'java',
);

$app['core_directory_manifest'] = array(
    '/var/clearos/elasticsearch' => array(),
    '/var/clearos/elasticsearch/backup' => array(),
);

$app['core_file_manifest'] = array(
    'elasticsearch.php'=> array('target' => '/var/clearos/base/daemon/elasticsearch.php')
);

$app['delete_dependency'] = array(
    'adminer-elasticsearch',
    'app-elasticsearch-plugin-core',
    'app-elasticsearch-core',
    'elasticsearch',
);
