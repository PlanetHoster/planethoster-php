<?php

namespace spec\PlanetHoster\Entity;

use PlanetHoster\Entity\DnsRecord;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DnsRecordSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(DnsRecord::class);
    }
}
