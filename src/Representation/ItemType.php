<?php

namespace OmekaClassic\Representation;


class ItemType extends Representation
{
    /**
     * @return string
     */
    public function getEndpointName()
    {
        return 'item_types';
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
     * @return string|null
     */
    public function getElements()
    {
        return $this['elements'];
    }

    /**
     * @param int $id
     */
    public function addElement(int $id)
    {
        $elements = $this['elements'] ?? [];

        $elements[] = (object) ['id' => $id];

        $this['elements'] = $elements;
    }

    /**
     * @return mixed|null
     */
    public function getItems()
    {
        return $this['items'];
    }

    /**
     * @return mixed|null
     */
    public function getExtendedResources()
    {
        return $this['extended_resources'];
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'name'          => $this->getName(),
            'description'   => $this->getDescription(),
            'elements'      => $this->getElements(),
        ];
    }
}
