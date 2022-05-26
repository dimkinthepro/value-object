<?php

declare(strict_types=1);

namespace DimkinThePro\ValueObject;

use DimkinThePro\ValueObject\Helper\StringHelper;
use Webmozart\Assert\Assert;

class EmailValueObject implements ValueObjectInterface
{
    private string $email;
    private string $domain;

    /**
     * @throws \InvalidArgumentException
     */
    public function __construct(string $email)
    {
        $email = StringHelper::clearEmail($email);
        Assert::email($email, sprintf('Invalid email provided: "%s"', $email));

        $this->email = $email;
        $this->domain = explode('@', $email, 2)[1];
    }

    public function getValue(): string
    {
        return $this->email;
    }

    public function getDomain(): string
    {
        return $this->domain;
    }
}
