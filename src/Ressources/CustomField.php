<?php

namespace Opalia\TradosApiClient\Ressources;

use Opalia\TradosApiClient\Trados;

Class CustomField{

    public function __construct(private Trados $client)
    {}

    public function listDefinitions(string $fields = null,string $location = null, string $locationStrategy = null,int $skip = null,string $sort = null, int $top = null)
    {
        $params = [];
        if($fields !==null){
            $params['query']['fields'] = $fields;
        }
        if($location!==null){
            $params['query']['location']=$location;
        }
        if($locationStrategy!==null){
            $params['query']['locationStrategy']=$locationStrategy;
        }
        if($skip!==null){
            $params['query']['skip']=$skip;
        }
        if($sort!==null){
            $params['query']['sort']=$sort;
        }
        if($top!==null){
            $params['query']['top']=$top;
        }
        return $this->client->get('custom-field-definitions',$params);
    }

    public function getDefinition(string $customFieldDefinitionId,string $fields = null)
    {
        $params = [];
        if($fields !==null){
            $params['query']['fields'] = $fields;
        }
        return $this->client->get('custom-field-definitions/'.$customFieldDefinitionId,$params);
    }
}