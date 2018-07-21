<?php

namespace spec\TimiTao\Construo\Domain\Model\Board\ValueObject;

use PhpSpec\ObjectBehavior;
use TimiTao\Construo\Domain\Model\Board\ValueObject\Key;

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