<?php

use ibrhaim13\Validation\Validator;

require_once 'vendor/autoload.php';

$validator = new Validator([]);
dump($validator->validate());
