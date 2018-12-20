<?php

declare(strict_types = 1);

namespace Tests\Domain\ProgressiveBoard;

use Aggrego\Domain\Board\Board;
use Aggrego\Domain\Board\Exception\BoardNotFoundException;
use Aggrego\Domain\Board\Repository as BoardRepository;
use Aggrego\Domain\Board\Uuid;

class Repository implements BoardRepository
{
    /** @var array */
    private $list;

    public function __construct()
    {
        $this->clear();
    }

    public function addBoard(Board $board): void
    {
        $this->list[(string)$board->getUuid()->getValue()] = $board;
    }

    public function getBoardByUuid(Uuid $uuid): Board
    {
        /** @var Board $board */
        foreach ($this->list as $board) {
            if ($uuid->equal($board->getUuid())) {
                return $board;
            }
        }
        throw new BoardNotFoundException(sprintf('Board not found with uuid: %s', $uuid->getValue()));
    }

    public function clear(): void
    {
        $this->list = [];
    }

    public function getList(): array
    {
        return $this->list;
    }
}
