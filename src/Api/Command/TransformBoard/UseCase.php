<?php

declare(strict_types = 1);

namespace Aggrego\Domain\Api\Command\TransformBoard;

use Aggrego\Domain\Api\Command\TransformBoard\Exception\InvalidCommandDataException;
use Aggrego\Domain\Board\Factory;
use Aggrego\Domain\Board\Repository;

class UseCase
{
    /** @var Repository */
    private $repository;

    /** @var Factory */
    private $factory;

    public function __construct(Repository $repository, Factory $factory)
    {
        $this->repository = $repository;
        $this->factory = $factory;
    }

    /**
     * @param Command $command
     * @throws InvalidCommandDataException
     */
    public function handle(Command $command): void
    {
        $board = $this->repository->getBoardByUuid($command->getBoardUuid());
        $newBoard = $this->factory->fromBoard($board);
        $this->repository->addBoard($newBoard);
    }
}