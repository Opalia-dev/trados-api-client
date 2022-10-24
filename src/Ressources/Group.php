<?php

namespace Opalia\TradosApiClient\Ressources;

use Opalia\TradosApiClient\Trados;

Class Group{

    public function __construct(private Trados $client)
    {}

    public function get(string $groupId)
    {
        return $this->client->get('groups/'.$groupId);
    }

    public function list()
    {
        return $this->client->get('groups');
    }
}