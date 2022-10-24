<?php

namespace Opalia\TradosApiClient\Ressources;

use Opalia\TradosApiClient\Trados;

Class CustomField{

    public function __construct(private Trados $client)
    {}

    public function listDefinitions()
    {
        return $this->client->get('custom-field-definitions');
    }

    public function getDefinition(string $customFieldDefinitionId)
    {
        return $this->client->get('custom-field-definitions/'.$customFieldDefinitionId);
    }
}