<?php


namespace NicoBatty\ConditionChecker\Operator;


abstract class Operator implements OperatorInterface
{
    /**
     * @var bool
     */
    protected $inverted;

    /**
     * EqualOperator constructor.
     * @param bool $inverted
     */
    public function __construct($inverted = false)
    {
        $this->inverted = $inverted;
    }

    public function isValid($value, $values): bool
    {
        return $this->inverted xor $this->verify($value, $values);
    }

    protected abstract function verify($value, $values): bool;

}