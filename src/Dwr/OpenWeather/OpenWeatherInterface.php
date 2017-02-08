<?php
namespace Dwr\OpenWeather;

use Dwr\OpenWeather\Response\ResponseInterface;

interface OpenWeatherInterface
{
    /**
     * @param $cityName
     * @return ResponseInterface
     */
    public function getByCityName($cityName);

    /**
     * @param $cityId
     * @return ResponseInterface
     */
    public function getByCityId($cityId);

    /**
     * @param $lat
     * @param $lon
     * @return ResponseInterface
     */
    public function getByGeographicCoordinates($lat, $lon);
}
