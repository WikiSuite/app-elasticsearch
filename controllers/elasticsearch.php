<?php

/**
 * Elasticsearch controller.
 *
 * @category   apps
 * @package    elasticsearch
 * @subpackage controllers
 * @author     eGloo <team@egloo.ca>
 * @copyright  2016 eGloo
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License version 3 or later
 * @link       https://www.egloo.ca/netify/community
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
// C L A S S
///////////////////////////////////////////////////////////////////////////////

/**
 * Elasticsearch controller.
 *
 * @category   apps
 * @package    elasticsearch
 * @subpackage controllers
 * @author     eGloo <team@egloo.ca>
 * @copyright  2016 eGloo
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License version 3 or later
 * @link       https://www.egloo.ca/netify/community
 */

class Elasticsearch extends ClearOS_Controller
{
    /**
     * Elasticsearch default controller.
     *
     * @return view
     */

    function index()
    {
        // Load dependencies
        //------------------

        $this->lang->load('elasticsearch');

        // Load views
        //-----------

        $this->page->view_form('elasticsearch', NULL, lang('elasticsearch_app_name'));
    }
}
