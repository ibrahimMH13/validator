<?php
namespace ibrhaim13\Validation\Rules;
use ibrhaim13\Contract\Rule;

class OptionalRule implements Rule
{

    public function passes(string $filed, $value,$otherData=[]): bool
    {
        return true;
    }

    public function message(string $filed):string
    {
       return "{$filed} is required";
    }
}