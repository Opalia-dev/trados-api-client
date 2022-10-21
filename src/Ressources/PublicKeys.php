<?php

namespace Opalia\TradosApiClient\Ressources;

use Opalia\TradosApiClient\Trados;

Class PublicKeys{

    public function __construct(private Trados $client)
    {}

    public function get(string $kid)
    {
        return $this->client->get('/.well-known/jwks.json/'.$kid);
    }

    public function list()
    {
        return $this->client->get('/.well-known/jwks.json');
    }
}