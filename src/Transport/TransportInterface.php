<?php

namespace OmekaClassic\Transport;


use OmekaClassic\Repository\RepositoryInterface;
use OmekaClassic\Representation\RepresentationInterface;

interface TransportInterface
{
    public function get(RepresentationInterface $representation);

    public function create(RepresentationInterface $representation);

    public function update(RepresentationInterface $representation);

    public function delete(RepresentationInterface $representation);

    public function find(RepositoryInterface $repository);

    public function setParameters(array $parameters);

    public function getParameters();

    public function getTotal();
}
