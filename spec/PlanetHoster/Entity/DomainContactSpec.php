<?php

namespace spec\PlanetHoster\Entity;

use PlanetHoster\Entity\DomainContact;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DomainContactSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(DomainContact::class);
    }
}
