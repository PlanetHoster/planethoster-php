<?php

namespace PlanetHoster;

use PlanetHoster\Adapter\Adapter;
use PlanetHoster\Api\Account;
use PlanetHoster\Api\Domain;
use PlanetHoster\Api\World;
use PlanetHoster\Api\Hosting\Emails;

class PlanetHoster
{

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
   * @return Account
   */
  public function account()
  {
    return new Account($this->adapter);
  }

  /**
   * @return Domain
   */
  public function domain()
  {
    return new Domain($this->adapter);
  }

  /**
   * @return World
   */
  public function world()
  {
    return new World($this->adapter);
  }

  /**
   * @return Email
   */
  public function emails()
  {
    return new Emails($this->adapter);
  }
}
