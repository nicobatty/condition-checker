<?php
/**
 * @author Nicolas Batty <nicolas.batty@gmail.com>
 */

namespace NicoBatty\ConditionChecker;

abstract class Condition implements ConditionInterface
{
    /**
     * Condition Key
     *
     * @var string
     */
    protected $key;

    protected $values = [];

    protected $errorMessage;

    /**
     * @param string $key
     * @param string $operator
     * @param mixed $values
     * @param string $errorMessage
     */
    public function __construct(string $key, $values, string $errorMessage = null)
    {
        $this->key = $key;
        $this->operator = $operator;
        $this->values = (array)$values;
        $this->errorMessage = $errorMessage ?: $this->getDefaultMessage();
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
        return $this->isValid($value) ? [] : [$this->getErrorMessage($data)];
    }

    public abstract function isValid($value): bool;

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
