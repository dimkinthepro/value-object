<?php

declare(strict_types=1);

namespace DimkinThePro\ValueObject\Helper;

class StringHelper
{
    public static function clearEmail(string $string): string
    {
        $string = mb_strtolower(trim($string), 'utf8');

        return preg_replace("/[^a-zа-я\d@\-\.]/ui", '', $string);
    }
}
