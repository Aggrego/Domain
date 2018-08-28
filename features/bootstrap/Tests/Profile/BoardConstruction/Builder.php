<?php

declare(strict_types = 1);

namespace Tests\Profile\BoardConstruction;

use Aggrego\Domain\Profile\BoardConstruction\Builder as DomainBuilder;
use Aggrego\Domain\Profile\BoardConstruction\Exception\UnableToBuildBoardException;
use Aggrego\Domain\Profile\BoardConstruction\InitialBoardModel\AbstractBoard;
use Aggrego\Domain\Profile\BoardConstruction\InitialBoardModel\Board;
use Aggrego\Domain\Profile\BoardConstruction\InitialBoardModel\ProgressiveBoard;
use Aggrego\Domain\Profile\Profile;
use Aggrego\Domain\ProgressiveBoard\Step\State;
use Aggrego\Domain\Shared\ValueObject\Key;

class Builder implements DomainBuilder
{
    public const DEFAULT_KEY = ['key' => 'init'];

    public const INITIAL_SHARDS_COUNT = 2;

    public const DEFAULT_BOARD_UUID = 'd0b7e1e2-b95c-5567-817b-bb9b1b9e272e';
    public const DEFAULT_SHARD_MR_UUID = '50cbb7cb-e51a-5118-b389-057176668991';
    public const DEFAULT_SHARD_MRS_UUID = '4a111770-aedd-519e-84a2-9b4080c1ea1c';

    public const DEFAULT_SOURCE_NAME = 'fake.surname';
    public const DEFAULT_SOURCE_VERSION = '1.0';
    public const DEFAULT_KEY_MR = ['prefix' => 'Mr'];
    public const DEFAULT_KEY_MRS = ['prefix' => 'Mrs'];

    /** @var Profile */
    private $profile;

    public function __construct(Profile $profile)
    {
        $this->profile = $profile;
    }

    /**
     * @param Key $key
     * @return Board
     * @throws UnableToBuildBoardException
     */
    public function build(Key $key): Board
    {
        if (!isset($key->getValue()['key'])) {
            throw new UnableToBuildBoardException();
        }
        $board = new ProgressiveBoard($key, $this->profile, State::createInitial());
        $board->addShard(
            new Key(self::DEFAULT_KEY_MR),
            Profile::createFrom(self::DEFAULT_SOURCE_NAME, self::DEFAULT_SOURCE_VERSION)
        );
        $board->addShard(
            new Key(self::DEFAULT_KEY_MRS),
            Profile::createFrom(self::DEFAULT_SOURCE_NAME, self::DEFAULT_SOURCE_VERSION)
        );

        return $board;
    }
}
