<?php

namespace ibrhaim13\Validation;

use ibrhaim13\Validation\Rules\BetweenRule;
use ibrhaim13\Validation\Rules\EmailRule;
use ibrhaim13\Validation\Rules\MaxRule;
use ibrhaim13\Validation\Rules\OptionalRule;
use ibrhaim13\Validation\Rules\RequiredRule;
use ibrhaim13\Validation\Rules\RequiredWithRule;

class RuleMap
{
    protected static $map = [
        'required'       => RequiredRule::class,
        'email'          => EmailRule::class,
        'max'            => MaxRule::class,
        'between'        => BetweenRule::class,
        'requiredWith'   => RequiredWithRule::class,
        'optional'       => OptionalRule::class
    ];

    public static function resolve($role,$optional){
        return new self::$map[$role](...$optional);
    }
}