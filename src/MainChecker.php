<?php

namespace NicoBatty\ConditionChecker;

class MainChecker
{
    private $conditionGroup;

    private $data = [];

    /**
     * @var ConditionGroup
     */
    public function setConditionGroup(ConditionGroup $conditionGroup): void
    {
        $this->conditionGroup = $conditionGroup;
    }

    /**
     * @var array
     */
    public function setData(array $data): void
    {
        $this->data = $data;
    }

    /**
     * @return string[]
     */
    public function getAllErrors(): array
    {
        return $this->conditionGroup->verifyData($this->data);
    }

    /**
     * @return string
     */
    public function getFirstError(): string
    {
    }
}
