# 

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status](https://travis-ci.org/dariuszwrzesien/DwrOpenWeather.svg?branch=master)](https://travis-ci.org/dariuszwrzesien/DwrOpenWeather)
[![Coverage Status](https://coveralls.io/repos/github/dariuszwrzesien/DwrOpenWeather/badge.svg?branch=master)](https://coveralls.io/github/dariuszwrzesien/DwrOpenWeather?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/dariuszwrzesien/DwrOpenWeather/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/dariuszwrzesien/DwrOpenWeather/?branch=master)
[![Total Downloads][ico-downloads]][link-downloads]

# DwrOpenWeather

DwrOpenWeather is a simply wrapper for [Open Weather API](https://openweathermap.org/).  
In order to start please generate your personal ApiKey first.  
You can do it [here](http://openweathermap.org/appid).  
 
## Installation and usage

When you have ApiKey installation and usage is very easy.

### Step 1: Download DwrOpenWeather using composer

Add DwrOpenWeather in your composer.json:

```json
    {
        "require": {
            "dwr/openweather": "1.0"
        }
    }
```
or download it by running the command:

```bash
    $ php composer.phar update dwr/openweather-bundle
```

### Step 2: Use it in your application

#### GET Weather

```php
    require __DIR__ . '/../vendor/autoload.php';
    
    use Dwr\OpenWeather\Configuration;
    use Dwr\OpenWeather\OpenWeather;
    
    $apiKey = YOURS-API-KEY; //consider keeping api key in environment variable: getenv('OPEN_WEATHER_API_KEY'); 
    $openWeatherConfig = new Configuration($apiKey);
    
    $openWeather = new OpenWeather('Weather', $openWeatherConfig);
    $weather = $openWeather->getByCityName('London');
    
    var_dump($weather);
```

You can get weather from OpenWeather API by using:
* getByCityName('London')
* getByCityId('2643743')  
  List of city ID city.list.json.gz can be downloaded [here](http://bulk.openweathermap.org/sample/)
* getByGeographicCoordinates(-0.12574, 51.50853)

#### GET Forecast

```php
    require __DIR__ . '/../vendor/autoload.php';
    
    use Dwr\OpenWeather\Configuration;
    use Dwr\OpenWeather\OpenWeather;
    
    $apiKey = YOURS-API-KEY; 
   
    //Consider keeping api key in environment variable.
    //$apiKey = getenv('OPEN_WEATHER_API_KEY');
    
    $openWeatherConfig = new Configuration($apiKey);
    
    $openWeather = new OpenWeather('Forecast', $openWeatherConfig);
    $forecast = $openWeather->getByCityName('London');
    
    var_dump($forecast);
```
You can get forecast from OpenWeather API by using:
* getByCityName('London')
* getByCityId('2643743')  
  List of city ID city.list.json.gz can be downloaded [here](http://bulk.openweathermap.org/sample/)
* getByGeographicCoordinates(-0.12574, 51.50853)

## Configuration

You may configure library on your own if you like.
There is several variables which you can set by yourself:
* baseUri, 
* version, 
* timeout, 
* httpClient 
* apiKey;

```php
    require __DIR__ . '/../vendor/autoload.php';
    
    use Dwr\OpenWeather\Configuration;
    use Dwr\OpenWeather\OpenWeather;
    
    $apiKey = YOURS-API-KEY;
    
    //Consider keeping api key in environment variable.
    //$apiKey = getenv('OPEN_WEATHER_API_KEY');
        
    $openWeatherConfig = new Configuration($apiKey);
    
    //CONFIGURATION DwrOpenWeather
    $openWeatherConfig->setBaseUri(NEW-BASE-URI);
    $openWeatherConfig->setVersion(NEW-API-VERSION);
    $openWeatherConfig->setTimeout(NEW-TIMEOUT);
    $openWeatherConfig->setHttpClient(NEW-HTTP-CLIENT); //Has to implement GuzzleHttp\ClientInterface
    $openWeatherConfig->setApiKey(NEW-API-URI);
    
    $openWeather = new OpenWeather('Weather', $openWeatherConfig);
```

## Examples

Take a moment and check examples directory in DwrOpenWeather. Maybe you find there a solution which you like.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v//.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis///master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g//.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g//.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt//.svg?style=flat-square

[link-packagist]: https://packagist.org/packages//
[link-travis]: https://travis-ci.org//
[link-scrutinizer]: https://scrutinizer-ci.com/g///code-structure
[link-code-quality]: https://scrutinizer-ci.com/g//
[link-downloads]: https://packagist.org/packages//
[link-author]: https://github.com/
[link-contributors]: ../../contributors
