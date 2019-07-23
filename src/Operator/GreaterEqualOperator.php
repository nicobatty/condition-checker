<?php

namespace NicoBatty\ConditionChecker\Operator;

class GreaterEqualOperator extends Operator
{
    public function getDefaultMessage(): string
    {
        return 'The "%key" attribute of value "%actual" is not greater or equal than "%expected".';
    }

    public function verify($value, $values): bool
    {
        return $value >= $values;
    }
}