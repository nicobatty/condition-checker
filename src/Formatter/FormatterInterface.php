<?php


namespace NicoBatty\ConditionChecker\Formatter;


interface FormatterInterface
{
    public function format(string $key, $data, $value): string;
}