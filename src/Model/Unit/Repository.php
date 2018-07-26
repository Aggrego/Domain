<?php

declare(strict_types = 1);

namespace Aggrego\Domain\Model\Unit;

use Aggrego\Domain\Model\Unit\Entity\Unit;
use Aggrego\Domain\ValueObject\Key;
use Aggrego\Domain\ValueObject\Profile;

interface Repository
{
    public function findUnit(Key $key, Profile $profile): ?Unit;

    public function addUnit(Unit $unit): void;
}
