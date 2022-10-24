<?php

namespace Opalia\TradosApiClient\Ressources;

use Opalia\TradosApiClient\Trados;

Class Account{

    public function __construct(private Trados $client)
    {}

    public function list()
    {
        return $this->client->get('accounts');
    }
}