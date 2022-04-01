<?php

declare(strict_types=1);

namespace SuperUmbrella\ProcessRunner;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class SequenceOutput
{
    private static ?SequenceOutput $instance = null;

    private function __construct(private UuidInterface $uuid)
    {
    }

    public static function create(): SequenceOutput
    {
        if (!self::$instance) {
            self::$instance = new static(Uuid::uuid4());
        }
        return self::$instance;
    }

    public function addLog(string $log): void
    {
        file_put_contents(
            __DIR__ . '/' . $this->uuid . '.json',
            json_encode($log, JSON_THROW_ON_ERROR) . ',',
            FILE_APPEND | LOCK_EX
        );
    }
}
