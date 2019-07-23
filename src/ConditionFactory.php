<?php

namespace NicoBatty\ConditionChecker;


use NicoBatty\ConditionChecker\Operator\OperatorInterface;

class ConditionFactory
{
    const DEFAULT_RESOLVER_KEY = 'default';

    /**
     * @var KeyPathResolver
     */
    private $keyPathResolver;

    /**
     * @var OperatorInterface[]
     */
    private $operators;

    /**
     * @var MessageResolverInterface[]
     */
    private $messageResolvers;

    /**
     * ConditionFactory constructor.
     * @param KeyPathResolver $keyPathResolver
     * @param OperatorInterface[] $operators
     * @param MessageResolverInterface[] $messageResolvers
     */
    public function __construct(KeyPathResolver $keyPathResolver, array $operators, array $messageResolvers)
    {
        $this->keyPathResolver = $keyPathResolver;
        $this->operators = $operators;
        $this->messageResolvers = $messageResolvers;
    }

    /**
     * @param array $data
     * @return Condition
     */
    public function create(array $data): Condition
    {
        $operator = $this->operators[$data['operator']];
        $messageResolver = $this->messageResolvers[$data['resolver'] ?? self::DEFAULT_RESOLVER_KEY];
        $condition = new Condition($this->keyPathResolver, $operator, $messageResolver);
        $condition->setKey($data['key']);
        $condition->setValue($data['value']);
        if (isset($data['template'])) {
            $condition->setTemplate($data['template']);
        }
        if (isset($data['format'])) {
            $condition->setFormat($data['format']);
        }

        return $condition;
    }
}