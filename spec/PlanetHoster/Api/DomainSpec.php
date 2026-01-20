<?php

namespace spec\PlanetHoster\Api;

use PlanetHoster\Api\Domain;
use PlanetHoster\Adapter\Adapter;
use PhpSpec\ObjectBehavior;

class DomainSpec extends ObjectBehavior
{

    function let(Adapter $adapter)
    {
        $this->beConstructedWith($adapter);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Domain::class);
    }
}
