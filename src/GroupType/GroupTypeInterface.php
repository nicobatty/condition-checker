<?php


namespace NicoBatty\ConditionChecker\GroupType;


use NicoBatty\ConditionChecker\ConditionGroup;

interface GroupTypeInterface
{
    public function verifyConditionGroupData(ConditionGroup $conditionGroup, array $data): array;
}