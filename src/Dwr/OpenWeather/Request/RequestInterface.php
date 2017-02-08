<?php
namespace Dwr\OpenWeather\Request;

interface RequestInterface
{
    /**
     * Returns request URI.
     * @return string
     */
    public function getUri();

}