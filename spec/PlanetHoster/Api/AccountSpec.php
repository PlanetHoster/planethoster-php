<?php

namespace spec\PlanetHoster\Api;

use PlanetHoster\Api\Account;
use PlanetHoster\Adapter\Adapter;
use PhpSpec\ObjectBehavior;

class AccountSpec extends ObjectBehavior
{

    function let(Adapter $adapter)
    {
        $this->beConstructedWith($adapter);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Account::class);
    }

    function it_should_return_account_info(Adapter $adapter)
    {
        $mockResponse = '
{
    "message":"Account information successfully obtained",
    "credit_remaining":"1234.56",
    "credit_currency":"EUR",
    "num_active_orders":1,
    "num_active_domains":6,
    "reseller_id":"a1b2c3"
}
';
        $adapter->get('/v3/account/info')->willReturn($mockResponse);
        $this->Info()->shouldReturnAnInstanceOf('stdClass');
    }
}
