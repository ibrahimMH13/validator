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
    private   $aliases;

    public function __construct(array $data)
    {

        $this->data  = $data;
        $this->errors = new ErrorBag();
    }

    public function setRules(array $roles){
        $this->roles = $roles;
    }

    public function setAliases(array $aliases){
        $this->aliases = $aliases;
    }
    public function validate(): bool
    {
        foreach ($this->roles as $filed => $roles) {
            foreach ($this->resolveRule($roles) as $role) {
                $this->validateRule($filed, $role);
            }
        }
        return $this->errors->hasErrors();
    }

    private function validateRule(string $filed,Rule $role)
    {
       if (!$role->passes($filed,$this->getFiledValue($filed,$this->data))){
         $this->errors->add($filed,$role->message($this->alias($filed)));
       }
    }

    protected function getFiledValue(string $filed,array $data){
        return $this->data[$filed]??null;
    }

    public function errors(): array
    {
      return  $this->errors->getErrors();
    }

    protected function alias($filed){
      return  $this->aliases[$filed]??$filed;
    }

    private function resolveRule($roles)
    {
        return array_map(function ($role){
            return is_string($role)?$this->resolveRuleObjectFromString($role):$role;
        },$roles);
    }

    private function resolveRuleObjectFromString(string $role):?Rule
    {
        return  $this->newRuleFromMap(
           ($exploded = explode(':',$role))[0],
           (explode(',',end($exploded)))
       );
    }

    protected function newRuleFromMap($role,$optional){
     //   dump($role,$optional);
      return  RuleMap::resolve($role,$optional);
    }
}