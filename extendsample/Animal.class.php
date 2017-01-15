<?php
/**
 * @src 01/04
 */

namespace extendsample;

class Animal
{
    private $name;

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function call()
    {
        return 'どんな鳴き声なんだろう？';
    }

    public function speak()
    {
        echo 'いえい<br>';
    }
}
