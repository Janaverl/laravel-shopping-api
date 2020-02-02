<?php

namespace Domain\Orders;

use Ramsey\Uuid\Uuid;

final class OrderId
{
    /**
     * @var Uuid
     */
    private $uuid;

    public function __construct(Uuid $uuid)
    {
        $this->uuid = $uuid;
    }

    public static function fromString(string $value): self
    {
        return new self(Uuid::fromString($value));
    }

    public static function generate(): self
    {
        return new self(Uuid::uuid4());
    }

    public function toString(): string
    {
        return $this->uuid->toString();
    }
}
