<?php
/**
 * @author Nicolas Batty <nicolas.batty@gmail.com>
 */

namespace NicoBatty\ConditionChecker\Operator;

interface OperatorInterface
{
    public function isValid($value, $values): bool;
}