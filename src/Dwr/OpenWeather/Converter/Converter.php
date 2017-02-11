<?php

namespace Dwr\OpenWeather\Converter;

class Converter
{
    public static function kelvinToCelsius($temp)
    {
        return (float) $temp - 273.15;
    }

    public static function celsiusToKelvin($temp)
    {
        return (float) $temp + 273.15;
    }

    public static function kelvinToFahrenheit($temp)
    {
        return (float) $temp * 9/5 - 459.67;
    }

    public static function fahrenheitToKelvin($temp)
    {
        return ((float) $temp + 459.67) * 5/9;
    }

    public static function intToDate($int, $format = null)
    {
        if ($format) {
            return date($format, $int);
        }

        return date("Y-m-d H:i:s", $int);
    }
}