<?php
/**
 * @author Nicolas Batty <nicolas.batty@gmail.com>
 */

namespace NicoBatty\ConditionChecker;

use NicoBatty\ConditionChecker\Operator\OperatorInterface;

class Condition implements ConditionInterface
{
    /**
     * Condition Key
     *
     * @var string
     */
    protected $key;

    protected $operator;

    protected $values;

    protected $errorMessage;

    /**
     * @param string $key
     * @param OperatorInterface $operator
     * @param mixed $values
     * @param string $errorMessage
     */
    public function __construct(string $key, OperatorInterface $operator, $values, string $errorMessage = null)
    {
        $this->key = $key;
        $this->operator = $operator;
        $this->values = $values;
        $this->errorMessage = $errorMessage ?: $this->operator->getDefaultMessage();
    }

    protected function getDefaultMessage(): string
    {
        return 'The "{key}" attribute is not valid.';
    }

    /**
     * {@inheritDoc}
     */
    public function verifyData(array $data): array
    {
        $value = $this->getValueFromData($data);
        return $this->operator->isValid($value, $this->values) ? [] : [$this->getErrorMessage($data)];
    }

    public function getErrorMessage(array $data)
    {
        $replaceKey = str_replace('{key}', $this->key, $this->errorMessage);
        $replaceAll = str_replace('{value}', $data[$this->key], $replaceKey);
        
        return $replaceAll;
    }

    protected function getValueFromData(array $data)
    {
        return $data[$this->key] ?? null;
    }
}
