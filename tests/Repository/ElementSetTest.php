<?php

namespace OmekaClassicTest\Repository;


use OmekaClassic\Repository\ElementSet as ElementSetRepository;
use OmekaClassic\Representation\ElementSet;
use OmekaClassicTest\TestCase;

class ElementSetTest extends TestCase
{
    public function dataProvider()
    {
        return [[
            [
                "Element Set 10",
                "Element Set 20",
                "Element Set 30",
                "Element Set 40",
                "Element Set 50",
            ]
        ]];
    }

    /**
     * @dataProvider dataProvider
     */
    public function testGet($elementSets)
    {
        foreach ($elementSets as $elementSet) {
            $es = new ElementSet(static::$transport);
            $es->setName($elementSet);
            $es->create();
        }

        $repository = new ElementSetRepository(static::$transport);

        $sets = $repository->find();

        foreach ($sets as $set) {
            /** @var ElementSet $set */
            if (in_array($set->getName(), ["Dublin Core", "Item Type Metadata"])) { continue; }

            $this->assertTrue(in_array($set->getName(), $elementSets));

            $this->assertTrue($set->delete());
        }
    }
}
