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
   * @param string               $api_sandbox
   * @param integer              $timeout
   * @param string               $base_url
   */
  public function __construct($api_user, $api_key, $api_sandbox = 0, $timeout = 120, $base_url = Api::DEFAULT_ENDPOINT, ClientInterface $client = null) {
    $this->client = $client ?: new Client([
      'headers' => [
        'X-API-USER' => $api_user,
        'X-API-KEY' => $api_key,
        'X-API-SANDBOX' => $api_sandbox,
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
        if (is_null($this->response)) {
          throw $e;
        }
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
      $content = json_decode($body);
      $code = isset($content->error_code) ? $content->error_code : ((int) $this->response->getStatusCode());
      throw new HttpException(isset($content->error) ? $content->error : 'Request not processed', $code);
  }
}
