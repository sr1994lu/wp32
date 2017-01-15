<?php
/**
 * @src 04/04
 */

namespace extendsample;

require_once __DIR__.'Animal.class.php';
require_once __DIR__.'Cat.class.php';
require_once __DIR__.'Pig.class.php';

$pet0 = new Animal();
$pet0->setName('ごんちゃん');

$pet1 = new Cat();
$pet1->setName('たま');

$pet2 = new Pig();
$pet2->setName('とんこ');

echo $pet0->getName().': '.$pet0->call().'<br>';

echo $pet1->getName().': '.$pet1->call().'<br>';

echo $pet2->getName().': '.$pet2->call().'<br>';
echo $pet2->eat().'<hr>';
$pet2->speak();
