<?php
/**
 * Created by PhpStorm.
 * User: fauzruk
 * Date: 12/01/19
 * Time: 21:48
 */

namespace NicoBatty\ConditionChecker;


interface MessageResolverInterface
{
    /**
     * @param Condition $condition
     * @param $actual
     * @param $data
     * @return string
     */
    public function getResolvedMessage(Condition $condition, $actual, $data): string;
}