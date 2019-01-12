<?php
/**
 * @author Nicolas Batty <nicolas.batty@gmail.com>
 */

namespace NicoBatty\ConditionChecker;

use NicoBatty\ConditionChecker\Operator\OperatorInterface;

class Condition implements ConditionInterface
{

    protected $operator;

    /**
     * @var MessageResolverInterface
     */
    private $messageResolver;

    /**
     * Condition Key
     *
     * @var string
     */
    protected $key;

    protected $value;

    /**
     * @param OperatorInterface $operator
     * @param MessageResolverInterface $messageResolver
     */
    public function __construct(OperatorInterface $operator, MessageResolverInterface $messageResolver)
    {
        $this->operator = $operator;
        $this->messageResolver = $messageResolver;
    }

    /**
     * @param string $key
     */
    public function setKey(string $key): void
    {
        $this->key = $key;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value): void
    {
        $this->value = $value;
    }

    /**
     * {@inheritDoc}
     */
    public function verifyData(array $data): array
    {
        $value = $this->getValueFromData($data);
        if (!$this->operator->isValid($value, $this->value)) {
            return [$this->getResolvedMessage($data)];
        }
        return [];
    }

    protected function getResolvedMessage(array $data): string
    {
        return $this->messageResolver->getResolvedMessage($this->key, $data, $this->value);
    }

    protected function getValueFromData(array $data)
    {
        return $data[$this->key] ?? null;
    }
}
