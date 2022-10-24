<?php

namespace Opalia\TradosApiClient\Ressources;

use Opalia\TradosApiClient\Trados;

Class ProjectTemplate{

    public function __construct(private Trados $client)
    {}

    public function get(string $projectTemplateId)
    {
        return $this->client->get('project-templates/'.$projectTemplateId);
    }

    public function list()
    {
        return $this->client->get('project-templates');
    }
}