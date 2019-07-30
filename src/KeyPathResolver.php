<?php


namespace NicoBatty\ConditionChecker;


class KeyPathResolver
{
    const KEY_SEPERATOR = '.';

    public function getValueFromKey(array $data, string $key)
    {
        if (strpos($key, self::KEY_SEPERATOR) === false) {
            return $data[$key] ?? null;
        }
        $keyDepths = explode(self::KEY_SEPERATOR, $key);
        $value = &$data;
        foreach ($keyDepths as $key) {
            $value = &$value[$key];
        }
        return $value;
    }
}