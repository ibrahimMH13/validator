<?php


use ibrhaim13\Validation\Validator;

require_once 'vendor/autoload.php';

$validator = new Validator([
    'name'=>'ibrahim'
]);
die(var_dump($validator));