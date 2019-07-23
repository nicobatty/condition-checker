<?php

namespace NicoBatty\ConditionChecker\Condition;

use NicoBatty\ConditionChecker\Operator\Operator;

class InOperator extends Operator
{
    public function getDefaultMessage(): string
    {
        return 'The "{key}" attribute is not part of {value}.';
    }

    public function verify($value, $values): bool
    {
        return in_array($value, $values);
    }
}