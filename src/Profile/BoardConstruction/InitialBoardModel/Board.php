<?php

declare(strict_types = 1);

namespace Aggrego\Domain\Profile\BoardConstruction\InitialBoardModel;

use Aggrego\Domain\Profile\Profile;
use Aggrego\Domain\ProgressiveBoard\Step\State;
use Aggrego\Domain\Shared\ValueObject\Key;
use Aggrego\Domain\Shared\ValueObject\Uuid;

interface Board
{
    public function getUuid(): Uuid;

    public function getKey(): Key;

    public function getProfile(): Profile;

    public function getState(): State;
}