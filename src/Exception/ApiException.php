<?php

namespace PlanetHoster\Exception;

class ApiException extends HttpException {

  const ERROR_GENERAL = 5000;
  const ERROR_NETWORK = 5001;
  const ERROR_INTERNAL = 5002;
  const ERROR_AUTHENTICATION = 5003;
  const ERROR_FORBIDDEN = 5004;
}