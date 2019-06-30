<?php

namespace OmekaClassic\Representation;


use OmekaClassic\Exception\LogicException;
use OmekaClassic\Representation\Parameters\HasElementTexts;

class File extends Representation
{
    use HasElementTexts;

    /**
     * @return string
     */
    public function getEndpointName()
    {
        return 'files';
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
     * @param string $type
     * @return mixed|null
     */
    public function getFileUrls($type = 'original')
    {
        if (isset($this['file_urls'][$type])) {
            return $this['file_urls'][$type];
        }

        return $this['file_urls'];
    }

    /**
     * @return mixed|null
     */
    public function getItem()
    {
        return $this['item'];
    }

    /**
     * @return int|null
     */
    public function getOrder()
    {
        return $this['order'];
    }

    /**
     * @return int|null
     */
    public function getSize()
    {
        return $this['size'];
    }

    /**
     * @return mixed|null
     */
    public function hasDerivativeImages()
    {
        return $this['has_derivative_images'];
    }

    /**
     * @return string|null
     */
    public function getAuthentication()
    {
        return $this['authentication'];
    }

    /**
     * @return string|null
     */
    public function getMimeType()
    {
        return $this['mime_type'];
    }

    /**
     * @return string|null
     */
    public function getTypeOs()
    {
        return $this['type_os'];
    }

    /**
     * @return string|null
     */
    public function getFilename()
    {
        return $this['filename'];
    }

    /**
     * @return string|null
     */
    public function getOriginalFilename()
    {
        return $this['original_filename'];
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
     * @return bool|null
     */
    public function isStored()
    {
        return $this['stored'];
    }

    /**
     * @return mixed|null
     */
    public function getMetadata()
    {
        return $this['metadata'];
    }

    /**
     * @return Representation|void
     * @throws LogicException
     */
    public function create()
    {
        throw new LogicException('Not implemented.');
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'order'         => $this->getOrder(),
            'element_texts' => $this->getElementTexts(),
        ];
    }
}
