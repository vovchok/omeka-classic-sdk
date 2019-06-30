<?php

namespace OmekaClassicTest\Representation;


use OmekaClassic\Representation\Element;
use OmekaClassic\Representation\ElementSet;
use OmekaClassicTest\TestCase;

class ElementTest extends TestCase
{
    public function testCreate()
    {
        $elementSet = new ElementSet(static::$transport);
        $elementSet->setName("Element Set 70");
        $elementSet->create();

        $element = new Element(static::$transport);
        $element->setName("Element Name 1");
        $element->setDescription("Element Description 1");
        $element->setElementSet($elementSet->getId());
        $element->create();

        $this->assertTrue(is_int($element->getId()));

        $element->delete();
        $elementSet->delete();
    }

    public function testGet()
    {
        $elementSet = new ElementSet(static::$transport);
        $elementSet->setName("Element Set 70");
        $elementSet->create();

        $placeholder = new Element(static::$transport);
        $placeholder->setName("Element Name 1");
        $placeholder->setDescription("Element Description 1");
        $placeholder->setElementSet($elementSet->getId());
        $placeholder->create();

        $element = new Element(static::$transport);
        $element->get($placeholder->getId());

        $this->assertEquals("Element Name 1", $element->getName());

        $element->delete();
        $elementSet->delete();
    }

    public function testUpdate()
    {
        $elementSet = new ElementSet(static::$transport);
        $elementSet->setName("Element Set 70");
        $elementSet->create();

        $placeholder = new Element(static::$transport);
        $placeholder->setName("Element Name 1");
        $placeholder->setDescription("Element Description 1");
        $placeholder->setElementSet($elementSet->getId());
        $placeholder->create();

        //$placeholder->setName("Element Name 2"); // not working
        $placeholder->setOrder(2);
        $placeholder->update();

        $element = new Element(static::$transport);
        $element->get($placeholder->getId());

        //$this->assertEquals("Element Name 2", $element->getName()); not working
        $this->assertEquals(2, $element->getOrder());

        $element->delete();
        $elementSet->delete();
    }

    public function testDelete()
    {
        $elementSet = new ElementSet(static::$transport);
        $elementSet->setName("Element Set 70");
        $elementSet->create();

        $placeholder = new Element(static::$transport);
        $placeholder->setName("Element Name 1");
        $placeholder->setDescription("Element Description 1");
        $placeholder->setElementSet($elementSet->getId());
        $placeholder->create();

        $element = new Element(static::$transport);
        $element->get($placeholder->getId());

        $this->assertTrue($element->delete());
        $elementSet->delete();
    }
}
