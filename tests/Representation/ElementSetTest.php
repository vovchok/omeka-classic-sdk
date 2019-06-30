<?php

namespace OmekaClassicTest\Representation;


use OmekaClassic\Representation\ElementSet;
use OmekaClassicTest\TestCase;

class ElementSetTest extends TestCase
{
    public function testCreate()
    {
        $elementSet = new ElementSet(static::$transport);
        $elementSet->setName("ElementSet Name 1");
        $elementSet->create();

        $this->assertTrue(is_int($elementSet->getId()));

        $elementSet->delete();
    }

    public function testGet()
    {
        $placeholder = new ElementSet(static::$transport);
        $placeholder->setName("ElementSet Name 1");
        $placeholder->create();

        $elementSet = new ElementSet(static::$transport);
        $elementSet->get($placeholder->getId());

        $this->assertEquals("ElementSet Name 1", $elementSet->getName());

        $elementSet->delete();
    }

    public function testDelete()
    {
        $placeholder = new ElementSet(static::$transport);
        $placeholder->setName("ElementSet Name 1");
        $placeholder->create();

        $elementSet = new ElementSet(static::$transport);
        $elementSet->get($placeholder->getId());

        $this->assertTrue($elementSet->delete());
    }
}
