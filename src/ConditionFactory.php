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

    public function create(string $key, string $operatorKey, $value, MessageResolverInterface $messageResolver)
    {
        $operator = $this->getOperatorObject($operatorKey);
        $condition = new Condition($operator, $messageResolver);
        $condition->setKey($key);
        $condition->setValue($value);

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