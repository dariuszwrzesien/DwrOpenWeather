<?php
namespace Dwr\Examples;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../OpenWeather/OpenWeatherInterface.php';
require_once '../OpenWeather/OpenWeather.php';
require_once '../OpenWeather/Request/RequestInterface.php';
require_once '../OpenWeather/Request/Weather.php';
require_once '../OpenWeather/Request/Forecast.php';
require_once '../OpenWeather/Configuration.php';

require __DIR__ . '/../../../vendor/autoload.php';

use Dwr\OpenWeather\Configuration;
use Dwr\OpenWeather\OpenWeather;
use Dwr\OpenWeather\Request\Forecast;
use Dwr\OpenWeather\Request\Weather;

$config = new Configuration('94c5d99609ec9ed7ce27d4fdef1ed11d');

$weather = new OpenWeather($config, Forecast::class);
$cityWeather = $weather->getByCityName('London');

//$forecast = new OpenWeather($config, Forecast::class);
//$cityForecast = $forecast->getByGeographicCoordinates(35, 139);

var_dump($cityWeather);
//var_dump($cityForecast);
