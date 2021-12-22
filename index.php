<?php


use ibrhaim13\Validation\Rules\BetweenRule;
use ibrhaim13\Validation\Rules\EmailRule;
use ibrhaim13\Validation\Rules\MaxRule;
use ibrhaim13\Validation\Rules\RequiredRule;
use ibrhaim13\Validation\Validator;
function dd($data){
    echo "<pre>";
    die(var_dump($data));
}
require_once 'vendor/autoload.php';

$validator = new Validator([
    'first_name'=>'',
    'middle_name'=>'',
    'last_name'=>'',
]);
$validator->setRules([
    'first_name'=> ['required'],
    'last_name'=> ['requiredWith:first_name,middle_name'],
 ]);
$validator->setAliases([
    'first_name'=>'first name',
    'last_name'=>'last name',
    'middle_name'=>'middle name',
]);
dump($validator->validate());
dump($validator->errors());
