<?php
namespace Dwr\OpenWeather\Service;

interface OpenWeatherInterface
{
    const BASE_URI = 'http://api.openweathermap.org';
    const TIMEOUT = '3.0';

    public function getByCityName($cityName);
    public function getByCityId($cityId);
    public function getByGeographicCoordinates($lat, $lon);

}
