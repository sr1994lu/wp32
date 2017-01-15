<?php

/**
 * Smarty Internal Plugin Resource PHP
 * Implements the file system as resource for PHP templates.
 *
 * @author     Uwe Tews
 * @author     Rodney Rehm
 */
class Smarty_Internal_Resource_Php extends Smarty_Internal_Resource_File
{
    /**
     * Flag that it's an uncompiled resource.
     *
     * @var bool
     */
    public $uncompiled = true;

    /**
     * container for short_open_tag directive's value before executing PHP templates.
     *
     * @var string
     */
    protected $short_open_tag;

    /**
     * Resource does implement populateCompiledFilepath() method.
     *
     * @var bool
     */
    public $hasCompiledHandler = true;

    /**
     * Create a new PHP Resource.
     */
    public function __construct()
    {
        $this->short_open_tag = ini_get('short_open_tag');
    }

    /**
     * Load template's source from file into current template object.
     *
     * @param Smarty_Template_Source $source source object
     *
     * @throws SmartyException if source cannot be loaded
     *
     * @return string template source
     */
    public function getContent(Smarty_Template_Source $source)
    {
        if ($source->exists) {
            return '';
        }
        throw new SmartyException("Unable to read template {$source->type} '{$source->name}'");
    }

    /**
     * Render and output the template (without using the compiler).
     *
     * @param Smarty_Template_Source   $source    source object
     * @param Smarty_Internal_Template $_template template object
     *
     * @throws SmartyException if template cannot be loaded or allow_php_templates is disabled
     *
     * @return void
     */
    public function renderUncompiled(Smarty_Template_Source $source, Smarty_Internal_Template $_template)
    {
        if (!$source->smarty->allow_php_templates) {
            throw new SmartyException('PHP templates are disabled');
        }
        if (!$source->exists) {
            $parentIsTpl = isset($this->parent) && $this->parent->_objType == 2;
            throw new SmartyException("Unable to load template {$source->type} '{$source->name}'".
                                      ($parentIsTpl ? " in '{$this->parent->template_resource}'" : ''));
        }

        // prepare variables
        extract($_template->getTemplateVars());

        // include PHP template with short open tags enabled
        ini_set('short_open_tag', '1');
        /** @var Smarty_Internal_Template
         * used in included file
         */
        $_smarty_template = $_template;
        include $source->filepath;
        ini_set('short_open_tag', $this->short_open_tag);
    }

    /**
     * populate compiled object with compiled filepath.
     *
     * @param Smarty_Template_Compiled $compiled  compiled object
     * @param Smarty_Internal_Template $_template template object (is ignored)
     */
    public function populateCompiledFilepath(Smarty_Template_Compiled $compiled, Smarty_Internal_Template $_template)
    {
        $compiled->filepath = $_template->source->filepath;
        $compiled->timestamp = $_template->source->timestamp;
        $compiled->exists = $_template->source->exists;
        $compiled->file_dependency[$_template->source->uid] =
            [$compiled->filepath, $compiled->timestamp,
                  $_template->source->type, ];
    }
}