<?php

namespace PlanetHoster\Api;

class Account extends Api
{

  /**
   * @return stdClass
   */
  public function Hello()
  {
    $content = $this->adapter->get('/v3/hello');
    return json_decode($content);
  }

  /**
   * @return stdClass
   */
  public function Info()
  {
    $content = $this->adapter->get('/v3/account/info');
    return json_decode($content);
  }
}
