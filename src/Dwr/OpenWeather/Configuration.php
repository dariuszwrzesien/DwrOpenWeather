<?php
namespace Dwr\OpenWeather;

class Configuration
{
    const DEFAULT_BASE_URI = 'http://api.openweathermap.org';
    const DEFAULT_VERSION = '/data/2.5';
    const DEFAULT_TIMEOUT = '3.0';

    /**
     * @var string
     */
    private $baseUri;

    /**
     * @var string
     */
    private $version;

    /**
     * @var string
     */
    private $timeout;

    /**
     * @var string
     */
    private $apiKey;

    /**
     * Configuration constructor.
     * @param string $apiKey
     */
    public function __construct($apiKey)
    {
        $this->baseUri = self::DEFAULT_BASE_URI;
        $this->version = self::DEFAULT_VERSION;
        $this->timeout = self::DEFAULT_TIMEOUT;
        $this->apiKey = $apiKey;
    }

    /**
     * @return string
     */
    public function baseUri()
    {
        return $this->baseUri;
    }

    /**
     * @param string $baseUri
     */
    public function setBaseUri($baseUri)
    {
        $this->baseUri = $baseUri;
    }

    /**
     * @return string
     */
    public function version()
    {
        return $this->version;
    }

    /**
     * @param string $version
     */
    public function setVersion($version)
    {
        $this->version = $version;
    }

    /**
     * @return string
     */
    public function timeout()
    {
        return $this->timeout;
    }

    /**
     * @param string $timeout
     */
    public function setTimeout($timeout)
    {
        $this->timeout = $timeout;
    }

    /**
     * @return string
     */
    public function apiKey()
    {
        return $this->apiKey;
    }
}
