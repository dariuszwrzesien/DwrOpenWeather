<?php

namespace Dwr\OpenWeather\Factory;

class RequestFactory
{
    const REQUEST_NAMESPACE = 'Dwr\\OpenWeather\\Request\\';

    /**
     * @var string
     */
    private $requestClass;

    /**
     * RequestFactory constructor.
     * @param string $requestType
     */
    public function __construct($requestType)
    {
        $this->requestClass = self::REQUEST_NAMESPACE . $requestType;
    }

    /**
     * @return mixed
     */
    public function create()
    {
        return new $this->requestClass();
    }
}