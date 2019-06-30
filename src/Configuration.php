<?php

namespace OmekaClassic;


class Configuration implements ConfigurationInterface
{
    /**
     * @var string
     */
    protected $key;

    /**
     * @var string
     */
    protected $endpoint;

    /**
     * Configuration constructor.
     * @param string|null $endpoint
     * @param string|null $key
     */
    public function __construct(string $endpoint = null, string $key = null)
    {
        $this->endpoint = $endpoint;
        $this->key = $key;
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param string $key
     */
    public function setKey($key): void
    {
        $this->key = $key;
    }

    /**
     * @return string
     */
    public function getEndpoint()
    {
        return $this->endpoint;
    }

    /**
     * @param string $endpoint
     */
    public function setEndpoint($endpoint): void
    {
        $this->endpoint = $endpoint;
    }
}
