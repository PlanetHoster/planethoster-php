<?php

namespace PlanetHoster\Entity;


abstract class Entity {

  /**
   * @param string $prefix
   * @param string $suffix
   * 
   * @return array
   */
  public function toArray($prefix = '', $suffix = '') {
    $arr = [];
    $called = get_called_class();
    $reflection = new \ReflectionClass($called);
    $properties = $reflection->getProperties(\ReflectionProperty::IS_PUBLIC);

    foreach ($properties as $property) {
      $prop = $property->getName();
      if (isset($this->$prop) && $property->class == $called) {
        $key = $prefix . $prop . $suffix;
        $arr[self::parameterize($key)] = $this->$prop;
      }
    }

    return $arr;
  }

  /**
   * @param $str
   *
   * @return string
   */
  protected static function parameterize($str) {
    return strtolower(implode('_', preg_split('/(?=[A-Z])/', $str, NULL, PREG_SPLIT_NO_EMPTY)));
  }
}
