<?php

declare(strict_types = 1);

namespace Aggrego\Domain\Api\Application\Event;

interface Event
{
    public function getName(): string;

    public function getPayload(): array;
}