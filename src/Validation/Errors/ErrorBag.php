<?php

namespace ibrhaim13\Validation\Errors;

class ErrorBag
{
    private  $errors = [];

    public function add($key, $message){
        $this->errors[$key][] = $message;
    }

    public function hasErrors(): bool
    {
        return empty($this->errors);
    }
    public function getErrors(): array
    {
        return $this->errors;
    }
}