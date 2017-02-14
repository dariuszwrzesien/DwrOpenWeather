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

$openForecast = new OpenWeather('Forecast', $openWeatherConfig);

$city1 = 'Warsaw';
$forecastCity1 = $openForecast->getByCityName($city1);
$forecastCity1Labels = json_encode(array_map(function ($value) {
    return Converter::intToDate($value['dt'], 'd-m-Y H:i');
}, $forecastCity1->lists()));
$forecastCity1Temps = json_encode(array_map(function ($value) {
    return Converter::kelvinToCelsius($value['main']['temp']);
}, $forecastCity1->lists()));

$city2 = 'Berlin';
$forecastCity2 = $openForecast->getByCityName($city2);
$forecastCity2Labels = json_encode(array_map(function ($value) {
    return Converter::intToDate($value['dt'], 'd-m-Y H:i');
}, $forecastCity2->lists()));
$forecastCity2Temps = json_encode(array_map(function ($value) {
    return Converter::kelvinToCelsius($value['main']['temp']);
}, $forecastCity2->lists()));

$city3 = 'Moscow';
$forecastCity3 = $openForecast->getByCityName($city3);
$forecastCity3Labels = json_encode(array_map(function ($value) {
    return Converter::intToDate($value['dt'], 'd-m-Y H:i');
}, $forecastCity3->lists()));
$forecastCity3Temps = json_encode(array_map(function ($value) {
    return Converter::kelvinToCelsius($value['main']['temp']);
}, $forecastCity3->lists()));
?>

<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>DwrOpenWeather</title>
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link rel="stylesheet" href="css/chartist.min.css">
    <link rel="stylesheet" href="css/forecast-chart.css?v=1.0">

    <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
    <![endif]-->
</head>
<body>
<section class="ow-container">
    <div class="title bold">
        <div class="city1"></div><div class="city-name"><?php echo $forecastCity1->cityName(); ?></div>
        <div class="city2"></div><div class="city-name"><?php echo $forecastCity2->cityName(); ?></div>
        <div class="city3"></div><div class="city-name"><?php echo $forecastCity3->cityName(); ?></div>
    </div>
    <div id="js-forecast-chart" class="ow-forecast-chart"
         data-city1-labels="<?php echo htmlspecialchars($forecastCity1Labels) ?>"
         data-city1-temps="<?php echo htmlspecialchars($forecastCity1Temps) ?>"
         data-city2-labels="<?php echo htmlspecialchars($forecastCity2Labels) ?>"
         data-city2-temps="<?php echo htmlspecialchars($forecastCity2Temps) ?>"
         data-city3-labels="<?php echo htmlspecialchars($forecastCity3Labels) ?>"
         data-city3-temps="<?php echo htmlspecialchars($forecastCity3Temps) ?>">
    </div>
</section>
<script type="text/javascript" src="js/chartist.min.js"></script>
<script type="text/javascript">
    var data = {
        labels: JSON.parse(document.getElementById('js-forecast-chart').getAttribute('data-city1-labels')),
        series: [
            JSON.parse(document.getElementById('js-forecast-chart').getAttribute('data-city1-temps')),
            JSON.parse(document.getElementById('js-forecast-chart').getAttribute('data-city2-temps')),
            JSON.parse(document.getElementById('js-forecast-chart').getAttribute('data-city3-temps'))
        ]
    };
    var options = {
        width: 960,
        height: 600,
        chartPadding: {
            bottom: 100
        }
    };

    new Chartist.Line('.ow-forecast-chart', data, options);
</script>
</body>
</html>
