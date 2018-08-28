<?php

declare(strict_types = 1);

namespace Aggrego\Domain\Profile\BoardConstruction\InitialBoardModel;

use Aggrego\Domain\Profile\BoardConstruction\InitialBoardModel\Shard\Collection;
use Aggrego\Domain\Profile\BoardConstruction\InitialBoardModel\Shard\Item;
use Aggrego\Domain\Profile\Profile;
use Aggrego\Domain\ProgressiveBoard\Step\State;
use Aggrego\Domain\Shared\ValueObject\Key;
use Aggrego\Domain\Shared\ValueObject\Uuid;
use Ramsey\Uuid\Uuid as RamseyUuid;

final class ProgressiveBoard extends AbstractBoard
{
    /** @var Collection */
    private $shards;
    
    public function __construct(Key $key, Profile $profile)
    {
        parent::__construct($key, $profile);
        $this->shards = new Collection();
    }

    public function addShard(Key $key, Profile $shardProfile): void
    {
        $this->shards->add(
            new Item(
                $this->produceShardUuid($key, $shardProfile),
                $shardProfile,
                $key
            )
        );
    }

    public function getState(): State
    {
        return State::createInitial();
    }

    public function getShards(): Collection
    {
        return $this->shards;
    }

    protected function produceShardUuid(Key $key, Profile $shardProfile): Uuid
    {
        return new Uuid(
            RamseyUuid::uuid5(
                RamseyUuid::NAMESPACE_DNS,
                serialize($key->getValue()) . $shardProfile . $this->getUuid()->getValue()
            )->toString()
        );
    }
}
