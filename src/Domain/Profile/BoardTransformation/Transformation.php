<?php

declare(strict_types = 1);

namespace TimiTao\Construo\Domain\Profile\BoardTransformation;

use TimiTao\Construo\Domain\Model\ProgressBoard\ValueObject\Shards;
use TimiTao\Construo\Domain\ValueObject\Data;
use TimiTao\Construo\Domain\ValueObject\Profile;

interface Transformation
{
    public function isSupported(Profile $profile): bool;

    public function process(Shards $shards): Data;
}