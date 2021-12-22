<?php
namespace ibrhaim13\Validation\Rules;
use ibrhaim13\Contract\Rule;

class RequiredRule implements Rule
{

    public function passes(string $filed, $value,$otherData=[]): bool
    {
        return !empty($value);
    }

    public function message(string $filed):string
    {
       return "{$filed} is required";
    }
}