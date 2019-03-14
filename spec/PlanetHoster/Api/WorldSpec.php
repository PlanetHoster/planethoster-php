<?php

namespace spec\PlanetHoster\Api;

use PlanetHoster\Api\World;
use PlanetHoster\Adapter\Adapter;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class WorldSpec extends ObjectBehavior
{

    function let(Adapter $adapter) 
    {
        $this->beConstructedWith($adapter);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(World::class);
    }

    function it_should_return_accounts(Adapter $adapter) 
    {
        $adapter->get('/world-api/get-accounts')
            ->willReturn('
        {
            "nb_active_or_suspended_accounts":5,
            "total_available_ressources":{
               "cpu":177,
               "mem":482,
               "io":482
            },
            "world_accounts":[],
            "reseller_id":"a1b2c3"
         }
        ');
        
        $accounts = $this->GetAccounts();
        $accounts->shouldReturnAnInstanceOf('stdClass');
        $accounts->world_accounts->shouldBeArray();
        $accounts->world_accounts->shouldHaveCount(0);
    }
}
