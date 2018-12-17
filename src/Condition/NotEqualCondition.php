<?php

namespace NicoBatty\ConditionChecker\Condition;

use NicoBatty\ConditionChecker\Condition;

class NotEqualCondition extends Condition
{
    public function isValid($value): bool
    {
        return $value != $this->values[0];
    }
}