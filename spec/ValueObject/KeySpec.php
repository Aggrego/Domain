<?php

namespace spec\Aggrego\Domain\ValueObject;

use PhpSpec\ObjectBehavior;
use Aggrego\Domain\ValueObject\Key;

class KeySpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(['init']);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Key::class);
    }

    function it_should_get_array_value()
    {
        $this->getValue()->shouldBeArray();
    }
}