<?php

declare(strict_types = 1);

namespace FeatureContext\Functional\Api;

use Aggrego\Domain\Api\Domain\Command\CreateBoard\Command;
use Aggrego\Domain\Api\Domain\Command\CreateBoard\UseCase;
use Aggrego\Domain\Shared\Exception\InvalidArgumentException;
use Assert\Assertion;
use Behat\Behat\Context\Context;
use Tests\Profile\BaseTestWatchman;
use Tests\Profile\BoardConstruction\Builder;
use Throwable;

class CreateBoardFeatureContext implements Context
{
    /** @var UseCase */
    private $useCase;

    /** @var Throwable */
    private $exception;

    public function __construct(UseCase $useCase)
    {
        $this->useCase = $useCase;
    }

    /**
     * @When I create board for by default key, profile and version
     */
    public function iCreateBoardForByDefaultKeyProfileAndVersion()
    {
        $this->useCase->handle(
            new Command(
                Builder::DEFAULT_KEY,
                BaseTestWatchman::DEFAULT_PROFILE,
                BaseTestWatchman::DEFAULT_VERSION
            )
        );
    }

    /**
     * @When I create board with non exist profile
     */
    public function iCreateForBoardWithNonExistProfile()
    {
        try {
            $this->useCase->handle(
                new Command(
                    Builder::DEFAULT_KEY,
                    'unknown',
                    BaseTestWatchman::DEFAULT_VERSION
                )
            );
        } catch (Throwable $e) {
            $this->exception = $e;
        }
    }

    /**
     * @When I create board with non exist version for default profile
     */
    public function iCreateBoardWithNonExistVersionForDefaultProfile()
    {
        try {
            $this->useCase->handle(
                new Command(
                    Builder::DEFAULT_KEY,
                    BaseTestWatchman::DEFAULT_PROFILE,
                    '0.0'
                )
            );
        } catch (Throwable $e) {
            $this->exception = $e;
        }
    }

    /**
     * @When I create board with invalid key for default profile
     */
    public function iCreateBoardWithInvalidKeyForDefaultProfile()
    {
        try {
            $this->useCase->handle(
                new Command(
                    ['invalid'],
                    BaseTestWatchman::DEFAULT_PROFILE,
                    BaseTestWatchman::DEFAULT_VERSION
                )
            );
        } catch (Throwable $e) {
            $this->exception = $e;
        }
    }

    /**
     * @Then create command should be rejected
     */
    public function createCommandShouldBeRejected()
    {
        Assertion::isInstanceOf($this->exception, InvalidArgumentException::class);
    }
}
