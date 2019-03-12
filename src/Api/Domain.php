<?php

namespace PlanetHoster\Api;

use PlanetHoster\Adapter\Adapter;

class Domain extends Api {

  /**
   * @return stdClass
   */
  public function TldPrices() {
    $content = $this->adapter->get($this->uri('tld-prices'));
    return json_decode($content);
  }

  /**
   * @param string $sld
   * @param string $tld
   * 
   * @return stdClass
   */
  public function CheckAvailability($sld, $tld) {
    $content = $this->adapter->get($this->uri('check-availability'), [
      'sld' => $sld,
      'tld' => $tld,
    ]);
    return json_decode($content);
  }

  /**
   * @param string $sld
   * @param string $tld
   * 
   * @return stdClass
   */
  public function DomainInfo($sld, $tld) {
    $content = $this->adapter->get($this->uri('domain-info'), [
      'sld' => $sld,
      'tld' => $tld,
    ]);
    return json_decode($content);
  }

  /**
   * @param string $sld
   * @param string $tld
   * 
   * @return stdClass
   */
  public function GetContactDetails($sld, $tld) {
    $content = $this->adapter->get($this->uri('get-contact-details'), [
      'sld' => $sld,
      'tld' => $tld,
    ]);
    return json_decode($content);
  }

  /**
   * @param string $sld
   * @param string $tld
   * 
   * @return stdClass
   */
  public function GetNameservers($sld, $tld) {
    $content = $this->adapter->get($this->uri('get-nameservers'), [
      'sld' => $sld,
      'tld' => $tld,
    ]);
    return json_decode($content);
  }

  /**
   * @param string $sld
   * @param string $tld
   * 
   * @return stdClass
   */
  public function GetPhDnsRecords($sld, $tld) {
    $content = $this->adapter->get($this->uri('get-ph-dns-records'), [
      'sld' => $sld,
      'tld' => $tld,
    ]);
    return json_decode($content);
  }

  /**
   * @param string $sld
   * @param string $tld
   * 
   * @return stdClass
   */
  public function GetRegistrarLock($sld, $tld) {
    $content = $this->adapter->get($this->uri('get-registrar-lock'), [
      'sld' => $sld,
      'tld' => $tld,
    ]);
    return json_decode($content);
  }

  /**
   * @param string $path
   * 
   * @return string
   */
  protected function uri($path) {
    return sprintf("/reseller-api/%s", $path);
  }
}