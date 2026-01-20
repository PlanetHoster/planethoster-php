<?php

namespace spec\PlanetHoster;

use PlanetHoster\PlanetHoster;
use PlanetHoster\Adapter\Adapter;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PlanetHosterSpec extends ObjectBehavior
{
    function let(Adapter $adapter)
    {
        $this->beConstructedWith($adapter);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(PlanetHoster::class);
    }

    function it_should_return_an_account_instance()
    {
        $this->account()->shouldBeAnInstanceOf('PlanetHoster\Api\Account');
    }

    function it_should_return_a_domain_instance()
    {
        $this->domain()->shouldBeAnInstanceOf('PlanetHoster\Api\Domain');
    }

    function it_should_return_a_hosting_instance()
    {
        $this->hosting()->shouldBeAnInstanceOf('PlanetHoster\Api\Hosting');
    }
}
