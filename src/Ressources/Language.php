<?php

namespace Opalia\TradosApiClient\Ressources;

use Opalia\TradosApiClient\Trados;

Class Language{

    public function __construct(private Trados $client)
    {}

    public function list(string $fields = null,string $languageCodes = null,string $type = null)
    {
        $params = [];
        if($fields !==null){
            $params['query']['fields'] = $fields;
        }
        if($languageCodes !==null){
            $params['query']['languageCodes'] = $languageCodes;
        }
        if($type !==null){
            $params['query']['type'] = $type;
        }
        return $this->client->get('languages',$params);
    }
}