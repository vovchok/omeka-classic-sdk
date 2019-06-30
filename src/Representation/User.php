<?php

namespace OmekaClassic\Representation;


use OmekaClassic\Exception\LogicException;

class User extends Representation
{
    /**
     * @return string
     */
    public function getEndpointName()
    {
        return 'users';
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
    public function getUserName()
    {
        return $this['username'];
    }

    /**
     * @return string|null
     */
    public function getName()
    {
        return $this['name'];
    }

    /**
     * @return string|null
     */
    public function getEmail()
    {
        return $this['email'];
    }

    /**
     * @return bool|null
     */
    public function isActive()
    {
        return $this['active'];
    }

    /**
     * @return string|null
     */
    public function getRole()
    {
        return $this['role'];
    }

    /**
     * @return void
     * @throws LogicException
     */
    public function create()
    {
        throw new LogicException('User can not be created.');
    }

    /**
     * @return void
     * @throws LogicException
     */
    public function update()
    {
        throw new LogicException('User can not be updated.');
    }

    /**
     * @return void
     * @throws LogicException
     */
    public function delete()
    {
        throw new LogicException('User can not be deleted.');
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [];
    }
}
