<?php

namespace OmekaClassic\Transport;


use OmekaClassic\ConfigurationInterface;
use OmekaClassic\Repository\RepositoryInterface;
use OmekaClassic\Representation\RepresentationInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpClient\HttpClient;

class Transport implements TransportInterface
{
    /**
     * @var ConfigurationInterface
     */
    protected $configuration;

    /**
     * @var string
     */
    protected $resourceName;

    /**
     * @var HttpClientInterface
     */
    protected $client;

    /**
     * @var array
     */
    protected $parameters = [];

    /**
     * @var int
     */
    protected $total = 0;

    /**
     * Transport constructor.
     * @param ConfigurationInterface|null $configuration
     * @param HttpClientInterface|null $client
     */
    public function __construct(ConfigurationInterface $configuration = null, HttpClientInterface $client = null)
    {
        $this->client = $client ?? HttpClient::create(["headers" => [
            "Content-Type" => "application/json; charset=utf-8",
        ]]);

        $this->configuration = $configuration;
    }

    /**
     * @param RepresentationInterface $representation
     * @return array
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function get(RepresentationInterface $representation)
    {
        $response = $this->request('GET', $this->buildUrl($representation['id']));

        return $response->toArray();
    }

    /**
     * @param RepositoryInterface $repository
     * @return array
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function find(RepositoryInterface $repository)
    {
        $this->setResourceName($repository->getEndpointName());

        $response = $this->request('GET', $this->buildUrl());

        $this->setTotal((int) $response->getHeaders()['omeka-total-results']);

        return $response->toArray();
    }

    /**
     * @param RepresentationInterface $representation
     * @return array
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function create(RepresentationInterface $representation)
    {
        $this->setResourceName($representation->getEndpointName());

        $response = $this->request('POST', $this->buildUrl(), ['json' => $representation]);

        return $response->toArray();
    }

    /**
     * @param RepresentationInterface $representation
     * @return array
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function update(RepresentationInterface $representation)
    {
        $this->setResourceName($representation->getEndpointName());

        $response = $this->request('PUT', $this->buildUrl($representation['id']), ['json' => $representation]);

        return $response->toArray();
    }

    /**
     * @param RepresentationInterface $representation
     * @return bool
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function delete(RepresentationInterface $representation)
    {
        $this->setResourceName($representation->getEndpointName());

        $response = $this->request('DELETE', $this->buildUrl($representation['id']));

        return $response->getStatusCode() == 204;
    }

    /**
     * @param string $method
     * @param string $url
     * @param array $options
     * @return \Symfony\Contracts\HttpClient\ResponseInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    protected function request(string $method, string $url, array $options = [])
    {
        // reset parameters
        $this->setParameters();

        return $this->client->request($method, $url, $options);
    }

    /**
     * @param string $resourceName
     */
    public function setResourceName($resourceName)
    {
        $this->resourceName = $resourceName;
    }

    /**
     * @param array $parameters
     */
    public function setParameters(array $parameters = [])
    {
        $this->parameters = $parameters;
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @param $key
     * @param $value
     */
    protected function setParameter($key, $value)
    {
        if ($value === null) return;

        $this->parameters[$key] = $value;
    }

    /**
     * @param $key
     */
    protected function removeParameter($key)
    {
        unset($this->parameters[$key]);
    }

    /**
     * @param $key
     * @return mixed
     */
    protected function getParameter($key)
    {
        return $this->parameters[$key];
    }

    /**
     * @return int
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param int $total
     */
    protected function setTotal(int $total)
    {
        $this->total = $total;
    }

    /**
     * @return string
     */
    protected function getResourceName()
    {
        return $this->resourceName;
    }

    /**
     * @param int|null $id
     * @return string
     */
    protected function buildUrl(int $id = null)
    {
        $url = str_replace(['{endpoint}', '{resource}', '{id}'], [
            $this->configuration->getEndpoint(),
            $this->getResourceName(),
            is_integer($id) ? "/$id" : ""
        ], "{endpoint}{resource}{id}");

        $this->setParameter('key', $this->configuration->getKey());

        $parameters = http_build_query($this->getParameters());

        return (empty($parameters)) ? $url : "$url?$parameters";
    }
}
