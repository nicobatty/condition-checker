<?php
/**
 * @author Nicolas Batty <nicolas.batty@gmail.com>
 */

namespace NicoBatty\ConditionChecker;

class Condition implements ConditionInterface
{
    const EQUAL_OPERATOR = 'equal';

    const DEFAULT_EQUAL_ERROR_MSG = 'The "{key}" attribute is not equal to "{value}"';

    private $key;

    private $values = [];

    private $operator;

    private $errorMessage;

    public function __construct(string $key)
    {
        $this->key = $key;
    }

    public function equal($value, string $errorMessage = self::DEFAULT_EQUAL_ERROR_MSG): void
    {
        $this->condition(self::EQUAL_OPERATOR, [$value], $errorMessage);
    }

    protected function condition(string $operator, $values, string $errorMessage): void
    {
        $this->values = $values;
        $this->errorMessage = $errorMessage;
        $this->operator = $operator;
    }

    public function verifyData(array $data)
    {
        return $this->isValid($data) ? $this->getErrorMessage($data) : null;
    }

    public function getErrorMessage(array $data)
    {
        $replaceKey = str_replace('{key}', $this->key, $this->errorMessage);
        $replaceAll = str_replace('{value}', $data[$this->key], $replaceKey);
        
        return $replaceAll;
    }

    public function isValid(array $data): bool
    {
        switch ($this->operator) {
            case self::EQUAL_OPERATOR:
                return $this->isEqual($data);
        }
    }

    protected function isEqual(array $data): bool
    {
        $value = $data[$this->key] ?? null;
        return $value == $this->values[0];
    }
}
