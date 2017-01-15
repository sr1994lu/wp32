<?php
/**
 * @src 04/10
 */

namespace scottadminadv\classes;

use Smarty;

require_once $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminadv/classes/libs/Smarty.class.php';

/**
 * Class MySmarty.
 */
class MySmarty extends Smarty
{
    /**
     * MySmarty constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->setTemplateDir = $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminadv/templates/';
        $this->setCompileDir = $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/scottadminadv/templates_c/';
    }
}
