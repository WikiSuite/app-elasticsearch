<?php

/**
 * Elasticsearch controller.
 *
 * @category   apps
 * @package    elasticsearch
 * @subpackage controllers
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
// C L A S S
///////////////////////////////////////////////////////////////////////////////

/**
 * Elasticsearch controller.
 *
 * @category   apps
 * @package    elasticsearch
 * @subpackage controllers
 * @author     eGloo <team@egloo.ca>
 * @copyright  2017 Marc Laporte
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License version 3 or later
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

        $this->load->library('base/Stats');
        $this->load->library('elasticsearch/Elasticsearch');
        $this->lang->load('elasticsearch');

        // Load view data
        //---------------

        try {
            $data['required'] = $this->elasticsearch->get_memory_setting();
            $data['available'] = $this->stats->get_mem_size();
            // Allow a 5% buffer on memory limit
            $needs_ram = ($data['available'] < (0.95) * $data['required']) ? TRUE : FALSE;
        } catch (Exception $e) {
            $this->page->view_exception($e);
            return;
        }

        // Load views
        //-----------

        if ($needs_ram) {
            $this->page->view_form('elasticsearch/memory', $data, lang('base_memory'));
        } else {
            $views = array('elasticsearch/server', 'elasticsearch/settings', 'elasticsearch/policy');
            $this->page->view_forms($views, lang('elasticsearch_app_name'));
        }
    }
}
