<?php

namespace ibrhaim13\Validation\Rules;

use ibrhaim13\Contract\Rule;

class BetweenRule implements Rule
{
    private $lower;
    private $upper;

    public function __construct($lower,$upper)
    {
         $this->lower = $lower;
         $this->upper = $upper;
    }

    public function passes(string $filed, $value,$otherData=[]): bool
    {
        $length = strlen($value);
         return ($length > $this->lower) && ($length < $this->upper);
    }

    public function message(string $filed): string
    {
       return "$filed must be between {$this->lower} and {$this->upper} required";
    }
}