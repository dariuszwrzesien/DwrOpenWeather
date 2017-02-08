<?php
namespace Dwr\OpenWeather\Response;

class Forecast implements ResponseInterface
{
    /**
     * @var array
     */
    private $city;

    /**
     * @var string
     */
    private $message;

    /**
     * @var int
     */
    private $cnt;

    /**
     * @var array
     */
    private $list;

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
     * @return array
     */
    public function city()
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function message()
    {
        return $this->message;
    }

    /**
     * @return int
     */
    public function cnt()
    {
        return $this->cnt;
    }

    /**
     * @return array
     */
    public function lists()
    {
        return $this->list;
    }
}
