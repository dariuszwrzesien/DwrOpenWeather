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
$weather = $openWeather->getByCityName('London');

?>

<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>DwrOpenWeather</title>
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link rel="stylesheet" href="css/weather-basic-small.css?v=1.0">

    <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
    <![endif]-->
</head>
<body>
    <section class="ow-container">
        <header>
            <img class="icon"
                 src="http://openweathermap.org/img/w/<?php echo $weather->icon() ?>.png"
                 alt="<?php echo $weather->description() ?>">
        </header>
        <div class="ow-data">
            <div class="row">
                <span class="bold green"><?php echo $weather->cityName() ?> <?php echo $weather->country() ?></span>,
                <span class="bold italic black small-font"><?php echo $weather->description() ?></span>
            </div>
            <div class="row">
                <span class="bold blue-highlighted"><?php echo Converter::kelvinToCelsius($weather->temp()) ?>&deg;C</span>
                <span class="small-font">pressure:&nbsp;</span><span><?php echo $weather->pressure() ?> hPa</span>,
                <span class="small-font">humidity:&nbsp;</span><span><?php echo $weather->humidity() ?> %</span>
            </div>
        </div>
    </section>
</body>
</html>
