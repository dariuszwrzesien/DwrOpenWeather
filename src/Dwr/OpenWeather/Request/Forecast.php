<?php
namespace Dwr\OpenWeather\Request;

class Forecast implements RequestInterface
{
    const URI = '/forecast';

    public function getUri()
    {
        return self::URI;
    }
}
