<?php

namespace OmekaClassicTest\Transport;


use OmekaClassic\Configuration;
use OmekaClassic\Transport\Transport;
use PHPUnit\Framework\TestCase;

class TransportTest extends TestCase
{
    public function dataProviderForBuildUrl()
    {
        return [
            [
                'endpoint' => [
                    'endpoint' => 'http://omeka/api/',
                    'key' => '6657c922c21ac18ee3501f787ad41a1f1d22920a',
                    'resourceName' => 'item'
                ],
                'parameters' => [],
                'id' => null,
                'url' => 'http://omeka/api/item?key=6657c922c21ac18ee3501f787ad41a1f1d22920a'
            ],
            [
                'endpoint' => [
                    'endpoint' => 'http://omeka/api/',
                    'key' => '6657c922c21ac18ee3501f787ad41a1f1d22920a',
                    'resourceName' => 'item'
                ],
                'parameters' => [
                    'public' => true,
                    'featured' => true
                ],
                'id' => null,
                'url' => 'http://omeka/api/item?public=1&featured=1&key=6657c922c21ac18ee3501f787ad41a1f1d22920a'
            ],
            [
                'endpoint' => [
                    'endpoint' => 'http://omeka/api/',
                    'key' => '6657c922c21ac18ee3501f787ad41a1f1d22920a',
                    'resourceName' => 'item'
                ],
                'parameters' => [
                    'public' => true,
                    'featured' => true
                ],
                'id' => 12,
                'url' => 'http://omeka/api/item/12?public=1&featured=1&key=6657c922c21ac18ee3501f787ad41a1f1d22920a'
            ]
        ];
    }

    /**
     * @dataProvider dataProviderForBuildUrl
     */
    public function testBuildUrl($endpoint, $parameters, $id, $url)
    {
        $configuration = new Configuration();
        $configuration->setEndpoint($endpoint['endpoint']);
        $configuration->setKey($endpoint['key']);

        $transport = new T($configuration);
        $transport->setResourceName($endpoint['resourceName']);
        $transport->setParameters($parameters);

        $this->assertEquals($url, $transport->buildUrl($id));
    }
}

class T extends Transport
{
    public function buildUrl(int $id = null)
    {
        return parent::buildUrl($id);
    }
}
