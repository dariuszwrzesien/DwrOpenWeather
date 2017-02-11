<?php
namespace Dwr\OpenWeather;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class OpenWeatherTest extends \PHPUnit_Framework_TestCase
{
    public function testIfWeatherIsSupportedType()
    {
        $actual = 'Weather';
        $config = new Configuration('123');
        $openWeather = new OpenWeather($actual, $config);

        $this->assertTrue(in_array($actual, $openWeather->getSupportedType()));
        $this->assertInstanceOf('Dwr\\OpenWeather\\OpenWeather', $openWeather);
    }

    public function testIfForecastIsSupportedType()
    {
        $actual = 'Forecast';
        $config = new Configuration('123');
        $openWeather = new OpenWeather($actual, $config);

        $this->assertTrue(in_array($actual, $openWeather->getSupportedType()));
        $this->assertInstanceOf('Dwr\\OpenWeather\\OpenWeather', $openWeather);
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Unknown OpenWeather type. Supported types are: Weather, Forecast
     */
    public function testIfUnSupportedTypeThrowsException()
    {
        $config = new Configuration('123');
        new OpenWeather('Dummy text', $config);
    }

    public function testIfWeatherRequestReturnsWeatherResponse()
    {
        $actual = 'Weather';
        $config = new Configuration('123');
        $config->setHttpClient($this->httpClientMock('{"name":"test"}'));

        $openWeather = new OpenWeather($actual, $config);
        $weather = $openWeather->getByCityId('123');

        $this->assertInstanceOf('Dwr\\OpenWeather\\Response\\ResponseInterface', $weather);
        $this->assertInstanceOf('Dwr\\OpenWeather\\Response\\Weather', $weather);
    }

    public function testIfForecastRequestReturnsForecastResponse()
    {
        $actual = 'Weather';
        $config = new Configuration('123');
        $config->setHttpClient($this->httpClientMock('{"name":"test"}'));

        $openWeather = new OpenWeather($actual, $config);
        $weather = $openWeather->getByCityId('123');

        $this->assertInstanceOf('Dwr\\OpenWeather\\Response\\ResponseInterface', $weather);
        $this->assertInstanceOf('Dwr\\OpenWeather\\Response\\Weather', $weather);
    }

    public function testIfWeatherRequestReturnMappedWeatherResponse()
    {
        $jsonData  = '{
            "id": 1,
            "name": "testCity",
            "coord": {
                "lon": "0.01",
                "lat": "0.02"
            },
            "weather": [
                {
                    "id": 300,
                    "main": "Drizzle",
                    "description": "light intensity drizzle",
                    "icon": "09d"
                }
            ],
            "base": "station",
            "main": {
                "temp": 274.15,
                "pressure": 1024,
                "humidity": 93,
                "temp_min": 273.15,
                "temp_max": 275.15
            },
            "visibility": 1800,
            "wind": {
                "speed": 5.7,
                "deg": 20
            },
            "clouds": {
                "all" : 90
            },
            "dt": 1486714800,
            "sys": {
                "type": 1,
                "id": 5091,
                "message": 0.037,
                "country": "testCountry",
                "sunrise": 1486711368,
                "sunset": 1486746447
            }
        }';


        $actual = 'Weather';
        $config = new Configuration('123');
        $config->setHttpClient($this->httpClientMock($jsonData));

        $openWeather = new OpenWeather($actual, $config);
        $weather = $openWeather->getByCityName('testCity');

        $arrayData = json_decode($jsonData, true);

        $this->assertEquals($weather->cityId(), $arrayData['id']);
        $this->assertEquals($weather->cityName(), $arrayData['name']);
        $this->assertEquals($weather->coord(), $arrayData['coord']);
        $this->assertEquals($weather->weather(), $arrayData['weather']);
        $this->assertEquals($weather->base(), $arrayData['base']);
        $this->assertEquals($weather->main(), $arrayData['main']);
        $this->assertEquals($weather->visibility(), $arrayData['visibility']);
        $this->assertEquals($weather->wind(), $arrayData['wind']);
        $this->assertEquals($weather->clouds(), $arrayData['clouds']);
        $this->assertEquals($weather->dt(), $arrayData['dt']);
        $this->assertEquals($weather->sys(), $arrayData['sys']);
    }

    public function testIfForecastRequestReturnMappedForecastResponse()
    {
        $jsonData = '{
            "city": {
                "id": 1,
                "name": "testCity",
                "coord": {
                    "lon": 0.01,
                    "lat": 0.02
                },
                "country": "textCountry",
                "population": 0,
                "sys": [
                    {
                        "population": 0
                    }
                ]
            },
            "message": 0.0036,
            "cnt": 36,
            "list": [
                {
                    "dt": 1486728000,
                    "main": {
                        "temp": 275.58,
                        "temp_min": 275.39,
                        "temp_max": 275.58,
                        "pressure": 1031.69,
                        "sea_level": 1039.55,
                        "grnd_level": 1031.69,
                        "humidity": 83,
                        "temp_kf": 0.19
                    },
                    "weather": [
                        {
                            "id": 800,
                            "main": "Clear",
                            "description": "clear sky",
                            "icon": "01d"
                        }
                    ],
                    "clouds": {
                        "all": 76
                    },
                    "wind": {
                        "speed": 5.01,
                        "deg": 32.5026
                    },
                    "rain": [],
                    "snow": {
                        "3h": 0.005
                    },
                    "sys": {
                        "pod": "d"
                    },
                    "dt_txt": "2017-02-10 15:00:00"
                },
                {
                    "dt": 1486728001,
                    "main": {
                        "temp": 276.58,
                        "temp_min": 276.39,
                        "temp_max": 277.58,
                        "pressure": 1032.69,
                        "sea_level": 1031.55,
                        "grnd_level": 1033.69,
                        "humidity": 84,
                        "temp_kf": 0.11
                    },
                    "weather": [
                        {
                            "id": 600,
                            "main": "Snow",
                            "description": "light snow",
                            "icon": "13n"
                        }
                    ],
                    "clouds": {
                        "all": 88
                    },
                    "wind": {
                        "speed": 3.01,
                        "deg": 3.5026
                    },
                    "rain": [],
                    "snow": {
                        "3h": 0.019
                    },
                    "sys": {
                        "pod": "n"
                    },
                    "dt_txt": "2017-02-11 00:00:00"
                }
            ]
        }';

        $actual = 'Forecast';
        $config = new Configuration('123');
        $config->setHttpClient($this->httpClientMock($jsonData));

        $openWeather = new OpenWeather($actual, $config);
        $weather = $openWeather->getByCityName('testCity');

        $arrayData = json_decode($jsonData, true);

        $this->assertEquals($weather->city(), $arrayData['city']);
        $this->assertEquals($weather->message(), $arrayData['message']);
        $this->assertEquals($weather->cnt(), $arrayData['cnt']);
        $this->assertEquals($weather->lists(), $arrayData['list']);
    }

    /**
     * Guzzle Client Mock
     * @param string $expectedJsonResponseData
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function httpClientMock($expectedJsonResponseData)
    {
        $httpClientMock = $this->getMockBuilder(Client::class)
            ->setMethods(['get'])
            ->disableOriginalConstructor()
            ->getMock();

        $httpClientMock->expects($this->any())
            ->method('get')
            ->will($this->returnValue(
                new Response(
                    200,
                    ['Content-Type' => 'application/json; charset=utf-8'],
                    $expectedJsonResponseData,
                    '1.1'
                )
            ));

        return $httpClientMock;
    }
}
