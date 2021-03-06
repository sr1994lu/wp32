<?php
/**
 * @src 03/04
 */

namespace extendsample;

/**
 * Class Pig.
 */
class Pig extends Animal
{
    /**
     * @return string
     */
    public function call()
    {
        return 'ぶう、ぶう';
    }

    public function speak()
    {
        parent::speak(); // TODO: Change the autogenerated stub
        echo 'すばらしい';
    }

    /**
     * @return string
     */
    public function eat()
    {
        return 'うまい！';
    }
}
