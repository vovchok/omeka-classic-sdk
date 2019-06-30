<?php

namespace OmekaClassic\Representation;


use OmekaClassic\Representation\Parameters\HasElementTexts;

class Collection extends Representation
{
    use HasElementTexts;

    /**
     * @return string
     */
    public function getEndpointName()
    {
        return 'collections';
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this['id'];
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this['url'];
    }

    /**
     * @return bool
     */
    public function isPublic()
    {
        return $this['public'];
    }

    /**
     * @param bool $public
     */
    public function setPublic(bool $public)
    {
        $this['public'] = $public;
    }

    /**
     * @return bool
     */
    public function isFeatured()
    {
        return $this['featured'];
    }

    /**
     * @param bool $featured
     */
    public function setFeatured(bool $featured)
    {
        $this['featured'] = $featured;
    }

    /**
     * @return string
     */
    public function getAdded()
    {
        return $this['added'];
    }

    /**
     * @return string
     */
    public function getModified()
    {
        return $this['modified'];
    }

    /**
     * @return string
     */
    public function getOwner()
    {
        return $this['owner'];
    }

    /**
     * @return mixed|null
     */
    public function getItems()
    {
        return $this['items'];
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'public'        => $this->isPublic(),
            'featured'      => $this->isFeatured(),
            'element_texts' => $this->getElementTexts(),
        ];
    }
}
