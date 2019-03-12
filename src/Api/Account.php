<?php

namespace PlanetHoster\Api;

use PlanetHoster\Adapter\Adapter;

class Account extends Api {

  /**
   * @return stdClass
   */
  public function Info() {
    $content = $this->adapter->get('/reseller-api/account-info');
    return json_decode($content);
  }
}