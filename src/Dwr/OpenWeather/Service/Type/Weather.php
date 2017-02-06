<?php
namespace Dwr\OpenWeather\Service\Type;

class Weather implements TypeInterface
{
    private static $uri = '/data/2.5/weather';

    public static function getUri()
    {
        return self::$uri;
    }

}