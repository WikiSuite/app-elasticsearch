<?php

/////////////////////////////////////////////////////////////////////////////
// General information
/////////////////////////////////////////////////////////////////////////////

$app['basename'] = 'elasticsearch';
$app['version'] = '1.0.0';
$app['release'] = '1';
$app['vendor'] = 'eGloo';
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
// Packaging
/////////////////////////////////////////////////////////////////////////////

$app['core_requires'] = array(
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
    'app-elasticsearch-core',
    'elasticsearch',
);
