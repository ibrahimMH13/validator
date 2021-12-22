<?php

namespace ibrhaim13\Validation\Rules;

use ibrhaim13\Contract\Rule;
use ibrhaim13\Validation\Validator;

class RequiredWithRule implements Rule
{
    private $fileds = [];

    public function __construct(...$fileds)
    {

        $this->fileds = $fileds;
    }

    public function passes($filed, $value,$otherData=[]): bool
    {
        foreach ($this->fileds as $filedx){
          if (empty($value) && empty($otherData[$filedx])){
              return false;
          }
        }
        return  true;
    }

    public function message($filed): string
    {
        return "$filed is required with ".implode(', ',Validator::aliases($this->fileds));
    }
}