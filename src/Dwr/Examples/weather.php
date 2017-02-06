<?php
namespace Dwr\Examples;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../OpenWeather/Service/OpenWeatherInterface.php';
require_once '../OpenWeather/Service/OpenWeather.php';
require_once '../OpenWeather/Service/Type/TypeInterface.php';
require_once '../OpenWeather/Service/Type/Weather.php';
require_once '../OpenWeather/Service/Type/Weather.php';
require_once '/var/www/DwrOpenWeather/vendor/guzzlehttp/guzzle/src/HandlerStack.php';
require_once '/var/www/DwrOpenWeather/vendor/guzzlehttp/guzzle/src/ClientInterface.php';
require_once '/var/www/DwrOpenWeather/vendor/guzzlehttp/guzzle/src/Client.php';

require __DIR__ . '/../../../vendor/autoload.php';

use Dwr\OpenWeather\Service\OpenWeather;
use Dwr\OpenWeather\Service\Type\Weather;

$weather = new OpenWeather(Weather::class);
$cityWeather = $weather->getByCityName('London');


var_dump($cityWeather);
die(__FILE__ . ':'. __LINE__);

