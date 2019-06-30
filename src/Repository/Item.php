<?php

namespace OmekaClassic\Repository;


class Item extends Repository
{
    /**
     * @return string
     */
    public function getEndpointName()
    {
        return 'items';
    }

    /**
     * @return string
     */
    protected function getClassName()
    {
        return \OmekaClassic\Representation\Item::class;
    }

    /**
     * @return array
     * @see https://omeka.readthedocs.io/en/latest/Reference/api/resources/items.html#parameters
     */
    protected function rules()
    {
        return [
            'collection'            => 'is_integer',
            'item_type'             => 'is_integer',
            'featured'              => 'is_bool',
            'public'                => 'is_bool',
            'added_since'           => 'is_string', // ISO 8601
            'modified_since'        => 'is_string', // ISO 8601
            'owner'                 => 'is_integer',
            'tags'                  => 'is_string',
            'excludeTags'           => 'is_string',
            'hasImage'              => 'is_bool',
            'range'                 => 'is_string',
            'search'                => 'is_string',
        ];
    }
}
