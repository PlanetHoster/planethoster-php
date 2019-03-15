<?php

namespace PlanetHoster\Api;

use PlanetHoster\Adapter\Adapter;
use PlanetHoster\Entity\DnsRecord;
use PlanetHoster\Entity\DomainContact;

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
   * @param string        $sld
   * @param string        $tld
   * @param DomainContact $registrant
   * @param DomainContact $admin
   * @param DomainContact $tech
   * @param DomainContact $billing
   * 
   * @throws InvalidArgumentException
   * 
   * @return stdClass
   */
  public function SaveContactDetails($sld, $tld, 
      DomainContact $registrant = null,
      DomainContact $admin = null, 
      DomainContact $tech = null, 
      DomainContact $billing = null) {
    $params = [];
    if($registrant !== null) {
      $params = array_merge($params, $registrant->toArray('registrant'));
    }
    if($admin !== null) {
      $params = array_merge($params, $admin->toArray('admin'));
    }
    if($tech !== null) {
      $params = array_merge($params, $tech->toArray('tech'));
    }
    if($billing !== null) {
      $params = array_merge($params, $billing->toArray('billing'));
    }

    if(empty($params)) {
      throw new InvalidArgumentException('require at least one of: registrant, admin, tech or billing');
    }

    $params = array_merge($params, [
      'sld' => $sld,
      'tld' => $tld,
    ]);

    $content = $this->adapter->post($this->uri('save-contact-details'), $params);
    return json_decode($content);
  }

  /**
   * @param string $sld
   * @param string $tld
   * @param array  $nameservers
   * 
   * @return stdClass
   */
  public function SaveNameservers($sld, $tld, $nameservers) {
    $params = [
      'sld' => $sld,
      'tld' => $tld,
    ];

    for($i = 0; $i < sizeof($nameservers); $i++) {
      $params[sprintf("ns%d", $i+1)] = $nameservers[$i];
    }

    $content = $this->adapter->post($this->uri('save-nameservers'), $params);
    return json_decode($content);
  }

  /**
   * @param string    $sld
   * @param string    $tld
   * @param DnsRecord $records
   * 
   * @return stdClass
   */
  public function SavePhDnsRecords($sld, $tld, DnsRecord ...$records) {
    $params = [
      'sld' => $sld,
      'tld' => $tld,
    ];

    $count = 0;
    foreach ($records as $record) {
      $count++;
      $params = array_merge($params, $record->toArray('', "$count"));
    }

    $content = $this->adapter->post($this->uri('save-ph-dns-records'), $params);
    return json_decode($content);
  }

  /**
   * @param string  $sld
   * @param string  $tld
   * @param boolean $lock
   * 
   * @return stdClass
   */
  public function SaveRegistrarLock($sld, $tld, boolean $lock) {
    $content = $this->adapter->post($this->uri('save-registrar-lock'), [
      'sld' => $sld,
      'tld' => $tld,
      'lock_action' => ($lock ? 'Lock' : 'Unlock'),
    ]);
    return json_decode($content);
  }

  /**
   * @param string $sld
   * @param string $tld
   * 
   * @return stdClass
   */
  public function EmailEppCode($sld, $tld) {
    $content = $this->adapter->post($this->uri('email-epp-code'), [
      'sld' => $sld,
      'tld' => $tld,
    ]);
    return json_decode($content);
  }

  /**
   * @param string        $sld
   * @param string        $tld
   * @param integer       $period
   * @param array         $nameservers
   * @param DomainContact $registrant
   * @param DomainContact $admin
   * @param DomainContact $tech
   * @param DomainContact $billing
   * @param boolean       $register_if_premium
   * @param array         $addtl_fields
   * 
   * @return stdClass
   */
  public function RegisterDomain($sld, $tld, $period, $nameservers, DomainContact $registrant,
      DomainContact $admin = null, 
      DomainContact $tech = null, 
      DomainContact $billing = null, 
      $register_if_premium = false,
      $addtl_fields = []) {
    $params = [
      'sld' => $sld,
      'tld' => $tld,
      'period' => $period,
      'register_if_premium' => $register_if_premium,
      'addtl_fields' => $addtl_fields,
    ];

    for($i = 0; $i < sizeof($nameservers); $i++) {
      $params[sprintf("ns%d", $i+1)] = $nameservers[$i];
    }

    $params = array_merge($params, $registrant->toArray('registrant'));
    if($admin !== null) {
      $params = array_merge($params, $admin->toArray('admin'));
    }
    if($tech !== null) {
      $params = array_merge($params, $tech->toArray('tech'));
    }
    if($billing !== null) {
      $params = array_merge($params, $billing->toArray('billing'));
    }

    $content = $this->adapter->post($this->uri('register-domain'), $params);
    return json_decode($content);
  }

  /**
   * @param string  $sld
   * @param string  $tld
   * @param integer $period
   * 
   * @return stdClass
   */
  public function RenewDomain($sld, $tld, $period) {
    $content = $this->adapter->post($this->uri('renew-domain'), [
      'sld' => $sld,
      'tld' => $tld,
      'period' => $period,
    ]);
    return json_decode($content);
  }

  /**
   * @param string $sld
   * @param string $tld
   * @param string $epp_code
   * 
   * @return stdClass
   */
  public function TransferDomain($sld, $tld, $epp_code) {
    $content = $this->adapter->post($this->uri('transfer-domain'), [
      'sld' => $sld,
      'tld' => $tld,
      'epp_code' => $epp_code,
    ]);
    return json_decode($content);
  }

  /**
   * @param string $sld
   * @param string $tld
   * 
   * @return stdClass
   */
  public function DeletePhDnsZone($sld, $tld) {
    $content = $this->adapter->post($this->uri('delete-ph-dns-zone'), [
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