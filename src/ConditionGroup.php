<?php

namespace NicoBatty\ConditionChecker;

abstract class ConditionGroup implements ConditionInterface
{
    /**
     * List of conditions in the group
     *
     * @var ConditionInterface[]
     */
    protected $conditions = [];

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
        return $this->getConditions();
    }

    /**
     * @param ConditionInterface[] $conditions
     */
    public function setConditions(array $conditions): void
    {
        $this->conditions = $conditions;
    }
}
