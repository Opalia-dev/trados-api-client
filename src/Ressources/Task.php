<?php

namespace Opalia\TradosApiClient\Ressources;

use Opalia\TradosApiClient\Trados;

Class Task{

    public function __construct(private Trados $client)
    {}

    public function get(string $taskId,string $fields = null)
    {
        $params = [];
        if($fields !==null){
            $params['query']['fields'] = $fields;
        }
        return $this->client->get('tasks/'.$taskId,$params);
    }

    public function listAssignedToMe(string $fields = null,array $location = null, string $locationStrategy = null,int $skip = null,string $sort = null, string $status = null, int $top = null)
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
        if($status!==null){
            $params['query']['status']=$status;
        }
        if($top!==null){
            $params['query']['top']=$top;
        }
        return $this->client->get('tasks',$params);
    }

    public function accept(string $taskId)
    {
        return $this->client->put('tasks/'.$taskId.'/accept');
    }

    public function reject(string $taskId)
    {
        return $this->client->put('tasks/'.$taskId.'/reject');
    }

    public function complete(string $taskId)
    {
        return $this->client->put('tasks/'.$taskId.'/complete');
    }

    public function release(string $taskId)
    {
        return $this->client->put('tasks/'.$taskId.'/release');
    }

    public function reclaim(string $taskId)
    {
        return $this->client->put('tasks/'.$taskId.'/reclaim');
    }

    public function assign(string $taskId)
    {
        return $this->client->put('tasks/'.$taskId.'/assign');
    }
}