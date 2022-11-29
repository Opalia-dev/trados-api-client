<?php

namespace Opalia\TradosApiClient\Ressources;

use Opalia\TradosApiClient\Trados;

Class Project{

    public function __construct(private Trados $client)
    {}

    public function list(?bool $excludeOnline = null,?string $fields = null,?string $location = null,?string $locationStrategy = null,?int $skip = null,?string $sort = null,?int $top = null)
    {
        $params = [];
        if($excludeOnline){
            $params['query']['excludeOnline'] = $excludeOnline;
        }
        if($fields){
            $params['query']['fields'] = $fields;
        }
        if($location){
            $params['query']['location']=$location;
        }
        if($locationStrategy){
            $params['query']['locationStrategy']=$locationStrategy;
        }
        if($skip){
            $params['query']['skip']=$skip;
        }
        if($sort){
            $params['query']['sort']=$sort;
        }
        if($top!==null){
            $params['query']['top']=$top;
        }
        return $this->client->get('projects',$params);
    }

    public function get(string $projectId, string $fields = null)
    {
        if($fields !==null){
            return $this->client->get('projects/'.$projectId,[
                'query' => [
                    'fields' => $fields
                ]
            ]);
        }
        return $this->client->get('projects/'.$projectId);
    }

    public function delete(string $projectId)
    {
        return $this->client->delete('projects/'.$projectId);
    }

    public function start(string $projectId)
    {
        return $this->client->put('projects/'.$projectId.'/start');
    }

    public function complete(string $projectId)
    {
        return $this->client->put('projects/'.$projectId.'/complete');
    }

    public function cancelFile(string $projectId,int $fileId)
    {
        return $this->client->put('projects/'.$projectId.'/files/'.$fileId.'/cancel');
    }

    public function create(array $body,string $fields = null)
    {
        $params['json']= $body;

        if($fields !==null){
            $params['query'] = [
                'fields' => $fields
            ];
        }
        return $this->client->post('projects',$params);
    }

    public function getConfig(string $projectId, string $fields = null)
    {
        if($fields !==null){
            return $this->client->get('projects/'.$projectId,[
                'query' => [
                    'fields' => $fields
                ]
            ]);
        }
        return $this->client->get('projects/'.$projectId.'/configuration');
    }

    public function updateConfig(string $projectId, array $body)
    {
        return $this->client->get('projects/'.$projectId.'/configuration',['json'=>$body]);
    }

    public function getTasks(string $projectId, string $fields = null,array $location = null, string $locationStrategy = null,int $skip = null,string $sort = null, int $top = null)
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
        return $this->client->get('projects/'.$projectId.'/tasks',$params);
    }
}