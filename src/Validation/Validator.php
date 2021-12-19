<?php
namespace ibrhaim13\Validation;
use ibrhaim13\Contract\Rule;

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

    public function validate(){
        foreach ($this->roles as $filed => $roles){
            foreach ($roles as $role){
                $this->validateRule($filed,$role);
            }
        }
    }

    private function validateRule(string $filed,Rule $role)
    {
       if (!$role->passes($filed,$this->getFiledValue($filed,$this->data))){
         //  dd($role->message($filed));
       }
    }

    protected function getFiledValue(string $filed,array $data){
        return $this->data[$filed]??null;
    }
}