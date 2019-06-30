<?php

namespace OmekaClassic\Repository;


use OmekaClassic\Transport\EndpointInterface;

interface RepositoryInterface extends EndpointInterface
{
    const SORT_DIRECTION_ASCENDING = 'a';
    const SORT_DIRECTION_DESCENDING = 'd';

    const DEFAULT_PAGE     = 1;
    const DEFAULT_PER_PAGE = 10;

    public function where(array $parameters);

    public function find();

    public function sortBy(string $field, string $direction);

    public function page($pageNumber);

    public function perPage($perPage);

    public function total();

    public function hasNext();

    public function next();
}
