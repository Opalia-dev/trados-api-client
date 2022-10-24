<?php

namespace Opalia\TradosApiClient\Ressources;

use Opalia\TradosApiClient\Trados;

Class Folder{

    public function __construct(private Trados $client)
    {}

    public function get(string $folderId,string $fields = null)
    {
        $params = [];
        if($fields !==null){
            $params['query']['fields'] = $fields;
        }
        return $this->client->get('folders/'.$folderId,$params);
    }

    public function getRoot(string $fields = null)
    {
        $params = [];
        if($fields !==null){
            $params['query']['fields'] = $fields;
        }
        return $this->client->get('folders/root',$params);
    }

    public function list(string $fields = null,string $name = null)
    {
        $params = [];
        if($fields !==null){
            $params['query']['fields'] = $fields;
        }
        if($name !==null){
            $params['query']['name'] = $name;
        }
        return $this->client->get('folders',$params);
    }
}