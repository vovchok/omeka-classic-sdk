<?php

namespace OmekaClassicTest\Repository;


use OmekaClassic\Repository\Element as ElementRepository;
use OmekaClassic\Representation\Element;
use OmekaClassic\Representation\ElementSet;
use OmekaClassicTest\TestCase;

class ElementTest extends TestCase
{
    public function dataProvider()
    {
        return [[
            [
                "Element 10",
                "Element 20",
                "Element 30",
                "Element 40",
                "Element 50",
            ]
        ]];
    }

    /**
     * @dataProvider dataProvider
     */
    public function testGet($elements)
    {
        $elementSet = new ElementSet(static::$transport);
        $elementSet->setName("Element Set 60");
        $elementSet->create();

        foreach ($elements as $element) {
            $el = new Element(static::$transport);
            $el->setName($element);
            $el->setElementSet($elementSet->getId());
            $el->create();
        }

        $repository = new ElementRepository(static::$transport);

        $els = $repository->where(['element_set' => $elementSet->getId()])->find();

        foreach ($els as $element) {
            /** @var Element $element */
            $this->assertTrue(in_array($element->getName(), $elements));

            $this->assertTrue($element->delete());
        }

        $this->assertTrue($elementSet->delete());
    }
}
