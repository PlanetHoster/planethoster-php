<?php

namespace spec\PlanetHoster\Api;

use PlanetHoster\Api\Domain;
use PlanetHoster\Adapter\Adapter;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

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
