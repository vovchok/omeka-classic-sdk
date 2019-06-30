<?php

namespace OmekaClassic\Representation;


use OmekaClassic\Transport\EndpointInterface;

interface RepresentationInterface extends EndpointInterface
{
    public function get($id);

    public function create();

    public function update();

    public function delete();
}
