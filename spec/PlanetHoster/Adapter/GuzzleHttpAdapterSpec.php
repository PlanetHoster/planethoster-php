<?php

namespace spec\PlanetHoster\Adapter;

use GuzzleHttp\Client;
use PlanetHoster\Adapter\GuzzleHttpAdapter;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GuzzleHttpAdapterSpec extends ObjectBehavior
{
    function let(Client $client)
    {
        $client->beConstructedWith([
            'headers' => [
              'X-API-USER' => 'api_user',
              'X-API-KEY' => 'api_key',
            ],
            'timeout' => 10,
            'base_uri' => 'http://dev.null'
          ]);
        $this->beConstructedWith('api_user', 'api_key', 10, 'http://dev.null', $client);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(GuzzleHttpAdapter::class);
    }
}
