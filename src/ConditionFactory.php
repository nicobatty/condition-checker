<?php

namespace NicoBatty\ConditionChecker;


use NicoBatty\ConditionChecker\Operator\OperatorInterface;

class ConditionFactory
{

    /**
     * @var string[]
     */
    private $operatorClasses;

    /**
     * ConditionFactory constructor.
     * @param string[] $operatorClasses
     */
    public function __construct(array $operatorClasses)
    {
        $this->operatorClasses = $operatorClasses;
    }

    public function create(string $key, string $operatorKey, $value)
    {
        $operator = $this->getOperatorObject($operatorKey);
        $condition = new Condition($key, $operator, $value);

        return $condition;
    }

    /**
     * @param string $operatorKey
     * @return OperatorInterface
     */
    private function getOperatorObject(string $operatorKey)
    {
        $operatorClass = $this->operatorClasses[$operatorKey];
        $operator = new $operatorClass;

        return $operator;
    }
}