<?php
/**
 * Created by PhpStorm.
 * User: fauzruk
 * Date: 12/01/19
 * Time: 21:42
 */

namespace NicoBatty\ConditionChecker;


class RegularMessageResolver implements MessageResolverInterface
{
    protected $template;

    public function __construct(string $template)
    {
        $this->template = $template;
    }

    public function getResolvedMessage($key, $data, $values)
    {
        $replacedKey = str_replace('{key}', $key, $this->template);
        $replacedValue = str_replace('{value}', $values, $replacedKey);

        return $replacedValue;
    }
}