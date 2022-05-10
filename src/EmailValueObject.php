<?php

declare(strict_types=1);

namespace DimkinThePro\ValueObject;

use DimkinThePro\ValueObject\Exception\ValueObjectException;
use DimkinThePro\ValueObject\Helper\StringHelper;

class EmailValueObject implements ValueObjectInterface
{
    private string $email;
    private DomainValueObject $domain;

    /**
     * @throws ValueObjectException
     */
    public function __construct(string $email)
    {
        $email = StringHelper::clearEmail($email);
        if ('' === $email) {
            throw new ValueObjectException(sprintf('Email address is empty: "%s"', htmlentities($email)));
        }

        if (false === filter_var($email, \FILTER_VALIDATE_EMAIL)) {
            throw new ValueObjectException(sprintf('Email address is invalid: "%s"', htmlentities($email)));
        }

        $this->email = $email;
        $domain = explode('@', $email, 2)[1];
        $this->domain = new DomainValueObject($domain);
    }

    public function get(): string
    {
        return $this->email;
    }

    public function getDomain(): DomainValueObject
    {
        return $this->domain;
    }
}
