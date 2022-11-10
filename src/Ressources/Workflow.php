<?php

namespace Opalia\TradosApiClient\Ressources;

use Opalia\TradosApiClient\Trados;

Class Workflow{

    public function __construct(private Trados $client)
    {}

    public function get(string $workflowId,string $fields = null)
    {
        $params = [];
        if($fields !==null){
            $params['query']['fields'] = $fields;
        }
        return $this->client->get('workflows/'.$workflowId,$params);
    }

    public function list(string $fields = null,array $location = null, string $locationStrategy = null,int $skip = null,string $sort = null, int $top = null)
    {
        $params = [];
        if($fields !==null){
            $params['query']['fields'] = $fields;
        }
        if($skip!==null){
            $params['query']['skip']=$skip;
        }
        if($location!==null){
            $params['query']['location']=$location;
        }
        if($locationStrategy!==null){
            $params['query']['locationStrategy']=$locationStrategy;
        }
        if($sort!==null){
            $params['query']['sort']=$sort;
        }
        if($top!==null){
            $params['query']['top']=$top;
        }
        return $this->client->get('workflows',$params);
    }

    public function update(string $workflowId,?string $name = null,?string $description = null,?array $taskConfigurations = null)
    {
        $params = [];
        if($name !==null){
            $params['query']['name'] = $name;
        }
        if($description !==null){
            $params['query']['de$description'] = $description;
        }
        if($taskConfigurations !==null){
            $params['query']['taskConfigurations'] = $taskConfigurations;
        }
        return $this->client->get('workflows/'.$workflowId,$params);
    }
}