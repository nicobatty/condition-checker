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
    public function getResolvedMessage(string $key, $data, $values): string;
}