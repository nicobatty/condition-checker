<?php

namespace NicoBatty\ConditionChecker\Operator;

class EqualOperator extends Operator
{

    public function getDefaultMessage(): string
    {
        return 'The "%key" attribute of value "%actual" is not equal to "%expected".';
    }

    public function verify($value, $values): bool
    {
        return $value == $values;
    }
}