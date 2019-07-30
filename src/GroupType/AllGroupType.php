<?php


namespace NicoBatty\ConditionChecker\GroupType;


use NicoBatty\ConditionChecker\ConditionGroup;

class AllGroupType implements GroupTypeInterface
{
    public function verifyConditionGroupData(ConditionGroup $conditionGroup, array $data): array
    {
        $conditionResults = [];
        foreach ($conditionGroup->getConditions() as $condition) {
            $conditionResults = array_merge($conditionResults, $condition->verifyData($data));
        }
        return $conditionResults;
    }
}