<?php

declare(strict_types = 1);

namespace Tests\Profile\BoardTranformation;

use TimiTao\Construo\Domain\BoardTransformation\Transformation as DomainTransformation;
use TimiTao\Construo\Domain\Model\ProgressBoard\Entity\FinalShard;
use TimiTao\Construo\Domain\Model\ProgressBoard\ValueObject\Shards;
use TimiTao\Construo\Domain\ValueObject\Data;

class Transformation implements DomainTransformation
{
    public function process(Shards $shards): Data
    {
        $data = '';
        /** @var FinalShard $shard */
        foreach ($shards as $shard) {
            $data .= $shard->getData()->getValue() . ' ';
        }
        return new Data($data);
    }
}
