<?php

namespace OmekaClassicTest\Repository;


use OmekaClassic\Repository\Item as ItemRepository;
use OmekaClassic\Representation\Item;
use OmekaClassicTest\TestCase;

class ItemTest extends TestCase
{
    public function dataProvider()
    {
        return [[
            [
                "Item 10",
                "Item 20",
                "Item 30",
                "Item 40",
                "Item 50",
            ]
        ]];
    }

    /**
     * @dataProvider dataProvider
     */
    public function testGet($items)
    {
        foreach ($items as $item) {
            $i = new Item(static::$transport);
            $i->setPublic(true);
            $i->setFeatured(true);
            $i->addElementText($item, 50);
            $i->create();
        }

        $repository = new ItemRepository(static::$transport);

        $is = $repository->where(['public' => true, 'featured' => true])->find();

        foreach ($is as $item) {
            /** @var Item $item */

            $this->assertTrue(in_array($item->getElementTexts('Title'), $items));

            $this->assertTrue($item->delete());
        }
    }
}
