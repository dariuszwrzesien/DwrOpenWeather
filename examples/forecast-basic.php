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

$city = 'Los Angeles';
$openForecast = new OpenWeather('Forecast', $openWeatherConfig);
$forecastCity = $openForecast->getByCityName($city);
$forecast = array_map(function ($value) {
    return [
        'timestamp' => Converter::intToDate($value['dt'], 'd-m-Y H:i'),
        'temp' => Converter::kelvinToCelsius($value['main']['temp']),
        'pressure' => $value['main']['pressure'],
        'humidity' => $value['main']['humidity'],
        'description' => ($value['weather'][0]['description'])?$value['weather'][0]['description']:'',
        'icon' => ($value['weather'][0]['icon'])?$value['weather'][0]['icon']:'',
    ];
}, $forecastCity->lists());
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
    <div class="ow-forecast">
        <header>
            <div class="title"><span class="bold"><?php echo $forecastCity->cityName() ?></span>, <span class="bold"><?php echo $forecastCity->country() ?></span></div>
        </header>
        <table>
            <tbody>
            <?php foreach ($forecast as $weather) : ?>
                <tr>
                    <td><span class="small-font"><?php echo $weather['timestamp'] ?></span></td>
                    <td><img class="icon" src="http://openweathermap.org/img/w/<?php echo $weather['icon'] ?>.png"></td>
                    <td><span class="green-highlighted"><?php echo $weather['temp'] .'&nbsp;&deg;C'?></span></td>
                    <td><span class="bold small-font"><?php echo $weather['description'] ?></span></td>
                    <td><span class="italic small-font">pressure:&nbsp;</span><span class="bold small-font"><?php echo $weather['pressure'] .'&nbsp;hPa' ?></span></td>
                    <td><span class="italic small-font">humidity:&nbsp;</span><span class="bold small-font"><?php echo $weather['humidity'] .'&nbsp;%'; ?></span></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
</body>
</html>
