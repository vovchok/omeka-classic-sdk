<?php

namespace OmekaClassic\Representation;


use OmekaClassic\Exception\LogicException;

class Tag extends Representation
{
    /**
     * @return string
     */
    public function getEndpointName()
    {
        return 'tags';
    }

    /**
     * @return int|null
     */
    public function getId()
    {
        return $this['id'];
    }

    /**
     * @return string|null
     */
    public function getUrl()
    {
        return $this['url'];
    }

    /**
     * @return string|null
     */
    public function getName()
    {
        return $this['name'];
    }

    /**
     * @return void
     * @throws LogicException
     */
    public function create()
    {
        throw new LogicException('New tag must be created via the owner record.');
    }

    /**
     * @return void
     * @throws LogicException
     */
    public function update()
    {
        throw new LogicException('Tag cannot be updated.');
    }

    /**
     * @return void
     * @throws LogicException
     */
    public function delete()
    {
        throw new LogicException('Tag cannot be deleted. Record "Tag" must define an ACL resource.');
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [];
    }
}
