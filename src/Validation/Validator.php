<?php
namespace ibrhaim13\Validation;
class Validator
{

    /**
     * @var array
     */
    private $data;
    /**
     * @var array
     */
    private  $roles = [];

    public function __construct(array $data)
    {

        $this->data = $data;
    }

    public function setRules(array $roles){
        $this->roles = $roles;
    }
}