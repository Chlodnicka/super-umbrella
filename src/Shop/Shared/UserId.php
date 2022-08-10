<?php

declare(strict_types=1);

namespace SuperUmbrella\Shop\Shared;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class UserId
{
    public readonly UuidInterface $sessionId;

    public function __construct(public readonly ?int $id, ?string $sessionId)
    {
        $this->sessionId = $sessionId ? Uuid::fromString($sessionId) : Uuid::uuid4();
    }
}
