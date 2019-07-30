<?php


namespace NicoBatty\ConditionChecker;


use NicoBatty\ConditionChecker\GroupType\GroupTypeInterface;

class ConditionGroupFactory
{
    /**
     * @var ConditionFactory
     */
    protected $conditionFactory;

    /**
     * @var GroupTypeInterface[]
     */
    protected $groupTypes;

    public function __construct(ConditionFactory $conditionFactory, array $groupTypes)
    {
        $this->conditionFactory = $conditionFactory;
        $this->groupTypes = $groupTypes;
    }

    /**
     * @param array $data
     * @return ConditionGroup
     * @throws \Exception
     */
    public function create(array $data): ConditionGroup
    {
        if ($this->isConditionGroup($data)) {
            return $this->createConditionGroup($data);
        }
        throw new \Exception('This is not a condition group data');
    }

    protected function isConditionGroup(array $data): bool
    {
        return isset($data['group']);
    }

    /**
     * @param array $data
     * @return ConditionGroup
     * @throws \Exception
     */
    protected function createConditionGroup(array $data): ConditionGroup
    {
        $conditionsData = $data['conditions'] ?? [];
        $groupType = $this->getGroupType($data);
        $conditionGroup = new ConditionGroup($groupType);
        foreach ($conditionsData as $conditionData) {
            $conditionGroup->addCondition($this->createCondition($conditionData));
        }
        return $conditionGroup;
    }

    /**
     * @param array $data
     * @return GroupTypeInterface
     * @throws \Exception
     */
    protected function getGroupType(array $data): GroupTypeInterface
    {
        if (!isset($this->groupTypes[$data['group']])) {
            throw new \Exception(sprintf('The group type "%s" does not exists', $data['group']));
        }
        return $this->groupTypes[$data['group']];
    }

    /**
     * @param array $data
     * @return ConditionInterface
     * @throws \Exception
     */
    protected function createCondition(array $data): ConditionInterface
    {
        if ($this->isConditionGroup($data)) {
            return $this->createConditionGroup($data);
        } else {
            return $this->conditionFactory->create($data);
        }
    }
}