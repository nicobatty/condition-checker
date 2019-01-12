<?php
/**
 * @author Nicolas Batty <nicolas.batty@gmail.com>
 */

namespace NicoBatty\ConditionChecker\Operator;

interface OperatorInterface
{
    public function getDefaultMessage(): string;

    public function isValid($value, $values): bool;
}