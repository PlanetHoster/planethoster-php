<?php

namespace PlanetHoster\Api;

use PlanetHoster\Adapter\Adapter;

abstract class Api {

  /**
   * @var string
   */
  const DEFAULT_ENDPOINT = 'https://api.planethoster.net';

  /**
   * @var Adapter
   */
  protected $adapter;
  
  public function __construct(Adapter $adapter) {
    $this->adapter = $adapter;
  }
}