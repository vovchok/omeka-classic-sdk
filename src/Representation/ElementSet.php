<?php

namespace OmekaClassic\Representation;


use OmekaClassic\Exception\LogicException;

class ElementSet extends Representation
{
    /**
     * @return string
     */
    public function getEndpointName()
    {
        return 'element_sets';
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
    public function getRecordType()
    {
        return $this['record_type'];
    }

    /**
     * @return string|null
     */
    public function getName()
    {
        return $this['name'];
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this['name'] = $name;
    }

    /**
     * @return string|null
     */
    public function getDescription()
    {
        return $this['description'];
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description)
    {
        $this['description'] = $description;
    }

    /**
     * @return mixed|null
     */
    public function getElements()
    {
        return $this['elements'];
    }

    /**
     * @return Representation|void
     * @throws LogicException
     */
    public function update()
    {
        throw new LogicException('This resource does not implement the update action.');
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'name'          => $this->getName(),
            'description'   => $this->getDescription(),
        ];
    }
}
