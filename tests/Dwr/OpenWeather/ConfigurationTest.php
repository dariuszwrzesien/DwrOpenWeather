<?php
namespace Dwr\OpenWeather;

use GuzzleHttp\Client;

class ConfigurationTest extends \PHPUnit_Framework_TestCase
{
    public function testIfConfigurationInitializeWithDefaultProperties()
    {
        $apiKey = '123';
        $config = new Configuration($apiKey);

        $this->assertEquals($config->apiKey(), $apiKey);
        $this->assertEquals($config->baseUri(), Configuration::DEFAULT_BASE_URI);
        $this->assertEquals($config->version(), Configuration::DEFAULT_VERSION);
        $this->assertEquals($config->timeout(), Configuration::DEFAULT_TIMEOUT);
        $this->assertInstanceOf('GuzzleHttp\\Client', $config->getHttpClient());
    }

    public function testConfigurationClient()
    {
        $apiKey = '123';
        $config = new Configuration($apiKey);
        $config->setHttpClient($this->httpClientMock());

        $this->assertInstanceOf('\\PHPUnit_Framework_MockObject_MockObject', $config->getHttpClient());

        $apiKey = '123';
        $config = new Configuration($apiKey);
        $this->assertInstanceOf('GuzzleHttp\\Client', $config->getHttpClient());
    }

    /**
     * Guzzle Client Mock
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function httpClientMock()
    {
        $httpClientMock = $this->getMockBuilder(Client::class)
            ->disableOriginalConstructor()
            ->getMock();

        return $httpClientMock;
    }
}
