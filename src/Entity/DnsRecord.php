<?php

namespace PlanetHoster\Entity;

class DnsRecord extends Entity
{

  /**
   * @var string
   */
  public $Hostname;

  /**
   * @var string
   */
  public $Address;

  /**
   * @var string
   */
  public $Type;

  /**
   * @var integer
   */
  public $Priority;
}
