<?php

namespace OmekaClassic\Repository;


class Tag extends Repository
{
    /**
     * @return string
     */
    public function getEndpointName()
    {
        return 'tags';
    }

    /**
     * @return string
     */
    protected function getClassName()
    {
        return \OmekaClassic\Representation\Tag::class;
    }

    /**
     * @return array
     * @see https://omeka.readthedocs.io/en/latest/Reference/api/resources/tags.html#get-tags
     */
    protected function rules()
    {
        return [];
    }
}
