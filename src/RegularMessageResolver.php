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

    public function getResolvedMessage(string $key, $data, $values): string
    {
        $toReplace = $this->getToReplaceValues($key, $data, $values);

        return str_replace(array_keys($toReplace), array_values($toReplace), $this->template);
    }

    protected function getToReplaceValues(string $key, $data, $values): array
    {
        return [
            '%key' => $key,
            '%actual' => $data[$key],
            '%expected' => $values
        ];
    }
}