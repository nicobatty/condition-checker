<?php

namespace NicoBatty\ConditionChecker\Condition;

use NicoBatty\ConditionChecker\Condition;

class EqualCondition extends Condition
{
    protected function getDefaultMessage(): string
    {
        return 'The "{key}" attribute is not equal to {value}.';
    }

    public function isValid($value): bool
    {
        return $value == $this->values[0];
    }
}