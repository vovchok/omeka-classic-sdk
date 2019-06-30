<?php

namespace OmekaClassicTest\Representation;


use OmekaClassic\Representation\Item;
use OmekaClassicTest\TestCase;

class ItemTest extends TestCase
{
    public function testCreate()
    {
        $item = new Item(static::$transport);
        $item->setFeatured(true);
        $item->create();

        $this->assertTrue(is_int($item->getId()));

        $item->delete();
    }

    public function testGet()
    {
        $placeholder = new Item(static::$transport);
        $placeholder->setFeatured(true);
        $placeholder->create();

        $item = new Item(static::$transport);
        $item->get($placeholder->getId());

        $this->assertTrue($item->isFeatured());

        $item->delete();
    }

    public function testUpdate()
    {
        $placeholder = new Item(static::$transport);
        $placeholder->setFeatured(true);
        $placeholder->create();

        $item = new Item(static::$transport);
        $item->get($placeholder->getId());
        $item->setFeatured(false);
        $item->update();

        $this->assertTrue(!$item->isFeatured());

        $item->delete();
    }

    public function testDelete()
    {
        $placeholder = new Item(static::$transport);
        $placeholder->setFeatured(true);
        $placeholder->create();

        $item = new Item(static::$transport);
        $item->get($placeholder->getId());

        $this->assertTrue($item->delete());
    }
}
