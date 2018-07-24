<?php

namespace spec\TimiTao\Construo\Domain\Exception;

use PhpSpec\ObjectBehavior;
use RuntimeException;
use TimiTao\Construo\Domain\Exception\BoardFactoryNotFoundException;

class BoardFactoryNotFoundExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(BoardFactoryNotFoundException::class);
        $this->shouldBeAnInstanceOf(RuntimeException::class);
    }
}
