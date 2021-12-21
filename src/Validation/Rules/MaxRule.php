<?php

namespace ibrhaim13\Validation\Rules;

use ibrhaim13\Contract\Rule;

class MaxRule implements Rule
{
    private  $max;
     public function __construct(int $max)
    {

        $this->max = $max;
    }

    public function passes(string $filed, $value): bool
    {
         return strlen($value) <= $this->max;
    }

    public function message(string $filed): string
    {
       return "$filed x max required";
    }
}