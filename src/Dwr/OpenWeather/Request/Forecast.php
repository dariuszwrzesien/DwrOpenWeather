<?php
namespace Dwr\OpenWeather\Request;

class Forecast implements RequestInterface
{
    const URI = '/forecast';

    /**
     * @return string
     */
    public function getUri()
    {
        return self::URI;
    }
}
