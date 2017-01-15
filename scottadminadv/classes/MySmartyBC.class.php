<?php
/**
 * @src 04/10
 */

namespace scottadminadv\classes;

use SmartyBC;

require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminadv/classes/libs/SmartyBC.class.php';

/**
 * Class MySmartyBC.
 */
class MySmartyBC extends \SmartyBC
{
    /**
     * MySmartyBC constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->setTemplateDir = $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminadv/templates/';
        $this->setCompileDir = $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminadv/templates_c/';
    }
}
