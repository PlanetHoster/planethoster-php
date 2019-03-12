<?php

namespace PlanetHoster;

use PlanetHoster\Adapter\AdapterInterface;

class PlanetHoster {

  /**
   * @var AdapterInterface
   */
  protected $adapter;

  /**
   * @param AdapterInterface $adapter
   */
  public function __construct(AdapterInterface $adapter)
  {
      $this->adapter = $adapter;
  }
}