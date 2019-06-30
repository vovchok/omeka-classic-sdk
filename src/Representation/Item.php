<?php

namespace OmekaClassic\Representation;


use OmekaClassic\Representation\Parameters\HasElementTexts;

class Item extends Representation
{
    use HasElementTexts;

    /**
     * @return string
     */
    public function getEndpointName()
    {
        return 'items';
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
     * @return bool|null
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
     * @return bool|null
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
     * @return string|null
     */
    public function getAdded()
    {
        return $this['added'];
    }

    /**
     * @return string|null
     */
    public function getModified()
    {
        return $this['modified'];
    }

    /**
     * @return string|null
     */
    public function getItemType()
    {
        return $this['item_type'];
    }

    /**
     * @param int $itemTypeId
     */
    public function setItemType(int $itemTypeId)
    {
        $this['item_type'] = (object) ['item_type' => $itemTypeId];
    }

    /**
     * @return string|null
     */
    public function getCollection()
    {
        return $this['collection'];
    }

    /**
     * @param int $collectionId
     */
    public function setCollection(int $collectionId)
    {
        $this['collection'] = (object) ['collection' => $collectionId];
    }

    /**
     * @return string|null
     */
    public function getOwner()
    {
        return $this['owner'];
    }

    /**
     * @return string|null
     */
    public function getFiles()
    {
        return $this['files'];
    }

    /**
     * @return string|null
     */
    public function getTags()
    {
        return $this['tags'];
    }

    /**
     * @param string $tag
     */
    public function addTag(string $tag)
    {
        $tags = $this['tags'] ?? [];

        $tags[] = (object) ['name' => $tag];

        $this['tags'] = $tags;
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
            'item_type'     => $this->getItemType(),
            'collection'    => $this->getCollection(),
            'public'        => $this->isPublic(),
            'featured'      => $this->isFeatured(),
            'tags'          => $this->getTags(),
            'element_texts' => $this->getElementTexts(),
        ];
    }
}
