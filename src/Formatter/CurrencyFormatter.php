<?php


namespace NicoBatty\ConditionChecker\Formatter;


use NicoBatty\ConditionChecker\KeyPathResolver;

class CurrencyFormatter implements FormatterInterface
{
    /**
     * @var KeyPathResolver
     */
    private $keyPathResolver;

    public function __construct(KeyPathResolver $keyPathResolver)
    {
        $this->keyPathResolver = $keyPathResolver;
    }

    public function format(string $key, $data, $value): string
    {
        return (string)$value . ' ' . $this->getCurrency($key, $data);
    }

    protected function getCurrency(string $valueKey, $data): string
    {
        $currencyKey = $this->getCurrencyKey($valueKey);
        return $this->keyPathResolver->getValueFromKey($data, $currencyKey);
    }

    protected function getCurrencyKey(string $valueKey): string
    {
        return str_replace('value', 'currency', $valueKey);
    }

}