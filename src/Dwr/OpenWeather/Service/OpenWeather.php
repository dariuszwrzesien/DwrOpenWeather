<?php
namespace Dwr\OpenWeather\Service;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class OpenWeather implements OpenWeatherInterface
{
    private $client;
    private $serviceType;

    public function __construct($serviceType)
    {
        $this->client = new Client([
            'base_uri' => self::BASE_URI,
            'timeout' => self::TIMEOUT
        ]);
        $this->serviceType = $serviceType;
    }

    public function getByCityName($cityName)
    {
        return $this->request($this->serviceType, [
            'query' => ['q' => $cityName, 'appid' => $this->getApiKey()]
        ]);

    }

    public function getByCityId($cityId)
    {
        // TODO: Implement getByCityId() method.
    }

    public function getByGeographicCoordinates($lat, $lon)
    {
        // TODO: Implement getByGeographicCoordinates() method.
    }

    private function getApiKey()
    {
        return '94c5d99609ec9ed7ce27d4fdef1ed11d';
    }

    private function request($serviceType, array $parameters)
    {
        return $response = $this->client->get($serviceType::getUri(), $parameters);
//        return new Response($response);
    }
}
