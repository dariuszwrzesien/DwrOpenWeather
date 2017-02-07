<?php
namespace Dwr\OpenWeather\Request;

class Weather implements RequestInterface
{
    private static $uri = '/weather';

    public static function getUri()
    {
        return self::$uri;
    }
}
