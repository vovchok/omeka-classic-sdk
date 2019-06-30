<?php

namespace OmekaClassic\Representation;


class Element extends Representation
{
    /**
     * @return string
     */
    public function getEndpointName()
    {
        return 'elements';
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
    public function getOrder()
    {
        return $this['order'];
    }

    /**
     * @param int $order
     */
    public function setOrder(int $order)
    {
        $this['order'] = $order;
    }

    /**
     * @return string|null
     */
    public function getComment()
    {
        return $this['comment'];
    }

    /**
     * @param string $comment
     */
    public function setComment(string $comment)
    {
        $this['comment'] = $comment;
    }

    /**
     * @return mixed|null
     */
    public function getElementSet()
    {
        return $this['element_set'];
    }

    /**
     * @param int $elementSetId
     */
    public function setElementSet(int $elementSetId)
    {
        $this['element_set'] = (object) ['id' => $elementSetId];
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'order'         => $this->getOrder(),
            'name'          => $this->getName(),
            'description'   => $this->getDescription(), // not updateable (omeka api)
            'comment'       => $this->getComment(),
            'element_set'   => $this->getElementSet(), // required
        ];
    }
}
