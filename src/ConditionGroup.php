<?php

namespace NicoBatty\ConditionChecker;

use NicoBatty\ConditionChecker\GroupType\GroupTypeInterface;

class ConditionGroup implements ConditionInterface
{

    /**
     * List of conditions in the group
     *
     * @var ConditionInterface[]
     */
    protected $conditions = [];

    /**
     * @var GroupTypeInterface
     */
    protected $groupType;

    public function __construct(GroupTypeInterface $groupType)
    {
        $this->groupType = $groupType;
    }

    /**
     * @param ConditionInterface $condition
     */
    public function addCondition(ConditionInterface $condition): void
    {
        $this->conditions[] = $condition;
    }

    /**
     * @return ConditionInterface[]
     */
    public function getConditions(): array
    {
        return $this->conditions;
    }

    /**
     * @param ConditionInterface[] $conditions
     */
    public function setConditions(array $conditions): void
    {
        $this->conditions = $conditions;
    }

    /**
     * {@inheritDoc}
     */
    public function verifyData(array $data): array
    {
        return $this->groupType->verifyConditionGroupData($this, $data);
    }
}
