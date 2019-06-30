<?php

namespace OmekaClassic\Representation;

use ArrayAccess;
use JsonSerializable;
use OmekaClassic\Transport\TransportInterface;
use OmekaClassic\Transport\Transport;

abstract class Representation implements ArrayAccess, JsonSerializable, RepresentationInterface
{
    /**
     * @var TransportInterface
     */
    protected $transport;

    /**
     * @var array
     */
    protected $record = [];

    /**
     * @var array
     */
    protected $parameters = [];

    abstract public function getEndpointName();

    /**
     * Representation constructor.
     * @param TransportInterface|null $transport
     * @param array $record
     */
    public function __construct(TransportInterface $transport = null, $record = [])
    {
        $this->transport = $transport ?? new Transport();

        $this->transport->setResourceName($this->getEndpointName());

        $this->record = $record;
    }

    /**
     * @param $id
     * @return $this
     */
    public function get($id)
    {
        $this['id'] = $id;

        $this->record = $this->transport->get($this);

        return $this;
    }

    /**
     * @return $this
     */
    public function create()
    {
        $this->record = $this->transport->create($this);

        return $this;
    }

    /**
     * @return $this
     */
    public function update()
    {
        $this->record = $this->transport->update($this);

        return $this;
    }

    /**
     * @return bool
     */
    public function delete()
    {
        return $this->transport->delete($this);
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->record[] = $value;
        } else {
            $this->record[$offset] = $value;
        }
    }

    /**
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->record[$offset]);
    }

    /**
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        unset($this->record[$offset]);
    }

    /**
     * @param mixed $offset
     * @return mixed|null
     */
    public function offsetGet($offset)
    {
        return isset($this->record[$offset]) ? $this->record[$offset] : null;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->record;
    }
}
