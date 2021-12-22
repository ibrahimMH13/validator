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
    'first_name'=>' ',
    'email'=>'a@a.com',
]);
$validator->setRules([
    'first_name'=> array(
        'required',
        'between:5,10'
     ),
 ]);
$validator->setAliases([
    'first_name' =>'first name'
]);
dump($validator->validate());
dump($validator->errors());
