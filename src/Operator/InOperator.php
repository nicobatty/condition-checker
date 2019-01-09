<?php

namespace NicoBatty\ConditionChecker\Condition;

use NicoBatty\ConditionChecker\Condition;

class InCondition extends Condition
{
    protected function getDefaultMessage(): string
    {
        return 'The "{key}" attribute is not part of {value}.';
    }

    public function isValid($value, $values): bool
    {
        return in_array($value, $values);
    }
}