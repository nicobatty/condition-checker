<?php

namespace NicoBatty\ConditionChecker\ConditionGroup;

use NicoBatty\ConditionChecker\ConditionGroup;

class AllConditionGroup extends ConditionGroup
{
    public function verifyData(array $data): array
    {
        $conditionResults = [];
        foreach ($this->conditions as $condition) {
            $conditionResults = array_merge($conditionResults, $condition->verifyData($data));
        }
        return $conditionResults;
    }
}