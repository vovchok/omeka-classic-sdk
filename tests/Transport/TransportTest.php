<?php

namespace OmekaClassicTest\Transport;


use OmekaClassic\Configuration;
use OmekaClassic\Representation\ItemType;
use OmekaClassic\Representation\Tag;
use OmekaClassic\Representation\Collection;
use OmekaClassic\Representation\Item;
use OmekaClassic\Repository\ItemType as ItemTypeRepository;
use OmekaClassic\Transport\Transport;
use PHPUnit\Framework\TestCase;
use Symfony\Contracts\HttpClient\ResponseInterface;

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

    public function testEndpointName()
    {
        $configuration = new Configuration(
            'http://omeka/api/',
            '6657c922c21ac18ee3501f787ad41a1f1d22920a'
        );

        $transport = new T($configuration);

        // get
        $representation = new Item();

        $transport->get($representation);

        $this->assertEquals($representation->getEndpointName(), $transport->getResourceName());

        // update
        $representation = new Tag();

        $transport->update($representation);

        $this->assertEquals($representation->getEndpointName(), $transport->getResourceName());

        // create
        $representation = new ItemType();

        $transport->create($representation);

        $this->assertEquals($representation->getEndpointName(), $transport->getResourceName());

        // delete
        $representation = new Collection();

        $transport->delete($representation);

        $this->assertEquals($representation->getEndpointName(), $transport->getResourceName());

        // find
        $repository = new ItemTypeRepository();

        $transport->find($repository);

        $this->assertEquals($repository->getEndpointName(), $transport->getResourceName());
    }
}

class T extends Transport
{
    public function buildUrl(int $id = null)
    {
        return parent::buildUrl($id);
    }

    public function getResourceName()
    {
        return parent::getResourceName();
    }

    protected function request(string $method, string $url, array $options = [])
    {
        return new Response();
    }
}

class Response implements ResponseInterface
{
    public function getStatusCode(): int
    {
        return 204;
    }

    public function getHeaders(bool $throw = true): array
    {
        return [
            'omeka-total-results' => 20,
        ];
    }

    public function getContent(bool $throw = true): string
    {
        return "";
    }

    public function toArray(bool $throw = true): array
    {
        return [];
    }

    public function cancel(): void
    {
        // TODO: Implement cancel() method.
    }

    public function getInfo(string $type = null)
    {
        // TODO: Implement getInfo() method.
    }
}
