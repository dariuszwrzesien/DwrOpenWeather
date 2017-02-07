<?php
namespace Dwr\OpenWeather;

use GuzzleHttp\Client;

class OpenWeather implements OpenWeatherInterface
{
    private $config;
    private $client;
    private $requestType;

    public function __construct(Configuration $config, $requestType)
    {
        $this->config = $config;
        $this->requestType = $requestType;
        $this->client = new Client([
            'base_uri' => $config->baseUri(),
            'timeout' => $config->timeout()
        ]);
    }

    public function getByCityName($cityName)
    {
        return $this->request(['query' => ['q' => $cityName]]);
    }

    public function getByCityId($cityId)
    {
        return $this->request(['query' => ['id' => (int)$cityId]]);
    }

    public function getByGeographicCoordinates($lat, $lon)
    {
        return $this->request(['query' => ['lat' => (int)$lat, 'lon' => (int)$lon]]);
    }

    private function request(array $parameters)
    {
        $parameters['query']['appid'] = $this->config->apiKey();
        $response = $this->client->get($this->buildUri($this->requestType), $parameters);

        return json_decode($response->getBody(), true);
    }

    private function buildUri($requestType)
    {
        return $this->config->version() . $requestType::getUri();
    }
}
