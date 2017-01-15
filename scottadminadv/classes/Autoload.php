<?php
/**
 * @src 02/10
 */

/**
 * @param $classname
 */
function myAutoload($classname)
{
    $filename = str_replace('\\', '/', $classname).'.class.php';
    $filename = $_SERVER['DOCUMENT_ROOT'].'/oh/wp32/'.$filename;

    if (is_file($filename)) {
        require_once $filename;
    }
}

spl_autoload_register('myAutoload');
