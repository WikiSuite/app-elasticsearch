<?php

/////////////////////////////////////////////////////////////////////////////
// General information
/////////////////////////////////////////////////////////////////////////////

$app['basename'] = 'elasticsearch';
$app['version'] = '1.2.6';
$app['release'] = '1';
$app['vendor'] = 'WikiSuite';
$app['packager'] = 'eGloo';
$app['license'] = 'GPLv3';
$app['license_core'] = 'LGPLv3';
$app['description'] = lang('elasticsearch_app_description');
$app['powered_by'] = array(
    'vendor' => array(
        'name' => 'Elastic',
        'url' => 'https://www.elastic.co'
    ),
    'packages' => array(
        'elasticsearch' => array(
            'name' => 'Elasticsearch',
            'version' => '---',
            'url' => 'https://www.elastic.co/products/elasticsearch',
        ),
    ),
);

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
    'adminer-elasticsearch >= 4.3.1',
    'app-elasticsearch-plugin-core',
    'elasticsearch >= 5.4.0',
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
