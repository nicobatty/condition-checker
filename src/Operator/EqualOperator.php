<?php

namespace NicoBatty\ConditionChecker\Operator;

class EqualOperator implements OperatorInterface
{
    public function getDefaultMessage(): string
    {
        return 'The "{key}" attribute is not equal to "{value}".';
    }

    public function isValid($value, $values): bool
    {
        return $value == $values;
    }
}