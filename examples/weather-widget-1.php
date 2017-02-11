<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/../vendor/autoload.php';

use Dwr\OpenWeather\Configuration;
use Dwr\OpenWeather\OpenWeather;
use Dwr\OpenWeather\Converter\Converter;

$apiKey = getenv('OPEN_WEATHER_API_KEY');
$openWeatherConfig = new Configuration($apiKey);

$openWeather = new OpenWeather('Weather', $openWeatherConfig);
$weather = $openWeather->getByCityName('Gliwice');

?>

<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>DwrOpenWeather widget-1</title>
    <link rel="stylesheet" href="css/styles.css?v=1.0">

    <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
    <![endif]-->
</head>
<body>
    <div class="ow-container">
        <div class="ow-icon">
            <img src="http://openweathermap.org/img/w/<?php echo $weather->icon() ?>.png" alt="<?php echo $weather->description() ?>">
        </div>
        <div class="ow-data-table">
            <div class="location">Weather in <?php echo $weather->cityName() ?></div>
            <div class="location">Weather in <?php echo $weather->description() ?></div>
            <div class="temperature">Temperature: <?php echo Converter::kelvinToCelsius($weather->temp()) ?> &deg;C</div>
            <div class="pressure">Pressure: <?php echo $weather->pressure() ?> hPa</div>
            <div class="pressure">Wind: <?php echo $weather->windSpeed() ?> m/s</div>
            <div class="humidity">Humidity: <?php echo $weather->humidity() ?> %</div>
            <div class="sunrise">Sunrise: <?php echo Converter::intToDate($weather->sunrise(), 'H:i:s') ?> </div>
            <div class="sunset">Sunset: <?php echo Converter::intToDate($weather->sunset(), 'H:i:s') ?> </div>
        </div>
        <div></div>
    </div>
</body>
</html>