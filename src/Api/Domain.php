<?php

namespace PlanetHoster\Api;

use PlanetHoster\Entity\DnsRecord;
use PlanetHoster\Entity\DomainContact;

class Domain extends Api
{
  /**
   * @return stdClass
   */
  public function Domains()
  {
    $content = $this->adapter->get('/v3/domains');
    return json_decode($content);
  }

  /**
   * @param string $sld
   * @param string $tld
   * 
   * @return stdClass
   */
  public function DomainInfo($sld, $tld)
  {
    $content = $this->adapter->get('/v3/domain', [
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
  public function CheckAvailability($sld, $tld)
  {
    $content = $this->adapter->get('/v3/domain/availability', [
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
  public function RegisterDomain(
    $sld,
    $tld,
    $period,
    $nameservers,
    DomainContact $registrant,
    ?DomainContact $admin = null,
    ?DomainContact $tech = null,
    ?DomainContact $billing = null,
    $register_if_premium = false,
    $id_protection = false,
    $addtl_fields = []
  ) {
    $params = [
      'sld' => $sld,
      'tld' => $tld,
      'period' => $period,
      'register_if_premium' => $register_if_premium,
      'addtl_fields' => $addtl_fields,
      'id_protection' => $id_protection
    ];

    for ($i = 0; $i < sizeof($nameservers); $i++) {
      $params[sprintf("ns%d", $i + 1)] = $nameservers[$i];
    }

    $params['use_planethoster_nameservers'] = empty(array_diff(['nsa.n0c.com', 'nsb.n0c.com', 'nsc.n0c.com'], $nameservers));

    $params = array_merge($params, $registrant->toArray('registrant'));
    if ($admin !== null) {
      $params = array_merge($params, $admin->toArray('admin'));
    }
    if ($tech !== null) {
      $params = array_merge($params, $tech->toArray('tech'));
    }
    if ($billing !== null) {
      $params = array_merge($params, $billing->toArray('billing'));
    }

    $content = $this->adapter->post('/v3/domain/register', $params);
    return json_decode($content);
  }

  /**
   * @param string $sld
   * @param string $tld
   * @param string $epp_code
   * 
   * @return stdClass
   */
  public function TransferDomain($sld, $tld, $epp_code)
  {
    $content = $this->adapter->post('/v3/domain/transfer', [
      'sld' => $sld,
      'tld' => $tld,
      'epp_code' => $epp_code,
    ]);
    return json_decode($content);
  }

  /**
   * @param string  $sld
   * @param string  $tld
   * @param integer $period
   * 
   * @return stdClass
   */
  public function RenewDomain($sld, $tld, $period)
  {
    $content = $this->adapter->post('/v3/domain/renew', [
      'sld' => $sld,
      'tld' => $tld,
      'period' => $period,
    ]);
    return json_decode($content);
  }

  /**
   * @param string $sld
   * @param string $tld
   * 
   * @return stdClass
   */
  public function ContactDetails($sld, $tld)
  {
    $content = $this->adapter->get('/v3/domain/contacts', [
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
  public function UpdateContactDetails(
    $sld,
    $tld,
    ?DomainContact $registrant = null,
    ?DomainContact $admin = null,
    ?DomainContact $tech = null,
    ?DomainContact $billing = null
  ) {
    $params = [];
    if ($registrant !== null) {
      $params = array_merge($params, $registrant->toArray('registrant'));
    }
    if ($admin !== null) {
      $params = array_merge($params, $admin->toArray('admin'));
    }
    if ($tech !== null) {
      $params = array_merge($params, $tech->toArray('tech'));
    }
    if ($billing !== null) {
      $params = array_merge($params, $billing->toArray('billing'));
    }

    if (empty($params)) {
      throw new \InvalidArgumentException('require at least one of: registrant, admin, tech or billing');
    }

    $params = array_merge($params, [
      'sld' => $sld,
      'tld' => $tld,
    ]);

    $content = $this->adapter->patch('/v3/domain/contacts', $params);
    return json_decode($content);
  }

  /**
   * @param string $sld
   * @param string $tld
   * 
   * @return stdClass
   */
  public function RegistrarLock($sld, $tld)
  {
    $content = $this->adapter->get('/v3/domain/lock', [
      'sld' => $sld,
      'tld' => $tld,
    ]);
    return json_decode($content);
  }

  /**
   * @param string  $sld
   * @param string  $tld
   * 
   * @return stdClass
   */
  public function ActivateRegistrarLock($sld, $tld)
  {
    $content = $this->adapter->put('/v3/domain/lock', [
      'sld' => $sld,
      'tld' => $tld,
      'lock_action' => 'Lock'
    ]);
    return json_decode($content);
  }

  /**
   * @param string  $sld
   * @param string  $tld
   * 
   * @return stdClass
   */
  public function DeactivateRegistrarLock($sld, $tld)
  {
    $content = $this->adapter->delete('/v3/domain/lock', [
      'sld' => $sld,
      'tld' => $tld,
      'lock_action' => 'Unlock'
    ]);
    return json_decode($content);
  }

  /**
   * @param string $sld
   * @param string $tld
   * 
   * @return stdClass
   */
  public function Nameservers($sld, $tld)
  {
    $content = $this->adapter->get('/v3/domain/nameservers', [
      'sld' => $sld,
      'tld' => $tld,
    ]);
    return json_decode($content);
  }

  /**
   * @param string $sld
   * @param string $tld
   * @param array  $nameservers
   * 
   * @return stdClass
   */
  public function UpdateNameservers($sld, $tld, $nameservers)
  {
    $params = [
      'sld' => $sld,
      'tld' => $tld,
    ];

    for ($i = 0; $i < sizeof($nameservers); $i++) {
      $params[sprintf("ns%d", $i + 1)] = $nameservers[$i];
    }

    $content = $this->adapter->put('/v3/domain/nameservers', $params);
    return json_decode($content);
  }

  /**
   * @param string $sld
   * @param string $tld
   * 
   * @return stdClass
   */
  public function EmailEppCode($sld, $tld)
  {
    $content = $this->adapter->post('/v3/domain/auth-info', [
      'sld' => $sld,
      'tld' => $tld,
    ]);
    return json_decode($content);
  }
}
