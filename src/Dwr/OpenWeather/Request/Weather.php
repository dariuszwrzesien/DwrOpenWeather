<?php
namespace Dwr\OpenWeather\Request;

class Weather implements RequestInterface
{
    const URI = '/weather';

    /**
     * @return string
     */
    public function getUri()
    {
        return self::URI;
    }
}
