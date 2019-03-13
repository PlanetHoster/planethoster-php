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
   * @param string  $domain
   * @param string  $country
   * @param integer $cpu
   * @param integer $mem
   * @param integer $io
   * @param string  $cms
   * 
   * @return stdClass
   */
  public function Create($domain, $country, $cpu, $mem, $io, $cms = '') {
    $content = $this->adapter->post($this->uri('create-account'), [
      'domain' => $domain,
      'country' => $country,
      'cpu' => $cpu,
      'mem' => $mem,
      'io' => $io,
      'cms' => $cms,
    ]);
    return json_decode($content);
  }

  /**
   * @param string  $id
   * @param string  $reason
   * 
   * @return stdClass
   */
  public function Suspend($id, $reason) {
    $content = $this->adapter->post($this->uri('suspend-account'), [
      'id' => $id,
      'reason' => $reason,
    ]);
    return json_decode($content);
  }

  /**
   * @param string  $id
   * 
   * @return stdClass
   */
  public function Unsuspend($id) {
    $content = $this->adapter->post($this->uri('unsuspend-account'), [
      'id' => $id,
    ]);
    return json_decode($content);
  }

  /**
   * @param string  $id
   * @param integer $cpu
   * @param integer $mem
   * @param integer $io
   * 
   * @return stdClass
   */
  public function ModifyRessources($id, $cpu, $mem, $io) {
    $content = $this->adapter->post($this->uri('modify-ressources'), [
      'id' => $id,
      'cpu' => $cpu,
      'mem' => $mem,
      'io' => $io,
    ]);
    return json_decode($content);
  }
  

  /**
   * @param integer $cpu
   * @param integer $mem
   * @param integer $io
   * 
   * @return stdClass
   */
  public function UpgradePlan($cpu, $mem, $io) {
    $content = $this->adapter->post($this->uri('upgrade-plan'), [
      'cpu' => $cpu,
      'mem' => $mem,
      'io' => $io,
    ]);
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