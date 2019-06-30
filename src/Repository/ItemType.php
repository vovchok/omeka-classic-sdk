<?php

namespace OmekaClassic\Repository;


class ItemType extends Repository
{
    /**
     * @return string
     */
    public function getEndpointName()
    {
        return 'item_types';
    }

    /**
     * @return string
     */
    protected function getClassName()
    {
        return \OmekaClassic\Representation\ItemType::class;
    }

    /**
     * @return array
     * @see https://omeka.readthedocs.io/en/latest/Reference/api/resources/item_types.html#parameters
     */
    protected function rules()
    {
        return [
            'name' => 'is_string',
        ];
    }
}
