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
}
