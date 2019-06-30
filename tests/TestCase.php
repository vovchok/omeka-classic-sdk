<?php

namespace OmekaClassicTest;


use OmekaClassic\Configuration;
use OmekaClassic\Transport\Transport;

class TestCase extends \PHPUnit\Framework\TestCase
{
    /**
     * @var Transport
     */
    protected static $transport;

    public static function setUpBeforeClass(): void
    {
        $configuration = new Configuration();
        $configuration->setEndpoint(getenv("OMEKA_API_ENDPOINT"));
        $configuration->setKey(getenv("OMEKA_API_KEY"));

        static::$transport = new Transport($configuration);
    }

    public static function tearDownAfterClass(): void
    {
        static::$transport = null;
    }
}
