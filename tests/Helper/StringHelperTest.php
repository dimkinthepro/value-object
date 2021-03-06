<?php

declare(strict_types=1);

namespace Tests\DimkinThePro\ValueObject\Helper;

use DimkinThePro\ValueObject\Helper\StringHelper;
use PHPUnit\Framework\TestCase;

class StringHelperTest extends TestCase
{
    /**
     * @dataProvider providerTestClearEmail
     */
    public function testClearEmail(string $string, string $assertion): void
    {
        self::assertEquals(StringHelper::clearEmail($string), $assertion);
    }

    public function providerTestClearEmail(): array
    {
        return [
            ['  STRING   ', 'string'],
            ['  s@st-Ri.ng   ', 's@st-ri.ng'],
            ['  a@stRing[]   ', 'a@string'],
            ["  string\xe2\x80\x8b\xc2\xad   ", 'string'],
        ];
    }
}
