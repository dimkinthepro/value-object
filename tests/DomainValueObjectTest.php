<?php

declare(strict_types=1);

namespace Tests\DimkinThePro\ValueObject;

use DimkinThePro\ValueObject\DomainValueObject;
use DimkinThePro\ValueObject\Exception\ValueObjectException;
use PHPUnit\Framework\TestCase;

class DomainValueObjectTest extends TestCase
{
    /**
     * @dataProvider providerTestCase
     */
    public function testCase(string $domain, string $assertDomain, ?string $errorClass, ?string $errorMsg): void
    {
        if (null !== $errorClass) {
            self::expectException($errorClass);
            self::expectErrorMessage($errorMsg);
        }

        $domainVo = new DomainValueObject($domain);
        self::assertEquals($domainVo->get(), $assertDomain);
    }

    public function providerTestCase(): array
    {
        return [
            [
                'domain' => '     doMAin.ru ',
                'assertDomain' => 'domain.ru',
                'errorClass' => null,
                'errorMsg' => null,
            ],
            [
                'domain' => '@domain.UR.ru     ',
                'assertDomain' => 'domain.ur.ru',
                'errorClass' => null,
                'errorMsg' => null,
            ],
            [
                'domain' => " \xe2\x80\x8b\xc2\xad ",
                'assertDomain' => 'domain',
                'errorClass' => ValueObjectException::class,
                'errorMsg' => 'Domain is empty: ""',
            ],
            [
                'domain' => 'domain',
                'assertDomain' => 'domain',
                'errorClass' => ValueObjectException::class,
                'errorMsg' => 'Domain is invalid: "domain"',
            ],
        ];
    }
}
