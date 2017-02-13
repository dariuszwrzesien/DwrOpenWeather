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

$openForecast = new OpenWeather('Forecast', $openWeatherConfig);
$forecastLabels = json_encode(array_map(function ($value) {
    return $value['dt'];
}, $openForecast->getByCityName('Gliwice')->lists()));

$forecastTemps = json_encode(array_map(function ($value) {
    return Converter::kelvinToCelsius($value['main']['temp']);
}, $openForecast->getByCityName('Gliwice')->lists()));

var_dump($forecastLabels);
//die(__FILE__ . ':'. __LINE__);


?>

<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>DwrOpenWeather widget-1</title>
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
                <div class="caption">
                    <div class="location"><span class="bold"><?php echo $weather->cityName() ?></span></div>
                </div>
                <div class="cell">
                    <img class="icon"
                         src="http://openweathermap.org/img/w/<?php echo $weather->icon() ?>.png"
                         alt="<?php echo $weather->description() ?>">
                </div>
                <div class="cell">
                    <div class="temperature"><?php echo Converter::kelvinToCelsius($weather->temp()) ?>&deg;C</div>
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
                </tbody>
            </table>
        </div>
        <div class="ow-forecast">
            <header>
                <div class="title bold">Forecast</div>
            </header>
            <div id="js-chart" class="ow-chart" data-labels="<?php echo $forecastLabels ?>" data-temps="<?php echo $forecastTemps ?>"></div>
        </div>
        <div class="clear-both"></div>
    </section>
    <script type="text/javascript" src="js/chartist.min.js"></script>
    <script type="text/javascript">

//        (function() {
//            console.log(JSON.parse(document.getElementById("js-chart").getAttribute("data-labels")));
//
//        })();



        chart = new Chartist.Line('.ow-chart', {
            labels: JSON.parse(document.getElementById("js-chart").getAttribute("data-labels")),
            series: [
                JSON.parse(document.getElementById("js-chart").getAttribute("data-temps"))
            ]
        }, {
            fullWidth: true,
            fullHeight: true,
            chartPadding: {
                right: 40
            },
            lineSmooth: Chartist.Interpolation.cardinal({
                tension: 1
            })
        });

    </script>
</body>
</html>
