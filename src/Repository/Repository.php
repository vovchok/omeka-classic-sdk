<?php

namespace OmekaClassic\Repository;


use OmekaClassic\Representation\Representation;
use OmekaClassic\Transport\TransportInterface;
use OmekaClassic\Transport\Transport;
use OmekaClassic\Exception\LogicException;

abstract class Repository implements RepositoryInterface
{
    /**
     * @var TransportInterface
     */
    protected $transport;

    /**
     * @var array
     */
    protected $rules = [];

    /**
     * @var int
     */
    protected $page = 1;

    /**
     * @var array
     */
    protected $parameters = [];

    abstract protected function getClassName();

    abstract public function getEndpointName();

    abstract protected function rules();

    /**
     * Repository constructor.
     * @param TransportInterface|null $transport
     */
    public function __construct(TransportInterface $transport = null)
    {
        $this->transport = $transport ?? new Transport();

        $this->transport->setResourceName($this->getEndpointName());
        $this->page(self::DEFAULT_PAGE);
        $this->perPage(self::DEFAULT_PER_PAGE);

        $this->setRules($this->rules());
    }

    /**
     * @param array $parameters
     * @return $this
     */
    public function where(array $parameters = [])
    {
        $this->setParameters($parameters);

        return $this;
    }

    /**
     * @param string $field
     * @param string $direction
     */
    public function sortBy(string $field, string $direction = self::SORT_DIRECTION_DESCENDING)
    {
        $this->setParameter('sort_field', $field);

        if (in_array($direction, [self::SORT_DIRECTION_ASCENDING, self::SORT_DIRECTION_DESCENDING])) {
            $this->setParameter('sort_dir', $direction);
        }
    }

    /**
     * @return array
     */
    public function find()
    {
        $this->transport->setParameters($this->parameters);

        /** @var Representation[] $representations */
        $representations = $this->transport->find($this);

        $className = $this->getClassName();

        for ($i = 0; $i < count($representations); $i++) {
            $representations[$i] = new $className($this->transport, $representations[$i]);
        }

        return $representations;
    }

    /**
     * @param int|null $pageNumber
     * @return $this|mixed
     */
    public function page($pageNumber = null)
    {
        if($pageNumber === null) {
            return  $this->getParameter('page');
        }

        $this->setParameter('page', $pageNumber);

        return $this;
    }

    /**
     * @param int|null $perPage
     * @return int|$this
     */
    public function perPage($perPage = null)
    {
        if($perPage === null) {
            return $this->setParameter('per_page', $perPage);
        }

        $this->setParameter('per_page', $perPage);

        return $this;
    }

    /**
     * @param $key
     * @param $value
     */
    protected function setParameter($key, $value)
    {
        $this->parameters[$key] = $value;
    }

    /**
     * @param $key
     * @return mixed
     */
    protected function getParameter($key)
    {
        return $this->parameters[$key];
    }

    /**
     * @return int
     */
    public function total()
    {
        return $this->transport->getTotal();
    }

    /**
     * @return bool
     */
    public function hasNext()
    {
        return $this->page() * $this->perPage() < $this->total();
    }

    /**
     * @return array|bool
     */
    public function next()
    {
        if($this->hasNext() || $this->page == 1) {
           return $this->page($this->page++)->find();
        }

        return false;
    }

    /**
     * @param array $parameters
     * @return $this
     */
    protected function setParameters($parameters = [])
    {
        if(empty($parameters)) {
            return $this;
        }

        foreach ($parameters as $name => $value) {

            $rule = $this->getRule($name);

            if(!is_callable($rule)) {
                continue;
            }

            // validation
            if ($rule($parameters[$name])) {
                $this->parameters[$name] = $parameters[$name];
            } else {
                throw new LogicException("Not allowed parameter: $name");
            }
        }

        if (empty($this->parameters)) {
            throw new LogicException("Allowed parameters: " . join(",", $this->getAllowedParameters()));
        }

        return $this;
    }

    /**
     * @param array $rules
     */
    protected function setRules($rules = [])
    {
        $this->rules = $rules;
    }

    /**
     * @param $parameterName
     * @return mixed
     */
    protected function getRule($parameterName)
    {
        return $this->rules[$parameterName];
    }

    /**
     * @return array
     */
    protected function getAllowedParameters()
    {
        return array_keys($this->rules);
    }
}
