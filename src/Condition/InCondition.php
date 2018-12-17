<?php

namespace NicoBatty\ConditionChecker\Condition;

use NicoBatty\ConditionChecker\Condition;

class InCondition extends Condition
{
    public function isValid($value): bool
    {
        return in_array($value, $this->values);
    }
}