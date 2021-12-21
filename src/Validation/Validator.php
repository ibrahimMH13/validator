<?php
namespace ibrhaim13\Validation;
use ibrhaim13\Contract\Rule;
use ibrhaim13\Validation\Errors\ErrorBag;
use ibrhaim13\Validation\Rules\BetweenRule;
use ibrhaim13\Validation\Rules\EmailRule;
use ibrhaim13\Validation\Rules\MaxRule;
use ibrhaim13\Validation\Rules\RequiredRule;

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

    protected $ruleMap = [
        'required'  => RequiredRule::class,
        'email'     => EmailRule::class,
        'max'       => MaxRule::class,
        'between'   => BetweenRule::class,
    ];
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

    private function resolveRule($roles)
    {
        return array_map(function ($role){
            return is_string($role)?$this->resolveRuleObjectFromString($role):$role;
        },$roles);
    }

    private function resolveRuleObjectFromString(string $role):?Rule
    {
        $exploded = explode(':',$role);
        $role     = $exploded[0];
        $optional = explode(',',end($exploded));
        return  new $this->ruleMap[$role](...$optional);
    }
}