<?php

namespace OmekaClassicTest\Representation;


use OmekaClassic\Representation\Element;
use OmekaClassic\Representation\ElementSet;
use OmekaClassic\Representation\ItemType;
use OmekaClassicTest\TestCase;

class ItemTypeTest extends TestCase
{
    public function testCreate()
    {
        $itemType = new ItemType(static::$transport);
        $itemType->setName("ItemType Name 1");
        $itemType->setDescription("ItemType Description 1");
        $itemType->create();

        $this->assertTrue(is_int($itemType->getId()));

        $itemType->delete();
    }

    public function dataForCreateWithElements()
    {
        return [
            [[
                [
                    "name" => "Element Name 10",
                    "description" => "Element Description 10",
                    "order" => 1,
                    "comment" => "Comment 1",
                ],
                [
                    "name" => "Element Name 20",
                    "description" => "Element Description 20",
                    "order" => 2,
                    "comment" => "Comment 2",
                ],
            ]]
        ];
    }

    /**
     * @dataProvider dataForCreateWithElements
     */
    public function testCreateWithElements($elements)
    {
        $placeholder = new ItemType(static::$transport);
        $placeholder->setName("ItemType Name 1");
        $placeholder->setDescription("ItemType Description 1");

        $ids = [];

        $elementSet = new ElementSet(static::$transport);
        $elementSet->setName("Element Set Name 1");
        $elementSet->setDescription("Element Set Description 1");
        $elementSet->create();

        foreach ($elements as $element) {
            $el = new Element(static::$transport);
            $el->setName($element['name']);
            $el->setDescription($element['description']);
            $el->setOrder($element['order']);
            $el->setComment($element['comment']);
            $el->setElementSet($elementSet->getId());
            $el->create();

            $ids[$el->getId()] = $el;

            $placeholder->addElement($el->getId());
        }

        $placeholder->create();

        $itemType = new ItemType(static::$transport);
        $itemType->get($placeholder->getId());

        $els = $itemType->getElements();

        foreach ($els as $el) {

            $element = new Element(static::$transport);
            $element->get($el['id']);

            $this->assertEquals($ids[$el['id']]->getName(), $element->getName());

            $element->delete();
        }

        $itemType->delete();

        $elementSet->delete();
    }

    public function testGet()
    {
        $placeholder = new ItemType(static::$transport);
        $placeholder->setName("ItemType Name 1");
        $placeholder->setDescription("ItemType Description 1");
        $placeholder->create();

        $itemType = new ItemType(static::$transport);
        $itemType->get($placeholder->getId());

        $this->assertEquals("ItemType Name 1", $itemType->getName());

        $itemType->delete();
    }

    public function testUpdate()
    {
        $placeholder = new ItemType(static::$transport);
        $placeholder->setName("ItemType Name 1");
        $placeholder->setDescription("ItemType Description 1");
        $placeholder->create();

        $placeholder->setName("ItemType Name 2");
        $placeholder->update();

        $itemType = new ItemType(static::$transport);
        $itemType->get($placeholder->getId());

        $this->assertEquals("ItemType Name 2", $itemType->getName());

        $itemType->delete();
    }

    public function testDelete()
    {
        $placeholder = new ItemType(static::$transport);
        $placeholder->setName("ItemType Name 1");
        $placeholder->setDescription("ItemType Description 1");
        $placeholder->create();

        $itemType = new ItemType(static::$transport);
        $itemType->get($placeholder->getId());

        $this->assertTrue($itemType->delete());
    }
}
