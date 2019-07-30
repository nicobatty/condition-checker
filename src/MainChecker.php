<?php

namespace NicoBatty\ConditionChecker;

class MainChecker
{
    /**
     * @var ConditionInterface
     */
    private $condition;

    private $data = [];

    /**
     * @param ConditionInterface $condition
     */
    public function setCondition(ConditionInterface $condition): void
    {
        $this->condition = $condition;
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
        return $this->condition->verifyData($this->data);
    }

    /**
     * @return string
     */
    public function getFirstError(): string
    {
    }
}
