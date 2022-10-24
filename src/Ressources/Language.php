<?php

namespace Opalia\TradosApiClient\Ressources;

use Opalia\TradosApiClient\Trados;

Class Language{

    public function __construct(private Trados $client)
    {}

    public function list()
    {
        return $this->client->get('languages');
    }
}