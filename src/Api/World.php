<?php

namespace PlanetHoster\Api;

use PlanetHoster\Adapter\Adapter;

class World extends Api {

  /**
   * @return stdClass
   */
  public function GetAccounts() {
    $content = $this->adapter->get($this->uri('get-accounts'));
    return json_decode($content);
  }
  
  /**
   * @param string $path
   * 
   * @return string
   */
  protected function uri($path) {
    return sprintf("/world-api/%s", $path);
  }
}