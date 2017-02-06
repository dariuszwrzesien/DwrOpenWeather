<?php

namespace Dwr\OpenWeather;

use Dwr\OpenWeather\Mode\ModeInterface;

class OpenWeather
{
    const API_URL = 'api.openweathermap.org/data';
    const API_VERSION = '2.5';

    /**
     * Generated ApiKey by https://openweathermap.org
     * @var string
     */
    private $apiKey;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * @param ModeInterface $mode
     * @return ModeInterface
     */
    public function get(ModeInterface $mode)
    {
        $mode->setBase
        return $mode;
    }

    private function getBaseUrl()
    {
        return 'http://' . self::API_URL . '/' . self::API_VERSION . '/';
    }


}
