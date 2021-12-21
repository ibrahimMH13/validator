<?php
namespace ibrhaim13\Validation;
use ibrhaim13\Contract\Rule;
use ibrhaim13\Validation\Errors\ErrorBag;

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
    protected $errors;
    public function __construct(array $data)
    {

        $this->data  = $data;
        $this->errors = new ErrorBag();
    }

    public function setRules(array $roles){
        $this->roles = $roles;
    }

    public function validate(): bool
    {
        foreach ($this->roles as $filed => $roles){
            foreach ($roles as $role){
                $this->validateRule($filed,$role);
            }
        }
        return $this->errors->hasErrors();
    }

    private function validateRule(string $filed,Rule $role)
    {
       if (!$role->passes($filed,$this->getFiledValue($filed,$this->data))){
         $this->errors->add($filed,$role->message($filed));
       }
    }

    protected function getFiledValue(string $filed,array $data){
        return $this->data[$filed]??null;
    }

    public function errors(): array
    {
      return  $this->errors->getErrors();
    }
}