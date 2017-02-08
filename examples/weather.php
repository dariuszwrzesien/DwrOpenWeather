<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/../vendor/autoload.php';

use Dwr\OpenWeather\Configuration;
use Dwr\OpenWeather\OpenWeather;

$openWeatherConfig = new Configuration('94c5d99609ec9ed7ce27d4fdef1ed11d');

$openWeather = new OpenWeather('Weather', $openWeatherConfig);
$cityWeather = $openWeather->getByCityName('London');

//$forecast = new OpenWeather($config, Forecast::class);
//$cityForecast = $forecast->getByGeographicCoordinates(35, 139);

var_dump($cityWeather);
//var_dump($cityForecast);
