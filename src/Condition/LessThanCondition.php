<?php

namespace NicoBatty\ConditionChecker\Condition;

use NicoBatty\ConditionChecker\Condition;

class LessThanCondition extends Condition
{
    public function isValid($value): bool
    {
        return $value < $this->values[0];
    }
}