<?php

namespace OmekaClassicTest\Repository;


use OmekaClassic\Repository\Tag as TagRepository;
use OmekaClassic\Repository\Item as ItemRepository;
use OmekaClassic\Representation\Tag;
use OmekaClassic\Representation\Item;
use OmekaClassicTest\TestCase;

class TagTest extends TestCase
{
    public function dataProvider()
    {
        return [[
            [
                "Tag 10",
                "Tag 20",
                "Tag 30",
                "Tag 40",
                "Tag 50",
            ]
        ]];
    }

    /**
     * @dataProvider dataProvider
     */
    public function testGet($tags)
    {
        foreach ($tags as $tag) {
            $i = new Item(static::$transport);
            $i->setPublic(true);
            $i->setFeatured(true);
            $i->addTag($tag);
            $i->create();
        }

        $repository = new TagRepository(static::$transport);

        $ts = $repository->find();

        foreach ($ts as $tag) {
            /** @var Tag $tag */
            $this->assertTrue(in_array($tag->getName(), $tags));

            //$this->assertTrue($tag->delete());
        }

        $repository = new ItemRepository(static::$transport);

        $is = $repository->where(['public' => true, 'featured' => true])->find();

        foreach ($is as $item) {
            /** @var Item $item */
            $this->assertTrue($item->delete());
        }
    }
}
