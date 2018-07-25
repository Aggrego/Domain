<?php

namespace spec\TimiTao\Construo\Domain\Api\Command\TransformBoard;

use PhpSpec\ObjectBehavior;
use TimiTao\Construo\Domain\Api\Command\TransformBoard\Command;

class CommandSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('test');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Command::class);
    }

    function it_should_have_board_uuid()
    {
        $this->getBoardUuid()->shouldBeString();
    }
}