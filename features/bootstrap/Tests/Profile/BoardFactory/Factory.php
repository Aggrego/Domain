<?php

declare(strict_types = 1);

namespace Tests\Profile\BoardFactory;

use Tests\Profile\BaseTestSupport;
use TimiTao\Construo\Domain\Model\InitialBoard\Entity\Board;
use TimiTao\Construo\Domain\Profile\BoardFactory\Factory as DomainBoardFactory;
use TimiTao\Construo\Domain\ValueObject\Key;
use TimiTao\Construo\Domain\ValueObject\Name;
use TimiTao\Construo\Domain\ValueObject\Profile;
use TimiTao\Construo\Domain\ValueObject\Source;
use TimiTao\Construo\Domain\ValueObject\Version;

class Factory extends BaseTestSupport implements DomainBoardFactory
{
    public const INITIAL_SHARDS_COUNT = 2;

    public const DEFAULT_BOARD_UUID = 'd0b7e1e2-b95c-5567-817b-bb9b1b9e272e';
    public const DEFAULT_SHARD_MR_UUID = '50cbb7cb-e51a-5118-b389-057176668991';
    public const DEFAULT_SHARD_MRS_UUID = '4a111770-aedd-519e-84a2-9b4080c1ea1c';

    public const DEFAULT_SOURCE_NAME = 'fake.surname';
    public const DEFAULT_SOURCE_VERSION = '1.0';
    public const DEFAULT_KEY_MR = ['prefix' => 'Mr'];
    public const DEFAULT_KEY_MRS = ['prefix' => 'Mrs'];

    public function factory(Key $key, Profile $profile): Board
    {
        $board = new Board($key, $profile);
        $board->addShard(
            new Key(self::DEFAULT_KEY_MR),
            new Source(
                new Name(self::DEFAULT_SOURCE_NAME),
                new Version(self::DEFAULT_SOURCE_VERSION)
            )
        );
        $board->addShard(
            new Key(self::DEFAULT_KEY_MRS),
            new Source(
                new Name(self::DEFAULT_SOURCE_NAME),
                new Version(self::DEFAULT_SOURCE_VERSION)
            )
        );

        return $board;
    }
}
