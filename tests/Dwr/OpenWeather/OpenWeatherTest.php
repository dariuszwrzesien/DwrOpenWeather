<?php
namespace Dwr\OpenWeather;

class OpenWeatherTest extends \PHPUnit_Framework_TestCase
{
    public function testIfWeatherIsSupportedType()
    {
        $config = new Configuration('123');
        $openWeather = new OpenWeather('Weather', $config);

        $this->assertInstanceOf('Dwr\\OpenWeather\\OpenWeather', $openWeather);
    }

    public function testIfForecastIsSupportedType()
    {
        $config = new Configuration('123');
        $openWeather = new OpenWeather('Forecast', $config);

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
}
