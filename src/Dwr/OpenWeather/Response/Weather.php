<?php
namespace Dwr\OpenWeather\Response;

class Weather implements ResponseInterface
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var array
     */
    private $coord;

    /**
     * @var array
     */
    private $weather;

    /**
     * @var string
     */
    private $base;

    /**
     * @var array
     */
    private $main;

    /**
     * @var int
     */
    private $visibility;

    /**
     * @var array
     */
    private $wind;

    /**
     * @var array
     */
    private $clouds;

    /**
     * @var int
     */
    private $dataTime;

    /**
     * @var array
     */
    private $sys;

    /**
     * Weather constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
               $this->$key = $value;
            }
        }
    }

    /**
     * @return int
     */
    public function cityId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function cityName()
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function coord()
    {
        return $this->coord;
    }

    /**
     * @return array
     */
    public function weather()
    {
        return $this->weather;
    }

    /**
     * @return string
     */
    public function base()
    {
        return $this->base;
    }

    /**
     * @return array
     */
    public function main()
    {
        return $this->main;
    }

    /**
     * @return int
     */
    public function visibility()
    {
        return $this->visibility;
    }

    /**
     * @return array
     */
    public function wind()
    {
        return $this->wind;
    }

    /**
     * @return array
     */
    public function clouds()
    {
        return $this->clouds;
    }

    /**
     * @return int
     */
    public function dataTime()
    {
        return $this->dataTime;
    }

    /**
     * @return array
     */
    public function sys()
    {
        return $this->sys;
    }
}
