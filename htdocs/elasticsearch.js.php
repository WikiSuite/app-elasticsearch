<?php

/**
 * Elasticserach ajax helpers.
 *
 * @category   apps
 * @package    elasticsearch
 * @subpackage javascript
 * @author     eGloo <team@egloo.ca>
 * @copyright  2017 Marc Laporte
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License version 3 or later
 */

///////////////////////////////////////////////////////////////////////////////
//
// This program is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program.  If not, see <http://www.gnu.org/licenses/>.  
//
///////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////
// B O O T S T R A P
///////////////////////////////////////////////////////////////////////////////

$bootstrap = getenv('CLEAROS_BOOTSTRAP') ? getenv('CLEAROS_BOOTSTRAP') : '/usr/clearos/framework/shared';
require_once $bootstrap . '/bootstrap.php';

///////////////////////////////////////////////////////////////////////////////
// T R A N S L A T I O N S
///////////////////////////////////////////////////////////////////////////////

clearos_load_language('elasticsearch');

///////////////////////////////////////////////////////////////////////////////
// J A V A S C R I P T
///////////////////////////////////////////////////////////////////////////////

header('Content-Type:application/x-javascript');
?>

///////////////////////////////////////////////////////////////////////////
// M A I N
///////////////////////////////////////////////////////////////////////////

$(document).ready(function() {
    $('#elasticsearch_not_running').hide();
    $('#elasticsearch_running').hide();

    clearosGetElasticsearchStatus();
});


// Functions
//----------

function clearosGetElasticsearchStatus() {
    $.ajax({
        url: '/app/elasticsearch/server/status',
        method: 'GET',
        dataType: 'json',
        success : function(payload) {
            handleElasticsearchForm(payload);
            window.setTimeout(clearosGetElasticsearchStatus, 1000);
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            window.setTimeout(clearosGetElasticsearchStatus, 1000);
        }
    });
}

function handleElasticsearchForm(payload) {
    if (payload.status == 'running') {
        $('#elasticsearch_running').show();
        $('#elasticsearch_not_running').hide();
    } else {
        $('#elasticsearch_running').hide();
        $('#elasticsearch_not_running').show();
    }
}

// vim: syntax=javascript
