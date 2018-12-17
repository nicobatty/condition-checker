<?php

namespace NicoBatty\ConditionChecker\Condition;

use NicoBatty\ConditionChecker\Condition;

class GreaterEqualCondition extends Condition
{
    protected function getDefaultMessage(): string
    {
        return 'The "{key}" attribute must be equal or greater than "{value}."';
    }

    public function isValid($value): bool
    {
        return $value >= $this->values[0];
    }
}