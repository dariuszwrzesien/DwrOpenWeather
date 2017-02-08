<?php
namespace Dwr\OpenWeather\Request;

class Forecast implements RequestInterface
{
    private static $uri = '/forecast';

    public static function getUri()
    {
        return self::$uri;
    }

    public static function toString()
    {
        return 'Forecast';
    }
}
