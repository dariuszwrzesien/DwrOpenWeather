<?php

namespace Dwr\OpenWeather\Mode;

interface ModeInterface
{

    public function byCityName($cityName);

    public function byCityId($cityId);

    public function byGeographicCoordinates($lat, $lon);

    public function byZipCode($zipCode);
}