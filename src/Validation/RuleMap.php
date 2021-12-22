<?php

namespace ibrhaim13\Validation;

use ibrhaim13\Validation\Rules\BetweenRule;
use ibrhaim13\Validation\Rules\EmailRule;
use ibrhaim13\Validation\Rules\MaxRule;
use ibrhaim13\Validation\Rules\RequiredRule;

class RuleMap
{
    protected static $map = [
        'required'  => RequiredRule::class,
        'email'     => EmailRule::class,
        'max'       => MaxRule::class,
        'between'   => BetweenRule::class,
    ];

    public static function resolve($role,$optional){
        return new self::$map[$role](...$optional);
    }
}