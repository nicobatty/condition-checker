<?php

namespace NicoBatty\ConditionChecker;

class ConditionGroup implements ConditionInterface
{
    /**
     * Must satisfy at least one condition in the group
     */
    const TYPE_ANY = 'any';

    /**
     * Must satify all conditions in the group
     */
    const TYPE_ALL = 'all';

    /**
     * List of conditions in the group
     *
     * @var ConditionInterface[]
     */
    private $conditions = [];

    /**
     * Type of condition
     *
     * @var string
     */
    private $type;

    public function any()
    {
        $this->type = self::TYPE_ANY;
    }

    public function all()
    {
        $this->type = self::TYPE_ALL;
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
        return $this->getConditions();
    }

    /**
     * @param ConditionInterface[] $conditions
     */
    public function setConditions(array $conditions): void
    {
        $this->conditions = $conditions;
    }

    public function verifyData(array $data)
    {
        $conditionResults = [];
        foreach ($this->conditions as $condition) {
            $conditionResults[] = $condition->verifyData($data);
        }
        return $conditionResults;
    }
}
