<?php

namespace Opalia\TradosApiClient\Ressources;

use Opalia\TradosApiClient\Trados;

Class TaskType{

    public function __construct(private Trados $client)
    {}

    public function get(string $taskTypeId,?string $fields = null)
    {
        $params = [];
        if($fields !==null){
            $params['query']['fields'] = $fields;
        }
        return $this->client->get('task-types/'.$taskTypeId,$params);
    }

    public function list(?bool $automatic = null,?string $fields = null,?array $key = null,?array $location = null,?string $locationStrategy = null,?int $skip = null,?string $sort = null,?int $top = null)
    {
        $params = [];
        if($automatic!==null){
            $params['query']['automatic']=$automatic;
        }
        if($fields !==null){
            $params['query']['fields'] = $fields;
        }
        if($key !==null){
            $params['query']['key'] = $key;
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
        return $this->client->get('tasktypes',$params);
    }
}