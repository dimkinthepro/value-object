<?php

declare(strict_types=1);

namespace DimkinThePro\ValueObject;

use DimkinThePro\ValueObject\Exception\ValueObjectException;
use DimkinThePro\ValueObject\Helper\StringHelper;

class DomainValueObject implements ValueObjectInterface
{
    private string $domain;

    /**
     * @throws ValueObjectException
     */
    public function __construct(string $domain)
    {
        $domain = StringHelper::clearDomain($domain);
        if ('' === $domain) {
            throw new ValueObjectException(sprintf('Domain is empty: "%s"', htmlentities($domain)));
        }

        $domainParts = explode('.', $domain);
        if (\count($domainParts) < 2) {
            throw new ValueObjectException(sprintf('Domain is invalid: "%s"', htmlentities($domain)));
        }

        $this->domain = $domain;
    }

    public function get(): string
    {
        return $this->domain;
    }
}
