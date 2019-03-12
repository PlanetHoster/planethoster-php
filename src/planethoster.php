<?php

namespace PlanetHoster;

use PlanetHoster\Adapter\Adapter;
use PlanetHoster\Api\Domain;
use PlanetHoster\Api\World;

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

  /**
   * @return Domain
   */
  public function domain() {
    return new Domain($this->adapter);
  }

  /**
   * @return World
   */
  public function world() {
    return new World($this->adapter);
  }
}