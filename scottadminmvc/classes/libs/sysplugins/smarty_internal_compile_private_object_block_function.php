<?php
/**
 * Smarty Internal Plugin Compile Object Block Function
 * Compiles code for registered objects as block function.
 *
 * @author     Uwe Tews
 */

/**
 * Smarty Internal Plugin Compile Object Block Function Class.
 */
class Smarty_Internal_Compile_Private_Object_Block_Function extends Smarty_Internal_Compile_Private_Block_Plugin
{
    /**
     * Setup callback and parameter array.
     *
     * @param \Smarty_Internal_TemplateCompilerBase $compiler
     * @param array                                 $_attr    attributes
     * @param string                                $tag
     * @param string                                $method
     *
     * @return array
     */
    public function setup(Smarty_Internal_TemplateCompilerBase $compiler, $_attr, $tag, $method)
    {
        $_paramsArray = [];
        foreach ($_attr as $_key => $_value) {
            if (is_int($_key)) {
                $_paramsArray[] = "$_key=>$_value";
            } else {
                $_paramsArray[] = "'$_key'=>$_value";
            }
        }
        $callback = ["\$_smarty_tpl->smarty->registered_objects['{$tag}'][0]", "->{$method}"];

        return [$callback, $_paramsArray, "array(\$_block_plugin{$this->nesting}, '{$method}')"];
    }
}