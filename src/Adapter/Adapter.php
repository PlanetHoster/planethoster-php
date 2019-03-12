<?php

namespace PlanetHoster\Adapter;

interface Adapter {

  /**
   * @param string $uri
   * @param array|string $params
   *
   * @throws HttpException
   *
   * @return string
   */
  public function get($uri, $params = '');

  /**
   * @param string $uri
   * @param array|string $params
   *
   * @throws HttpException
   *
   * @return string
   */
  public function delete($uri, $params = '');

  /**
   * @param string $uri
   * @param array|string $params
   *
   * @throws HttpException
   *
   * @return string
   */
  public function put($uri, $content = '');

  /**
   * @param string $uri
   * @param array|string $params
   *
   * @throws HttpException
   *
   * @return string
   */
  public function post($uri, $content = '');

}