<?php

namespace Opalia\TradosApiClient\Ressources;

use Opalia\TradosApiClient\Trados;

Class Customer{

    public function __construct(private Trados $client)
    {}

    public function get(string $customerId)
    {
        return $this->client->get('/customers/'.$customerId);
    }

    public function list()
    {
        return $this->client->get('/customers');
    }
}