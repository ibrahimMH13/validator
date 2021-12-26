<?php
namespace ibrhaim13\Validation;
use ibrhaim13\Contract\Rule;
use ibrhaim13\Validation\Errors\ErrorBag;
use ibrhaim13\Validation\Rules\OptionalRule;

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
    private  static $aliases;

    public function __construct(array $data)
    {

        $this->data  = $this->extractWiledCardData($data);
        $this->errors = new ErrorBag();
    }

    protected function extractWiledCardData($array,$root ='',$result=[]){
         foreach ($array as $key => $value){
            if (is_array($value)){
                $result = array_merge($result,$this->extractWiledCardData($value,$root.$key.'.'));
            }else{
                $result[$root.$key] = $value;
            }
        }
        return $result;
    }
    public function getMatchingData($filed){
        $filedRegExp = str_replace('*','([^\.]+)',$filed);
        $dataKeys    = array_keys($this->data);
       return preg_grep("/^{$filedRegExp}/",$dataKeys);
    }

    public function setRules(array $roles){
        $this->roles = $roles;
    }

    public function setAliases(array $aliases){
        self::$aliases = $aliases;
    }
    public function validate(): bool
    {
        foreach ($this->roles as $filed => $roles) {
           $resolved = $this->resolveRule($roles);
            foreach ($resolved as $role) {
                 $this->validateRule($filed, $role,$this->hasOptionalRule($resolved));
            }
        }
        return $this->errors->hasErrors();
    }

    protected function hasOptionalRule($rules): bool
    {
        dump($rules);
       foreach ($rules as $rule){
           if ($rule instanceof OptionalRule){
               return true;
           }
       }
       return false;
    }

    private function validateRule(string $filed,Rule $role,$optional = false)
    {
      foreach ($this->getMatchingData($filed) as $filedMatched){
          if (($value=$this->getFiledValue($filedMatched,$this->data)) == '' && $optional){
              continue;
          }
          $this->validateUsingRuleObject($filedMatched,$value,$role);
      }
    }

    protected function validateUsingRuleObject($filed,$value,Rule $role){
        if (!$role->passes($filed,$value,$this->data)){
            $this->errors->add($filed,$role->message(self::alias($filed)));
        }
    }

    protected function getFiledValue(string $filed,array $data){
        return $this->data[$filed]??null;
    }

    public function errors(): array
    {
      return  $this->errors->getErrors();
    }

    public static function alias($filed){
      return  self::$aliases[$filed]??$filed;
    }

    public static function aliases(array $fileds): array
    {
     return array_map(function ($filed){
         return self::alias($filed);
     },$fileds);
    }

    private function resolveRule($roles): array
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
      return  RuleMap::resolve($role,$optional);
    }
}