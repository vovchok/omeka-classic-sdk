<?php

namespace OmekaClassicTest\Representation;


use OmekaClassic\Exception\LogicException;
use OmekaClassic\Representation\Item;
use OmekaClassic\Representation\Tag;
use OmekaClassicTest\TestCase;

class TagTest extends TestCase
{
    public function testGet()
    {
        $item = new Item(static::$transport);
        $item->addTag("Tag 1");
        $item->create();

        $this->assertCount(1, $item->getTags());

        $item->delete();
    }

    public function testCreate()
    {
        $this->expectException(LogicException::class);

        $user = new Tag(static::$transport);
        $user->create();
    }

    public function testUpdate()
    {
        $this->expectException(LogicException::class);

        $user = new Tag(static::$transport);
        $user->update();
    }

    public function testDelete()
    {
        $this->expectException(LogicException::class);

        $user = new Tag(static::$transport);
        $user->delete();
    }
}
