<?php
namespace ibrhaim13\Validation\Rules;
use ibrhaim13\Contract\Rule;

class EmailRule implements Rule
{

    public function passes(string $filed, $value,$otherData=[]): bool
    {
        return filter_var($value,FILTER_VALIDATE_EMAIL);
    }

    public function message(string $filed):string
    {
       return "{$filed} is a valid email required";
    }
}