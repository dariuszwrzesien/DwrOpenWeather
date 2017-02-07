<?php
namespace Dwr\OpenWeather;

interface OpenWeatherInterface
{
    public function getByCityName($cityName);
    public function getByCityId($cityId);
    public function getByGeographicCoordinates($lat, $lon);
}
