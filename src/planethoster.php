<?php

namespace PlanetHoster;

use PlanetHoster\Adapter\Adapter;

class PlanetHoster {

  /**
   * @var Adapter
   */
  protected $adapter;

  /**
   * @param Adapter $adapter
   */
  public function __construct(Adapter $adapter)
  {
      $this->adapter = $adapter;
  }
}