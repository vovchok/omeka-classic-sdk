<?php

namespace OmekaClassic\Repository;


class Collection extends Repository
{
    /**
     * @return string
     */
    public function getEndpointName()
    {
        return 'collections';
    }

    /**
     * @return string
     */
    protected function getClassName()
    {
        return \OmekaClassic\Representation\Collection::class;
    }

    /**
     * @return array
     * @see https://omeka.readthedocs.io/en/latest/Reference/api/resources/collections.html#parameters
     */
    protected function rules()
    {
        return [
            'public'            => 'is_bool',
            'featured'          => 'is_bool',
            'added_since'       => 'is_string', // ISO 8601
            'modified_since'    => 'is_string', // ISO 8601
            'owner'             => 'is_integer',
        ];
    }
}
