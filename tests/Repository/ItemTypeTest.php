<?php

namespace OmekaClassicTest\Repository;


use OmekaClassic\Repository\ItemType as ItemTypeRepository;
use OmekaClassic\Repository\RepositoryInterface;
use OmekaClassic\Representation\ItemType;
use OmekaClassicTest\TestCase;

class ItemTypeTest extends TestCase
{
    public function dataProvider()
    {
        return [[
            [
                "ItemType 10",
                "ItemType 20",
                "ItemType 30",
                "ItemType 40",
                "ItemType 50",
            ]
        ]];
    }

    /**
     * @dataProvider dataProvider
     */
    public function testGet($itemTypes)
    {
        foreach ($itemTypes as $itemType) {
            $it = new ItemType(static::$transport);
            $it->setName($itemType);
            $it->create();
        }

        $repository = new ItemTypeRepository(static::$transport);
        $repository->sortBy('id', RepositoryInterface::SORT_DIRECTION_DESCENDING);
        $repository->perPage(count($itemTypes));

        $its = $repository->find();

        foreach ($its as $itemType) {
            /** @var ItemType $itemType */

            $this->assertTrue(in_array($itemType->getName(), $itemTypes));

            $this->assertTrue($itemType->delete());
        }
    }
}
