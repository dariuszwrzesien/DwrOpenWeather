<?php
namespace Dwr\OpenWeather\Request;

class Weather implements RequestInterface
{
    const URI = '/weather';

    public function getUri()
    {
        return self::URI;
    }
}
