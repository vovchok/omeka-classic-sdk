<?php

namespace OmekaClassic\Repository;


class ElementSet extends Repository
{
    /**
     * @return string
     */
    public function getEndpointName()
    {
        return 'element_sets';
    }

    /**
     * @return string
     */
    protected function getClassName()
    {
        return \OmekaClassic\Representation\ElementSet::class;
    }

    /**
     * @return array
     * @see https://omeka.readthedocs.io/en/latest/Reference/api/resources/element_sets.html#parameters
     */
    protected function rules()
    {
        return [
            'name'          => 'is_string',
            'record_type'   => 'is_string',
        ];
    }
}
