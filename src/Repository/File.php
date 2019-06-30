<?php

namespace OmekaClassic\Repository;


class File extends Repository
{
    /**
     * @return string
     */
    public function getEndpointName()
    {
        return 'files';
    }

    /**
     * @return string
     */
    protected function getClassName()
    {
        return \OmekaClassic\Representation\File::class;
    }

    /**
     * @return array
     * @see https://omeka.readthedocs.io/en/latest/Reference/api/resources/files.html#parameters
     */
    protected function rules()
    {
        return [
            'item'                      => 'is_integer',
            'order'                     => 'is_integer',
            'size_greater_than'         => 'is_integer',
            'has_derivative_image'      => 'is_bool',
            'mime_type'                 => 'is_string',
            'added_since'               => 'is_string', // ISO 8601
            'modified_since'            => 'is_string', // ISO 8601
        ];
    }
}
