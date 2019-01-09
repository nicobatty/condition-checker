<?php

namespace NicoBatty\ConditionChecker\Operator;

class GreaterEqualOperator implements OperatorInterface
{
    public function getDefaultMessage(): string
    {
        return 'The "{key}" attribute must be greater or equal than "{value}".';
    }

    public function isValid($value, $values): bool
    {
        return $value >= $values;
    }
}