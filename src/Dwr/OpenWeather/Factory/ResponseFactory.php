<?php

namespace Dwr\OpenWeather\Factory;

class ResponseFactory
{
    const RESPONSE_NAMESPACE = 'Dwr\\OpenWeather\\Response\\';

    /**
     * @var string
     */
    private $responseClass;

    /**
     * ResponseFactory constructor.
     * @param string $responseType
     */
    public function __construct($responseType)
    {
        $this->responseClass = self::RESPONSE_NAMESPACE . $responseType;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create($data)
    {
        return new $this->responseClass(json_decode($data, true));
    }
}