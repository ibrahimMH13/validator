<?php
namespace ibrhaim13\Contract;
interface Rule
{
    public function passes(string $filed,$value,$otherData=[]):bool;
    public function message(string $filed):string;
}