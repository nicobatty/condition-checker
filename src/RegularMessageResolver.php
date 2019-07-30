<?php
/**
 * Created by PhpStorm.
 * User: fauzruk
 * Date: 12/01/19
 * Time: 21:42
 */

namespace NicoBatty\ConditionChecker;

use NicoBatty\ConditionChecker\Formatter\FormatterInterface;

class RegularMessageResolver implements MessageResolverInterface
{
    private $formatters;

    /**
     * RegularMessageResolver constructor.
     * @param array $formatters
     */
    public function __construct(array $formatters)
    {
        $this->formatters = $formatters;
    }

    /**
     * {@inheritDoc}
     */
    public function getResolvedMessage(Condition $condition, $actual, $data): string
    {
        $key = $condition->getKey();
        $template = $condition->getTemplate();
        $value = $condition->getValue();
        $formatter = $this->getFormatter($condition);
        $toReplace = $this->getToReplaceValues($key, $data, $value, $actual, $formatter);

        return str_replace(array_keys($toReplace), array_values($toReplace), $template);
    }

    protected function getFormatter(Condition $condition)
    {
        return $this->formatters[$condition->getFormat()] ?? null;
    }

    protected function getToReplaceValues(string $key, $data, $value, $actual, FormatterInterface $formatter = null): array
    {
        return [
            '%key' => $key,
            '%actual' => $formatter ? $formatter->format($key, $data, $actual) : $actual,
            '%expected' => $formatter ? $formatter->format($key, $data, $value) : $value
        ];
    }
}