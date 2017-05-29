<?php

/**
 * Elasticsearch class.
 *
 * @category   apps
 * @package    elasticsearch
 * @subpackage libraries
 * @author     eGloo <team@egloo.ca>
 * @copyright  2017 Marc Laporte
 * @license    http://www.gnu.org/copyleft/lgpl.html GNU Lesser General Public License version 3 or later
 * @link       https://www.egloo.ca
 */

///////////////////////////////////////////////////////////////////////////////
// N A M E S P A C E
///////////////////////////////////////////////////////////////////////////////

namespace clearos\apps\elasticsearch;

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
// D E P E N D E N C I E S
///////////////////////////////////////////////////////////////////////////////

// Classes
//--------

use \clearos\apps\base\Daemon as Daemon;
use \clearos\apps\base\File as File;

clearos_load_library('base/Daemon');
clearos_load_library('base/File');

// Exceptions
//-----------

use \clearos\apps\base\File_No_Match_Exception as File_No_Match_Exception;
use \clearos\apps\base\File_Not_Found_Exception as File_Not_Found_Exception;

clearos_load_library('base/File_No_Match_Exception');
clearos_load_library('base/File_Not_Found_Exception');

///////////////////////////////////////////////////////////////////////////////
// C L A S S
///////////////////////////////////////////////////////////////////////////////

/**
 * Elasticsearch class.
 *
 * @category   apps
 * @package    elasticsearch
 * @subpackage libraries
 * @author     eGloo <team@egloo.ca>
 * @copyright  2017 Marc Laporte
 * @license    http://www.gnu.org/copyleft/lgpl.html GNU Lesser General Public License version 3 or later
 * @link       https://www.egloo.ca
 */

class Elasticsearch extends Daemon
{
    const FILE_JVM_CONFIG = '/etc/elasticsearch/jvm.options';
    const MEMORY_DEFAULT = 2;

    /**
     * Elasticsearch constructor.
     */

    public function __construct()
    {
        clearos_profile(__METHOD__, __LINE__);

        parent::__construct('elasticsearch');
    }

    /**
     * Returns memory settings.
     *
     * @return float memory size
     */

    public function get_memory_setting()
    {
        clearos_profile(__METHOD__, __LINE__);

        $file = new File(self::FILE_JVM_CONFIG, TRUE);

        try {
            $raw_line = $file->lookup_line('/^-Xmx/');
        } catch (File_Not_Found_Exception $e) {
        } catch (File_No_Match_Exception $e) {
        }

        if (empty($raw_line))
            return self::MEMORY_DEFAULT;

        $full_size = preg_replace('/^-Xmx/', '', $raw_line);

        $size = preg_replace('/[a-zA-Z]$/', '', $full_size);
        $unit = preg_replace('/^[0-9]*/', '', $full_size);

        if ($unit == 'm')
            $size = $size / 1000;
        else if ($unit != 'g')
            $size = self::MEMORY_DEFAULT;
        
        return $size;
    }
}
