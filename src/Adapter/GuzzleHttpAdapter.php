<?php

namespace PlanetHoster\Adapter;

use PlanetHoster\Api\Api;
use PlanetHoster\Exception\HttpException;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Response;

class GuzzleHttpAdapter implements Adapter {

  /**
   * @var ClientInterface
   */
  protected $client;

  /**
   * @var Response
   */
  protected $response;

  /**
   * @param string               $api_user
   * @param string               $api_key
   * @param integer              $timeout
   * @param string               $base_url
   */
  public function __construct($api_user, $api_key, $timeout = 10, $base_url = Api::DEFAULT_ENDPOINT) {
    $this->client = new Client([
      'headers' => [
        'X-API-USER' => $api_user,
        'X-API-KEY' => $api_key,
      ],
      'timeout' => $timeout,
      'base_uri' => $base_url
    ]);
  }

  /**
   * {@inheritdoc}
   */
  public function get($uri, $params = '') {
    return $this->request('GET', $uri, ['query' => $params]);
  }

  /**
   * {@inheritdoc}
   */
  public function delete($uri, $params = '') {
    return $this->request('DELETE', $uri, ['query' => $params]);
  }

  /**
   * {@inheritdoc}
   */
  public function put($uri, $content = '') {
    $options = [];
    $options[is_array($content) ? 'form_params' : 'body'] = $content;

    return $this->request('PUT', $uri, $options);
  }

  /**
   * {@inheritdoc}
   */
  public function post($uri, $content = '') {
    $options = [];
    $options[is_array($content) ? 'form_params' : 'body'] = $content;

    return $this->request('POST', $uri, $options);
  }

  /**
   * @param string $method
   * @param string $uri
   * @param array $options
   * 
   * @throws HttpException
   * 
   * @return string
   */
  protected function request($method, $uri, $options) {
    try {
      $this->response = $this->client->request($method, $uri, $options);
    } catch (RequestException $e) {
        $this->response = $e->getResponse();
        $this->handleError();
    }
    return (string)$this->response->getBody();
  }

  /**
   * @throws HttpException
   */
  protected function handleError()
  {
      $body = (string) $this->response->getBody();
      $code = (int) $this->response->getStatusCode();
      $content = json_decode($body);
      throw new HttpException(isset($content->message) ? $content->message : 'Request not processed', $code);
  }
}