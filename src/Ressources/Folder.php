<?php

namespace Opalia\TradosApiClient\Ressources;

use Opalia\TradosApiClient\Trados;

Class Folder{

    public function __construct(private Trados $client)
    {}

    public function get(string $folderId)
    {
        return $this->client->get('folders/'.$folderId);
    }

    public function getRoot()
    {
        return $this->client->get('folders/root');
    }

    public function list()
    {
        return $this->client->get('folders');
    }
}