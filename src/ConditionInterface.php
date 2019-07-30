<?php

namespace NicoBatty\ConditionChecker;

interface ConditionInterface
{
    /**
     * Verify if there are any errors for this specific data set
     *
     * @param array $data set
     * @return array of errors, an empty array if no errors are found.
     */
    public function verifyData(array $data): array;
}
