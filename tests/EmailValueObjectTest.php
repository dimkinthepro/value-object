<?php

declare(strict_types=1);

namespace Tests\DimkinThePro\ValueObject;

use DimkinThePro\ValueObject\EmailValueObject;
use DimkinThePro\ValueObject\Exception\ValueObjectException;
use PHPUnit\Framework\TestCase;

class EmailValueObjectTest extends TestCase
{
    /**
     * @dataProvider providerTestCase
     */
    public function testCase(
        string $email,
        string $assertEmail,
        string $assertDomain,
        ?string $errorClass,
        ?string $errorMsg
    ): void {
        if (null !== $errorClass) {
            self::expectException($errorClass);
            self::expectErrorMessage($errorMsg);
        }

        $emailVo = new EmailValueObject($email);
        self::assertEquals($emailVo->get(), $assertEmail);
        self::assertEquals($emailVo->getDomain()->get(), $assertDomain);
    }

    public function providerTestCase(): array
    {
        return [
            [
                'email' => "\xe2\x80\x8b\xc2\xad",
                'assertEmail' => '',
                'assertDomain' => '',
                'errorClass' => ValueObjectException::class,
                'errorMsg' => 'Email address is empty: ""',
            ],
            [
                'email' => "  \xe2\x80\x8b\xc2\xad  ",
                'assertEmail' => '',
                'assertDomain' => '',
                'errorClass' => ValueObjectException::class,
                'errorMsg' => 'Email address is empty: ""',
            ],
            [
                'email' => "  eM@ail  ",
                'assertEmail' => '',
                'assertDomain' => '',
                'errorClass' => ValueObjectException::class,
                'errorMsg' => 'Email address is invalid: "em@ail"',
            ],
            [
                'email' => "Em@ail",
                'assertEmail' => '',
                'assertDomain' => '',
                'errorClass' => ValueObjectException::class,
                'errorMsg' => 'Email address is invalid: "em@ail"',
            ],
            [
                'email' => '  email@EM.ail  ',
                'assertEmail' => 'email@em.ail',
                'assertDomain' => 'em.ail',
                'errorClass' => null,
                'errorMsg' => null,
            ],
        ];
    }
}
