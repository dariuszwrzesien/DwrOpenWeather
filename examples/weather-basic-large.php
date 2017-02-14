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

$city = 'Paris';
$openWeather = new OpenWeather('Weather', $openWeatherConfig);
$weather = $openWeather->getByCityName($city);
?>

<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>DwrOpenWeather</title>
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link rel="stylesheet" href="css/chartist.min.css">
    <link rel="stylesheet" href="css/weather-basic-large.css?v=1.0">

    <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
    <![endif]-->
</head>
<body>
    <section class="ow-container">
        <div class="ow-weather">
            <header>
                <div class="location"><span class="bold"><?php echo $weather->cityName() ?></span></div>
                <div>
                    <div class="cell">
                        <img class="icon"
                             src="http://openweathermap.org/img/w/<?php echo $weather->icon() ?>.png"
                             alt="<?php echo $weather->description() ?>">
                    </div>
                    <div class="cell">
                        <span class="temperature"><?php echo Converter::kelvinToCelsius($weather->temp()) ?>&deg;C</span>
                    </div>
                </div>
            </header>
            <div class="tables">
            <table class="left">
                <tbody>
                <tr>
                    <td>Location:</td>
                    <td><span class="bold"><?php echo $weather->cityName() ?></span>, <?php echo $weather->country() ?></td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td><?php echo $weather->description() ?></td>
                </tr>
                <tr>
                    <td>Temperature:</td>
                    <td><span class="blue-highlighted"><?php echo Converter::kelvinToCelsius($weather->temp()) ?> &deg;C</span></td>
                </tr>
                <tr>
                    <td>Temperature Min:</td>
                    <td><?php echo Converter::kelvinToCelsius($weather->tempMin()) ?> &deg;C</td>
                </tr>
                <tr>
                    <td>Temperature Max:</td>
                    <td><?php echo Converter::kelvinToCelsius($weather->tempMax()) ?> &deg;C</td>
                </tr>
                </tbody>
            </table>
            <table class="right">
                <tbody>
                <tr>
                    <td>Pressure:</td>
                    <td><span class="green-highlighted"><?php echo $weather->pressure() ?> hPa</span></td>
                </tr>
                <tr>
                    <td>Wind:</td>
                    <td><?php echo $weather->windSpeed() ?> m/s</td>
                </tr>
                <tr>
                    <td>Humidity:</td>
                    <td><span class="orange-highlighted"><?php echo $weather->humidity() ?> %</span></td>
                </tr>
                <tr>
                    <td>Sunrise:</td>
                    <td><?php echo Converter::intToDate($weather->sunrise(), 'H:i:s') ?></td>
                </tr>
                <tr>
                    <td>Sunset:</td>
                    <td><?php echo Converter::intToDate($weather->sunset(), 'H:i:s') ?></td>
                </tr>
                <tr>
                    <td><span class="xsmall-font">Source datetime:</span></td>
                    <td><span class="xsmall-font bold"><?php echo Converter::intToDate($weather->dt(), 'd-m-Y (H:i)') ?></span></td>
                </tr>
                </tbody>
            </table>
            <div class="clear-both"></div>
            </div>
        </div>
    </section>
</body>
</html>
