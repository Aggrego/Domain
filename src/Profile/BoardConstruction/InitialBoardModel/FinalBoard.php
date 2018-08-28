<?php

declare(strict_types = 1);

namespace Aggrego\Domain\Profile\BoardConstruction\InitialBoardModel;

use Aggrego\Domain\Profile\Profile;
use Aggrego\Domain\ProgressiveBoard\Step\State;
use Aggrego\Domain\Shared\ValueObject\Data;
use Aggrego\Domain\Shared\ValueObject\Key;

final class FinalBoard extends AbstractBoard
{
    /** @var Data  */
    private $data;

    public function __construct(Key $key, Profile $profile, Data $data)
    {
        parent::__construct($key, $profile);
        $this->data = $data;
    }

    public function getState(): State
    {
        return State::createFinal();
    }

    public function getData(): Data
    {
        return $this->data;
    }
}
