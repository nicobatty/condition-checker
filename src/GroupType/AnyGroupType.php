<?php


namespace NicoBatty\ConditionChecker\GroupType;


use NicoBatty\ConditionChecker\ConditionGroup;

class AnyGroupType implements GroupTypeInterface
{
    public function verifyConditionGroupData(ConditionGroup $conditionGroup, array $data): array
    {
        $conditionResults = [];
        foreach ($conditionGroup->getConditions() as $condition) {
            $conditionResult = $condition->verifyData($data);
            if (empty($conditionResult)) {
                return [];
            }
            $conditionResults = array_merge($conditionResults, $conditionResult);
        }
        return $conditionResults;
    }
}