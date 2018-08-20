<?php

namespace spec\Aggrego\Domain\Profile\BoardConstruction;

use Aggrego\Domain\Profile\BoardConstruction\Builder;
use Aggrego\Domain\Profile\BoardConstruction\Exception\BuilderNotFoundException;
use Aggrego\Domain\Profile\BoardConstruction\Factory;
use Aggrego\Domain\Profile\BoardConstruction\Watchman;
use Aggrego\Domain\Profile\Profile;
use InvalidArgumentException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use stdClass;

class FactorySpec extends ObjectBehavior
{
    function let(Watchman $watchman, Builder $builder)
    {
        $profile = Profile::createFrom('test', '1.0');
        $watchman->isSupported($profile)->willReturn(true);
        $watchman->passBuilder($profile)->willReturn($builder);
        $this->beConstructedWith([$watchman]);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Factory::class);
    }

    function it_should_factory_board_factory()
    {
        $profile = Profile::createFrom('test', '1.0');
        $this->factory($profile)->shouldBeAnInstanceOf(Builder::class);
    }

    function it_should_throw_exception_on_unknown_profile(Watchman $watchman)
    {
        $profile = Argument::type(Profile::class);
        $watchman->isSupported($profile)->willReturn(false);
        $this->beConstructedWith([$watchman]);

        $profile = Profile::createFrom('unknown', '1.0');
        $this->shouldThrow(BuilderNotFoundException::class)->during('factory', [$profile]);
    }

    function it_should_throw_exception_on_wrong_watchmen_initialization()
    {
        $this->beConstructedWith([new stdClass()]);
        $this->shouldThrow(InvalidArgumentException::class)->duringInstantiation();
    }
}