<?php

namespace OmekaClassicTest\Repository;


use OmekaClassic\Repository\Collection as CollectionRepository;
use OmekaClassic\Representation\Collection;
use OmekaClassicTest\TestCase;

class CollectionTest extends TestCase
{
    public function dataProvider()
    {
        return [[
            [
                "Collection 10",
                "Collection 20",
                "Collection 30",
                "Collection 40",
                "Collection 50",
            ]
        ]];
    }

    /**
     * @dataProvider dataProvider
     */
    public function testGet($collections)
    {
        foreach ($collections as $collection) {
            $c = new Collection(static::$transport);
            $c->setPublic(true);
            $c->setFeatured(true);
            $c->addElementText($collection, 50);
            $c->create();
        }

        $repository = new CollectionRepository(static::$transport);

        $cols = $repository->where(['public' => true, 'featured' => true])->find();

        foreach ($cols as $collection) {
            /** @var Collection $collection */

            $this->assertTrue(in_array($collection->getElementTexts('Title'), $collections));

            $this->assertTrue($collection->delete());
        }
    }
}
