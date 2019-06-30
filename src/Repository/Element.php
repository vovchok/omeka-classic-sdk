<?php

namespace OmekaClassic\Repository;


class Element extends Repository
{
    /**
     * @return string
     */
    public function getEndpointName()
    {
        return 'elements';
    }

    /**
     * @return string
     */
    protected function getClassName()
    {
        return \OmekaClassic\Representation\Element::class;
    }

    /**
     * @return array
     * @see https://omeka.readthedocs.io/en/latest/Reference/api/resources/elements.html#parameters
     */
    protected function rules()
    {
        return [
            'element_set'   => 'is_integer',
            'name'          => 'is_string',
            'item_type'     => 'is_integer',
        ];
    }
}
