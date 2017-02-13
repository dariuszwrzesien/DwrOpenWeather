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
$weather = $openWeather->getByCityName('New York');

?>

<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>DwrOpenWeather widget-1</title>
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link rel="stylesheet" href="css/weather-basic-medium.css?v=1.0">

    <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
    <![endif]-->
</head>
<body>
    <section class="ow-container">
        <header>
            <div class="location bold"><?php echo $weather->cityName() ?></div>
            <div class="data-table">
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
        <table>
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
                <td><?php echo Converter::kelvinToCelsius($weather->temp()) ?> &deg;C</td>
            </tr>
            <tr>
                <td>Pressure:</td>
                <td><?php echo $weather->pressure() ?> hPa</td>
            </tr>
            <tr>
                <td>Wind:</td>
                <td><?php echo $weather->windSpeed() ?> m/s</td>
            </tr>
            <tr>
                <td>Humidity:</td>
                <td><?php echo $weather->humidity() ?> %</td>
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
                <td>Source datetime:</td>
                <td><?php echo Converter::intToDate($weather->dt(), 'd-m-Y (H:i)') ?></td>
            </tr>
            </tbody>
        </table>
    </section>
</body>
</html>
