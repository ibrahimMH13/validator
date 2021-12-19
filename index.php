<?php


use ibrhaim13\Validation\Rules\RequiredRule;
use ibrhaim13\Validation\Validator;
function dd($data){
    echo "<pre>";
    die(var_dump($data));
}
require_once 'vendor/autoload.php';

$validator = new Validator([
    'name'=>''
]);
$validator->setRules([
    'name'=>[
        new RequiredRule
    ]
]);
$validator->validate();