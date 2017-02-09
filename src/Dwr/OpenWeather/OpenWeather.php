<?php
namespace Dwr\OpenWeather;

use Dwr\OpenWeather\Factory\RequestFactory;
use Dwr\OpenWeather\Factory\ResponseFactory;
use Dwr\OpenWeather\Response\ResponseInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class OpenWeather implements OpenWeatherInterface
{
    /**
     * @var Configuration
     */
    private $config;

    /**
     * @var Client
     */
    private $client;

    /**
     * @var string
     */
    private $type;

    /**
     * @var array
     */
    private $supportedType = ['Weather', 'Forecast'];

    /**
     * OpenWeather constructor.
     * @param string $type
     * @param Configuration $config
     */
    public function __construct($type, Configuration $config)
    {
        if ( ! $this->isType($type)) {
            throw new \InvalidArgumentException(
                'Unknown OpenWeather type. Supported types are: ' . implode(', ', $this->supportedType)
            );
        }

        $this->type = $type;
        $this->config = $config;
        $this->client = new Client([
            'base_uri' => $config->baseUri(),
            'timeout' => $config->timeout()
        ]);
    }

    /**
     * @param string $type
     * @return bool
     */
    private function isType($type)
    {
        if (isset($type)
            && ! empty($type)
            && in_array($type, $this->supportedType)
        ) {
            return true;
        }
        return false;
    }

    public function getSupportedType()
    {
        return $this->supportedType;
    }

    /**
     * @param string $cityName
     * @return ResponseInterface
     */
    public function getByCityName($cityName)
    {
        return $this->request(['query' => ['q' => $cityName]]);
    }

    /**
     * @param string $cityId
     * @return ResponseInterface
     */
    public function getByCityId($cityId)
    {
        return $this->request(['query' => ['id' => (int)$cityId]]);
    }

    /**
     * @param int $lat
     * @param int $lon
     * @return ResponseInterface
     */
    public function getByGeographicCoordinates($lat, $lon)
    {
        return $this->request(['query' => ['lat' => (int)$lat, 'lon' => (int)$lon]]);
    }

    /**
     * @param array $parameters
     * @return ResponseInterface
     */
    private function request(array $parameters)
    {
        $parameters['query']['appid'] = $this->config->apiKey();
        $data = $this->client->get($this->buildUri($this->type), $parameters);

        return $this->response($this->type, $data);
    }

    /**
     * @param $requestType
     * @return string
     */
    private function buildUri($requestType)
    {
        $request = new RequestFactory($requestType);
        return $this->config->version() . $request->create()->getUri();
    }

    /**
     * @param $responseType
     * @param Response $data
     * @return ResponseInterface
     */
    private function response($responseType, Response $data)
    {
        $response = new ResponseFactory($responseType);
        return $response->create($data->getBody());
    }
}
