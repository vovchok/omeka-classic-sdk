<?php

namespace OmekaClassicTest\Representation;


use OmekaClassic\Representation\Collection;
use OmekaClassicTest\TestCase;

class CollectionTest extends TestCase
{
    public function testCreate()
    {
        $collection = new Collection(static::$transport);
        $collection->setFeatured(true);
        $collection->create();

        $this->assertTrue(is_int($collection->getId()));
        $this->assertTrue($collection->delete());
    }

    public function testGet()
    {
        $placeholder = new Collection(static::$transport);
        $placeholder->setFeatured(true);
        $placeholder->create();

        $collection = new Collection(static::$transport);
        $collection->get($placeholder->getId());

        $this->assertTrue($collection->isFeatured());
        $this->assertTrue($collection->delete());
    }

    public function testUpdate()
    {
        $placeholder = new Collection(static::$transport);
        $placeholder->setFeatured(true);
        $placeholder->create();

        $collection = new Collection(static::$transport);
        $collection->get($placeholder->getId());
        $collection->setFeatured(false);
        $collection->update();

        $this->assertTrue(!$collection->isFeatured());
        $this->assertTrue($collection->delete());
    }

    public function testDelete()
    {
        $placeholder = new Collection(static::$transport);
        $placeholder->setFeatured(true);
        $placeholder->create();

        $collection = new Collection(static::$transport);
        $collection->get($placeholder->getId());

        $this->assertTrue($collection->delete());
    }
}
