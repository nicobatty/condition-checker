<?php

namespace NicoBatty\ConditionChecker;

interface ConditionInterface
{
    /**
     * Return the error messages as a list
     *
     * @param array $data
     * @return array
     */
    public function verifyData(array $data): array;
}
