<?php

namespace Opalia\TradosApiClient\Ressources;

use Opalia\TradosApiClient\Trados;

Class ProjectTemplate{

    public function __construct(private Trados $client)
    {}

    public function get(string $projectTemplateId,string $fields = null)
    {
        $params = [];
        if($fields !==null){
            $params['query']['fields'] = $fields;
        }
        return $this->client->get('project-templates/'.$projectTemplateId,$params);
    }

    public function list(string $name = null,string $fields = null,array $location = null, string $locationStrategy = null,int $skip = null,string $sort = null, int $top = null)
    {
        $params = [];

        if($name !==null){
            $params['query']['name'] = $name;
        }
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
        return $this->client->get('project-templates',$params);
    }
}