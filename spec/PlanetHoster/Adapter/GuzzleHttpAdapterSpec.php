<?php

namespace spec\PlanetHoster\Adapter;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Stream;
use PlanetHoster\Adapter\GuzzleHttpAdapter;
use PhpSpec\ObjectBehavior;

class GuzzleHttpAdapterSpec extends ObjectBehavior
{
  function let(Client $client)
  {
    $this->beConstructedWith('api_user', 'api_key', 'api_sandbox', 10, 'http://dev.null', $client);
  }

  function it_is_initializable()
  {
    $this->shouldHaveType(GuzzleHttpAdapter::class);
  }

  function it_should_return_json(Client $client, Response $response, Stream $stream)
  {
    $client->request('GET', '/json', ['query' => ''])->willReturn($response);
    $response->getBody()->willReturn($stream);
    $stream->__toString()->willReturn('{"foo":"bar"}');

    $this->get('/json')->shouldBe('{"foo":"bar"}');
  }

  function it_should_set_query_params(Client $client, Response $response, Stream $stream)
  {
    $client->request('GET', '/query', ['query' => ['foo' => 'bar']])->willReturn($response);
    $response->getBody()->willReturn($stream);
    $stream->__toString()->willReturn('{"foo":"bar"}');

    $this->get('/query', ['foo' => 'bar'])->shouldBe('{"foo":"bar"}');
  }

  function it_should_post_params(Client $client, Response $response, Stream $stream)
  {
    $client->request('POST', '/post', ['form_params' => ['foo' => 'bar']])->willReturn($response);
    $response->getBody()->willReturn($stream);
    $stream->__toString()->willReturn('{"foo":"bar"}');

    $this->post('/post', ['foo' => 'bar'])->shouldBe('{"foo":"bar"}');
  }

  function it_should_post_content(Client $client, Response $response, Stream $stream)
  {
    $client->request('POST', '/postcontent', ['body' => 'foo=bar'])->willReturn($response);
    $response->getBody()->willReturn($stream);
    $stream->__toString()->willReturn('{"foo":"bar"}');

    $this->post('/postcontent', 'foo=bar')->shouldBe('{"foo":"bar"}');
  }
}
