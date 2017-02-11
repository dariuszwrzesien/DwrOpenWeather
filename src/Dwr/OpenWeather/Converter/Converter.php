<?php

namespace Dwr\OpenWeather\Converter;

class Converter
{
    public static function kelvinToCelsius($temp)
    {
        return (int)$temp - 273.15;
    }

    public static function celsiusToKelvin($temp)
    {
        return (int)$temp + 273.15;
    }
}