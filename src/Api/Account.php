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

  /**
   * @return stdClass
   */
  public function TldPrices($currency_code)
  {
    $content = $this->adapter->get('/v3/tlds/pricing', ["currency_code" => $currency_code]);
    return json_decode($content);
  }
}
