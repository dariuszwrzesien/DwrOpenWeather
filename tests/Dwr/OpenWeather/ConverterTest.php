<?php
namespace Dwr\OpenWeather;

use Dwr\OpenWeather\Converter\Converter;

class ConverterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param float $kelvin
     * @param float $celsius
     *
     * @dataProvider kelvinToCelsiusProvider
     */
    public function testConvertKelvinToCelsius($kelvin, $celsius)
    {
        $this->assertEquals($celsius, Converter::kelvinToCelsius($kelvin));
    }

    /**
     * @return array
     */
    public function kelvinToCelsiusProvider()
    {
        return [
            [0, -273.15],
            [273.15, 0],
            [373.15, 100]
        ];
    }

    /**
     * @param float $celsius
     * @param float $kelvin
     *
     * @dataProvider celsiusToKelvinProvider
     */
    public function testConvertCelsiusToKelvin($celsius, $kelvin)
    {
        $this->assertEquals($kelvin, Converter::celsiusToKelvin($celsius));
    }

    /**
     * @return array
     */
    public function celsiusToKelvinProvider()
    {
        return [
            [-273.15, 0],
            [0, 273.15],
            [100, 373.15]
        ];
    }

    /**
     * @param float $kelvin
     * @param float $fahrenheit
     *
     * @dataProvider kelvinToFahrenheitProvider
     */
    public function testConvertKelvinToFahrenheit($kelvin, $fahrenheit)
    {
        $this->assertEquals($fahrenheit, Converter::kelvinToFahrenheit($kelvin));
    }

    /**
     * @return array
     */
    public function kelvinToFahrenheitProvider()
    {
        return [
            [0, -459.67],
            [270, 26.33],
            [255.37, 0]
        ];
    }

    /**
     * @param float $fahrenheit
     * @param float $kelvin
     *
     * @dataProvider fahrenheitToKelvinProvider
     */
    public function testConvertFahrenheitToKelvin($fahrenheit, $kelvin)
    {
        $this->assertEquals($kelvin, Converter::fahrenheitToKelvin($fahrenheit));
    }

    /**
     * @return array
     */
    public function fahrenheitToKelvinProvider()
    {
        return [
            [-459.67, 0],
            [26.33, 270],
            [0, 255.37]
        ];
    }
}
