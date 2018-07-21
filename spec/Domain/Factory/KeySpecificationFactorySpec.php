<?php

namespace spec\TimiTao\Construo\Domain\Factory;

use PhpSpec\ObjectBehavior;
use TimiTao\Construo\Domain\Exception\KeySpecificationNotFoundException;
use TimiTao\Construo\Domain\Factory\KeySpecificationFactory;
use TimiTao\Construo\Domain\KeySpecification\Specification;
use TimiTao\Construo\Domain\Model\Board\ValueObject\Name;
use TimiTao\Construo\Domain\Model\Board\ValueObject\Profile;
use TimiTao\Construo\Domain\Model\Board\ValueObject\Version;

class KeySpecificationFactorySpec extends ObjectBehavior
{
    function let(Specification $specification)
    {
        $this->beConstructedWith(
            ['test:1.0' => $specification]
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(KeySpecificationFactory::class);
    }

    function it_should_factory_specification()
    {
        $profile = new Profile(new Name('test'), new Version('1.0'));
        $this->factory($profile)->shouldBeAnInstanceOf(Specification::class);
    }

    function it_should_throw_exception_on_unknown_profile()
    {
        $profile = new Profile(new Name('unknown'), new Version('1.0'));
        $this->shouldThrow(KeySpecificationNotFoundException::class)->during('factory', [$profile]);
    }
}